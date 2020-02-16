<?php

/**
 * Register
 * Class for registering a student.
 */
class Register
{
    /**
     * @var array $aParams
     * Holder of request variables sent by AJAX.
     */
    private $aParams;

    /**
     * Register constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
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
            $aResult = $this->insertData();
        } else {
            $aResult = $aValidationResult;
        }
        echo json_encode($aResult);
    }

    /**
     * sanitizeData
     * Method for performing htmlspecialchars() function on every values inside $this->aParams.
     */
    private function sanitizeData()
    {
        foreach ($this->aParams as $sKey => $aValues) {
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
        $this->aParams['position'] = 'Student';
    }

    private function insertData()
    {
        return $this->aParams;
    }
}
