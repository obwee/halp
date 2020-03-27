<?php

class Users extends BaseController
{
    /**
     * @var UsersModel $oModel
     * Class instance for Venue model.
     */
    private $oUsersModel;

    /**
     * @var SchedulesModel $oModel
     * Class instance for Venue model.
     */
    private $oSchedulesModel;

    /**
     * Users constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the UsersModel class and store it inside $this->oVenueModel.
        $this->oUsersModel = new UsersModel();

        // Instantiate the SchedulesModel class and store it inside $this->oSchedulesModel.
        $this->oSchedulesModel = new SchedulesModel();
    }

    /**
     * fetchInstructors
     * Fetch instructors from the database.
     */
    public function fetchInstructors()
    {
        $aInstructors = $this->oUsersModel->fetchInstructors();

        // Filter the data before returning to front-end.
        foreach ($aInstructors as $iKey => $aInstructor) {
            $aInstructors[$iKey]['fullName'] = $aInstructor['firstName'] . ' ' . $aInstructor['lastName'];
        }

        echo json_encode($aInstructors);
    }

    /**
     * addInstructor
     * Add an instructor to the database.
     */
    public function addInstructor()
    {
        $aValidationResult = Validations::validateInstructorInputs($this->aParams);
        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);

            // Perform insert.
            $iQuery = $this->oUsersModel->addInstructor($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Instructor added!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        }

        echo json_encode($aResult);
    }

    /**
     * updateInstructor
     * Fetch instructors from the database.
     */
    public function updateInstructor()
    {
        $aValidationResult = Validations::validateInstructorInputs($this->aParams);
        if ($aValidationResult['result'] === true) {
            // Declare an array with keys equivalent to that inside the database.
            $aDatabaseColumns = array(
                'instructorId'       => 'userId'
            );

            // Loop thru the POST data sent by AJAX for renaming.
            foreach ($aDatabaseColumns as $sKey => $mValue) {
                $this->aParams[$mValue] = $this->aParams[$sKey];
                unset($this->aParams[$sKey]);
            }

            Utils::sanitizeData($this->aParams);

            // Perform update.
            $iQuery = $this->oUsersModel->updateInstructor($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Instructor updated!'
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

    /**
     * enableDisableInstructor
     * Mark an instructor as active/inactive from the database.
     */
    public function enableDisableInstructor()
    {
        $oData = array(
            'userId' => $this->aParams['instructorId'],
            'status' => ($this->aParams['instructorAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Check if instructor still has upcoming trainings before disabling.
        if ($oData['status'] === 'Inactive') {
            $aSchedules = $this->oSchedulesModel->fetchSchedulesForSpecificInstructor(array_slice($oData, 0, 1));
            if (count($aSchedules) > 0) {
                echo json_encode(array(
                    'bResult'    => false,
                    'aSchedules' => $aSchedules
                ));
                exit;
            }
        }

        // Perform enabling/disabling.
        $iQuery = $this->oUsersModel->enableDisableInstructor($oData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Instructor ' . $this->aParams['instructorAction'] . 'd!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * changeInstructors
     * Change the instructors in behalf of the instructor to be disabled.
     */
    public function changeInstructors()
    {
        $aValidationResult = Validations::validateChangeInstructorInputs($this->aParams);

        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);

            // Perform update on schedules.
            $iQuery = $this->oSchedulesModel->changeInstructors($this->aParams['courseInstructors']);

            if ($iQuery > 0) {
                $aData = array(
                    'status' => ($this->aParams['instructorAction'] === 'disable') ? 'Inactive' : 'Active',
                    'userId' => $this->aParams['instructorId']
                );
                // Disable instructor.
                $iQuery = $this->oUsersModel->enableDisableInstructor($aData);

                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Instructor ' . $this->aParams['instructorAction'] . 'd!'
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

    /**
     * messageInstructor
     * Change the instructors in behalf of the instructor to be disabled.
     */
    public function messageInstructor()
    {
        $aValidationResult = Validations::validateMessageInstructorInputs($this->aParams);
        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);

            // Prepare email for sending to instructor.
            $aSendEmail = $this->processSendingEmailToInstructor($this->aParams);
            if ($aSendEmail === 1) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Message sent to instructor!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured while sending message.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * processSendingEmailToInstructor
     * Sends an email to an instructor.
     */
    private function processSendingEmailToInstructor($aInstructorDetails)
    {
        $oMail = new Email();
        $oMail->addSingleRecipient($aInstructorDetails['email'], $aInstructorDetails['fullName']);
        $oMail->setEmailSender('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
        $oMail->setTitle($aInstructorDetails['title']);
        if ($aInstructorDetails['file']['size'] > 0) {
            $oMail->addFileUploadAttachment($aInstructorDetails['file']);
        }
        $oMail->setBody($aInstructorDetails['msg']);
        return $oMail->send();
    }
}
