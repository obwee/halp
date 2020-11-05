<?php

/**
 * Student
 * Class for student-related functionalities.
 */
class Student extends BaseController
{
    /**
     * @var AdminsModel $AdminsModel
     * Class instance for admins' model.
     */
    private $AdminsModel;

    /**
     * @var CourseModel $oCourseModel
     * Class instance for course' model.
     */
    private $oCourseModel;

    /**
     * Student constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        $this->aParams = $aPostVariables;
        $this->AdminsModel = new AdminsModel();
        $this->oCourseModel = new CourseModel();
        
        parent::__construct();
    }

    /**
     * registerStudent
     * Method for registering student.
     */
    public function registerStudent()
    {
        $aValidationResult = Validations::validateRegistrationInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            Utils::prepareData($this->aParams, 'registration');

            // Insert position field.
            $this->aParams[':position'] = 'Student';

            if ($this->oStudentModel->checkUsernameIfTaken($this->aParams[':username']) > 0) {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'Username already taken.'
                );
            } else {
                $this->aParams[':password'] = Utils::hashPassword($this->aParams[':password']);
                $oQueryResult = $this->oStudentModel->insertStudent($this->aParams);

                if ($oQueryResult === true) {
                    $aResult = array(
                        'bResult' => true,
                        'sMsg'    => 'Successfully registered!'
                    );
                } else {
                    $aResult = array(
                        'bResult' => false,
                        'sMsg'    => 'An error has occurred. Please try again.'
                    );
                }
            }
        } else {
            $aResult = $aValidationResult;
        }
        echo json_encode($aResult);
    }

    /**
     * sendEmail
     * Method for sending email.
     */
    public function sendEmail()
    {
        $aValidationResult = Validations::validateEmailInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            Utils::prepareData($this->aParams, 'sendEmail');

            // Add date field for dateSent column inside database.\
            $this->aParams[':dateSent'] = date('Y-m-d H:i:s');

            $oQueryResult = $this->oStudentModel->insertEmail($this->aParams);

            if ($oQueryResult === true && $this->proceedSendingEmail() === 1) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Email sent!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occurred. Please try again.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }
        echo json_encode($aResult);
    }

    private function proceedSendingEmail()
    {
        foreach ($this->aParams as $sKey => $sParam) {
            $aNewKeys = preg_replace('/[:]/', '', $sKey);
            $this->aParams[$aNewKeys] = $sParam;
            unset($this->aParams[$sKey]);
        }

        $this->aParams['fullName'] = implode(' ', array_slice($this->aParams, 0, 3));

        $sEmailHeader = 'Sent by: ' . $this->aParams['fullName'] . ' <' . $this->aParams['email'] . ">\n\n";

        $oMail = new Email();
        $oMail->addSingleRecipient('kdoz@live.com', 'Nexus Info Tech Training Center');
        $oMail->setTitle($this->aParams['title']);
        $oMail->setBody($sEmailHeader . $this->aParams['message']);
        return $oMail->send();
    }

    /**
     * enrollForTraining
     * Enroll a schedule for a particular student.
     */
    public function enrollForTraining()
    {
        $aValidationResult = Validations::validateEnrollmentInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'courses'   => 'courseId',
                'schedules' => 'scheduleId'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            // Insert into training table.
            $iQuery = $this->oTrainingModel->enrollForTraining($this->aParams['scheduleId'], $this->aParams['courseId'], $this->getUserId());

            if ($iQuery > 0) {
                $this->sendEmailToAdmin($this->aParams);

                $aParams = array(
                    'studentId'  => $this->getUserId(),
                    'courseId'   => $this->aParams['courseId'],
                    'scheduleId' => $this->aParams['scheduleId'],
                    'type'       => 0,
                    'hasAccount' => 1,
                    'receiver'   => 'admin',
                    'date'       => dateNow()
                );
                $this->oNotificationModel->insertNotification($aParams);

                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Course enrolled!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    private function sendEmailToAdmin($aParams)
    {
        $aStudentDetails = $this->getUserDetails($this->getUserId());
        $aStudentDetails['fullName'] = $aStudentDetails['firstName'] . ' ' . $aStudentDetails['lastName'];
        $aEnrollmentDetails = $this->oCourseModel->getCourseAndScheduleDetails($aParams['scheduleId']);
        $aEnrollmentDetails['schedule'] = Utils::formatDate($aEnrollmentDetails['fromDate']) . ' - ' . Utils::formatDate($aEnrollmentDetails['toDate']) . ' (' . $this->getInterval($aEnrollmentDetails) . ')';
        
        $sMsg = $aStudentDetails['fullName'] . ' has enrolled for: ';
        $sMsg .= "\r\n\r\n";
        $sMsg .= 'Course Code: ' . $aEnrollmentDetails['courseCode'];
        $sMsg .= "\r\n";
        $sMsg .= 'Course Price: ' . Utils::toCurrencyFormat($aEnrollmentDetails['coursePrice']);
        $sMsg .= "\r\n";
        $sMsg .= 'Schedule: ' . $aEnrollmentDetails['schedule'];
        
        $oMail = new Email();
        $oMail->addSingleRecipient('kdoz@live.com', 'Nexus Info Tech Training Center');
        $oMail->setTitle('Enrollment Request');
        $oMail->setBody($sMsg);
        return $oMail->send();
    }

    public function printRegiForm()
    {
        $iTrainingId = filter_var($_GET['tId'], FILTER_VALIDATE_INT);

        if ($iTrainingId === false) {
            echo 'Error!';
            exit();
        }

        $aCourseDetails = $this->oTrainingModel->fetchTrainingDetails($this->getUserId(), $iTrainingId);
        $aStudentDetails = $this->oStudentModel->getUserDetails(['userId' => $this->getUserId()]);
        $aStudentDetails['fullName'] = $aStudentDetails['firstName'] . ' ' . $aStudentDetails['lastName'];

        $aUnnecessaryData = array(
            'courseId',
            'paymentId',
            'instructorId',
            'scheduleId',
            'trainingId',
            'paymentStatus',
            'remainingSlots',
            'instructorName'
        );
        Utils::unsetKeys($aCourseDetails, $aUnnecessaryData);

        $aCourseDetails['schedule'] = $aCourseDetails['fromDate'] . ' - ' . $aCourseDetails['toDate'];
        $aCourseDetails['schedule'] .= ' (' . $this->getInterval($aCourseDetails) . ')';

        $oPrintRegiForm = new PdfRegiForm($aStudentDetails, $aCourseDetails);
        $oPrintRegiForm->Output('I', 'Registration-Form.pdf');
    }

    public function fetchStudents()
    {
        echo json_encode($this->oStudentModel->fetchStudents());
    }

    /**
     * addWalkIn
     * Add a walk-in for enrollment.
     */
    public function addWalkIn()
    {
        $aValidationResult = Validations::validateWalkInInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'courseDropdown'   => 'courseId',
                'scheduleDropdown' => 'scheduleId'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            // Insert into training table.
            $iQuery = $this->oTrainingModel->enrollForTraining($this->aParams['scheduleId'], $this->aParams['courseId'], $this->aParams['studentId']);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Student added as walk-in!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        $this->sendEmailToAdmin($this->aParams);

        echo json_encode($aResult);
    }

    public function fetchStudentList()
    {
        if (filter_var($this->aParams['iScheduleId'], FILTER_VALIDATE_INT) === false) {
            echo json_encode(array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred.'
            ));
            exit();
        }
        $aStudentList = $this->oStudentModel->fetchStudentList($this->aParams['iScheduleId']);

        foreach ($aStudentList as $iKey => $aData) {
            $aStudentList[$iKey]['paymentDate'] = Utils::formatDate($aData['paymentDate']);
            $iBalance = $aData['coursePrice'] - $aData['paymentAmount'];
            
            $aStudentList[$iKey]['balance'] = ($iBalance >= 0) ? $iBalance : (0);
            $aStudentList[$iKey]['credits'] = ($iBalance < 0) ? abs($iBalance) : (0);
            $aStudentList[$iKey]['paymentAmount'] = $aData['paymentAmount'];
        }

        echo json_encode($aStudentList);
    }

    /**
     * fetchStudentCredentials
     * Fetch credentials of a student from the database.
     */
    public function fetchStudentCredentials()
    {
        $aDetails = $this->oStudentModel->fetchStudentCredentials($this->getUserId());
        echo json_encode($aDetails);
    }

    public function updateProfileDetails()
    {
        $aValidationResult = Validations::validateUpdateProfileDetails($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            $this->aParams['userId'] = $this->getUserId();

            if ($this->oStudentModel->updateStudentProfileDetails($this->aParams) > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Profile details updated!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    public function updateLoginCredentials()
    {
        $aValidationResult = Validations::validateUpdateLoginCredentials($this->aParams);

        if ($aValidationResult['bResult'] === false) {
            echo json_encode($aValidationResult);
            exit();
        }

        Utils::sanitizeData($this->aParams);

        if ($this->oStudentModel->checkIfUsernameTakenBeforeUpdate($this->aParams['username'], $this->getUserId()) > 0) {
            echo json_encode(array(
                'bResult'  => false,
                'sElement' => '.username',
                'sMsg'     => 'Username already taken.'
            ));
            exit();
        }

        $sPasswordEntered = Utils::hashPassword($this->aParams['password']);
        $sOldPassword = $this->oStudentModel->getPassword($this->aParams['username'], $sPasswordEntered);

        if ($sPasswordEntered !== $sOldPassword) {
            echo json_encode(array(
                'bResult'  => false,
                'sElement' => '.password',
                'sMsg'     => 'Old password incorrect'
            ));
            exit();
        }

        $aParams = array(
            'userId'   => $this->getUserId(),
            'username' => $this->aParams['username'],
            'password' => Utils::hashPassword($this->aParams['newPassword'])
        );

        if ($this->oStudentModel->updateLoginCredentials($aParams) > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Login credentials updated!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    public function fetchFinishedTrainings()
    {
        $aResult = $this->oStudentModel->fetchFinishedTrainings();

        if (empty($aResult) === true) {
            echo json_encode([]);
        }

        $aInstructorIds = array_unique(array_column($aResult, 'instructorId'));

        $oInstructorModel = new InstructorsModel();
        $aInstructors = $oInstructorModel->fetchInstructors();

        $aInstructorDetails = array();
        foreach ($aInstructorIds as $iInstructorId) {
            $iIndex = Utils::searchKeyByValueInMultiDimensionalArray($iInstructorId, $aInstructors, 'id');
            $aInstructorDetails[] = $aInstructors[$iIndex];
        }

        foreach ($aResult as $iKey => $aFinishedTrainingData) {
            $aResult[$iKey]['schedule'] = Utils::formatDate($aFinishedTrainingData['fromDate']) . ' - ' . Utils::formatDate($aFinishedTrainingData['toDate']) . ' (' . $this->getInterval($aFinishedTrainingData) . ')';
            foreach ($aInstructorDetails as $aInstructorData) {
                if ($aFinishedTrainingData['instructorId'] === $aInstructorData['id']) {
                    $aResult[$iKey]['instructorName'] = $aInstructorData['firstName'] . ' ' . $aInstructorData['lastName'];
                }
            }
        }

        $aUnnecessaryData = array(
            'fromDate', 'numRepetitions', 'recurrence', 'toDate', 'instructorId'
        );

        Utils::unsetUnnecessaryData($aResult, $aUnnecessaryData);

        echo json_encode($aResult);
    }
}
