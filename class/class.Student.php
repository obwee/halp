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
            $this->prepareData();
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

    }

    /**
     * sendEmail
     * Method for sending email.
     */
    public function sendEmail()
    {

    }

    /**
     * sanitizeData
     * Method for santizing input data.
     */
    private function sanitizeData()
    {
        // Loop thru the array.
        foreach ($this->aParams as $sKey => $aValues) {
            // Perform htmlspecialchars() function on every values inside $this->aParams
            $this->aParams[$sKey] = htmlspecialchars($aValues);
        }
    }

    /**
     * prepareData
     * Method for preparing data for querying the database.
     */
    private function prepareData()
    {
        // Remove empty array elements.
        $this->aParams = array_filter($this->aParams);

        // Loop thru the array.
        foreach (Validations::$aInputRules as $aInputRule) {
            // Get the value.
            $sInput = $this->aParams[$aInputRule['sElement']];
            // Rename array keys and supply the value.
            $this->aParams[$aInputRule['sColumnName']] = $sInput;
            // Unset old keys.
            unset($this->aParams[$aInputRule['sElement']]);
            // Unset confirm password field.
            unset($this->aParams['registrationConfirmPassword']);
        }

        // Insert position field.
        $this->aParams[':position'] = 'Student';
    }
}
