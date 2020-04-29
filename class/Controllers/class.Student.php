<?php

/**
 * Student
 * Class for student-related functionalities.
 */
class Student extends BaseController
{
    /**
     * @var TrainingModel $oTrainingModel
     * Class instance for training model.
     */
    private $oTrainingModel;

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
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the TrainingModel.
        $this->oTrainingModel = new TrainingModel();
        // Instantiate the AdminsModel.
        $this->AdminsModel = new AdminsModel();
        // Instantiate the CourseModel.
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
        $oMail->setEmailSender($this->aParams['email'], $this->aParams['fullName']);
        $oMail->addSingleRecipient('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
        $oMail->setTitle($this->aParams['title']);
        $oMail->setBody($sEmailHeader . $this->aParams['message']);
        return $oMail->send();
    }

    public function fetchStudentDetails()
    {
        $aUserId = array(
            ':userId' => $this->getUserId()
        );

        echo json_encode($this->oStudentModel->getUserDetails($aUserId));
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
                // $this->sendEmailToAdmin($this->aParams);

                $aParams = array(
                    'studentId'  => $this->getUserId(),
                    'courseId'   => $this->aParams['courseId'],
                    'scheduleId' => $this->aParams['scheduleId'],
                    'type'       => 0,
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
        $oMail->setEmailSender($aStudentDetails['email'], $aStudentDetails['fullName']);
        $oMail->addSingleRecipient('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
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

        // $this->sendEmailToAdmin($this->aParams);

        echo json_encode($aResult);
    }
}
