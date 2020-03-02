<?php

/**
 * Student
 * Class for student-related functionalities.
 */
class Student extends BaseController
{
    /**
     * @var StudentModel $oStudentModel
     * Class instance for Student model.
     */
    private $oStudentModel;

    /**
     * Student constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the StudentModel class and store it inside $this->oStudentModel.
        $this->oStudentModel = new StudentModel();
    }

    /**
     * registerStudent
     * Method for registering student.
     */
    public function registerStudent()
    {
        $aResult = array();
        $aValidationResult = Validations::validateRegistrationInputs($this->aParams);

        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);
            Utils::prepareData($this->aParams, 'registration');

            // Insert position field.
            $this->aParams[':position'] = 'Student';

            if ($this->oStudentModel->checkUsernameIfTaken($this->aParams[':username']) > 0) {
                $aResult = array(
                    'result' => false,
                    'msg'    => 'Username already taken.'
                );
            } else {
                $oQueryResult = $this->oStudentModel->insertStudent($this->aParams);

                if ($oQueryResult === true) {
                    $aResult = array(
                        'result' => true,
                        'msg'    => 'Successfully registered!'
                    );
                } else {
                    $aResult = array(
                        'result' => false,
                        'msg'    => 'An error has occurred. Please try again.'
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
        $aResult = array();
        $aValidationResult = Validations::validateEmailInputs($this->aParams);

        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);
            Utils::prepareData($this->aParams, 'sendEmail');

            // Add date field for dateSent column inside database.\
            $this->aParams[':dateSent'] = date('Y-m-d H:i:s');

            $oQueryResult = $this->oStudentModel->insertEmail($this->aParams);

            if ($oQueryResult === true && $this->proceedSendingEmail() === 1) {
                $aResult = array(
                    'result' => true,
                    'msg'    => 'Email sent!'
                );
            } else {
                $aResult = array(
                    'result' => false,
                    'msg'    => 'An error has occurred. Please try again.'
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
}
