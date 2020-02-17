<?php

/**
 * Student
 * Class for student-related functionalities.
 */
class Student
{
    /**
     * @var array $aParams
     * Holder of request parameters sent by AJAX.
     */
    private $aParams;

    /**
     * @var StudentModel $oModel
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
            $this->sanitizeData();
            $this->prepareData('registration');

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
     * requestQuotation
     * Method for requesting quotation.
     */
    public function requestQuotation()
    {
        $aResult = array();
        $aValidationResult = Validations::validateRegistrationInputs($this->aParams);

        if ($aValidationResult['result'] === true) {
            $this->sanitizeData();
            $this->prepareData('sendEmail');

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
            $this->sanitizeData();
            $this->prepareData('sendEmail');

            // Add date field for dateSent column inside database.\
            $this->aParams[':dateSent'] = date('Y-m-d H:i:s');

            $oQueryResult = $this->oStudentModel->insertEmail($this->aParams);

            if ($oQueryResult === true) {
                $this->proceedSendingEmail();

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

    /**
     * sanitizeData
     * Method for santizing input data.
     */
    private function sanitizeData()
    {
        // Loop thru the array.
        foreach ($this->aParams as $sKey => $aValues) {
            // Perform htmlspecialchars() function on every values inside $this->aParams and trim whitespaces.
            $this->aParams[$sKey] = htmlspecialchars(trim($aValues));
        }
    }

    /**
     * prepareData
     * @param string $sInputRuleName
     * Method for preparing data for querying the database.
     */
    private function prepareData($sInputRuleName)
    {
        $aInputRules = array(
            'registration' => array(
                'validationRule' => Validations::$aRegistrationRules,
                'notRequiredInputs' => array(
                    ':middleName',
                    ':companyName'
                )
            ),
            'sendEmail'    => array(
                'validationRule' => Validations::$aSendEmailRules,
                'notRequiredInputs' => array(
                    ':middleName',
                )
            ),
            'quotation'    => array(
                'validationRule' => Validations::$aQuotationRules,
                'notRequiredInputs' => array(
                    ':middleName',
                    ':companyName'
                )
            )
        );

        // Remove empty array elements.
        $this->aParams = array_filter($this->aParams);

        // Loop thru the array.
        foreach ($aInputRules[$sInputRuleName]['validationRule'] as $aInputRule) {
            // Get the value.
            $sInput = $this->aParams[$aInputRule['sElement']];
            // Rename array keys and supply the value.
            $this->aParams[$aInputRule['sColumnName']] = $sInput;
            // Unset old keys.
            unset($this->aParams[$aInputRule['sElement']]);
            // Unset confirm password field.
            unset($this->aParams['registrationConfirmPassword']);
        }

        foreach ($aInputRules[$sInputRuleName]['notRequiredInputs'] as $sValue) {
            if (empty($this->aParams[$sValue]) === true) {
                $this->aParams[$sValue] = '';
            }
        }
    }

    private function proceedSendingEmail()
    {
        
    }
}
