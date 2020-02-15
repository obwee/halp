<?php

/**
 * Register
 * Class for registering a student.
 */
class Register
{
    /**
     * @var array $aParams
     */
    private $aParams;

    /**
     * @var array $aInputRules
     * Array of rules for validating inputs sent by AJAX.
     */
    private $aInputRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'registrationFname',
            'sColumnName' => 'firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'registrationLname',
            'sColumnName' => 'lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'registrationContactNum',
            'sColumnName' => 'contactNumber',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Company name',
            'sElement'    => 'registrationCompany',
            'sColumnName' => 'companyName',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'oPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'registrationEmail',
            'sColumnName' => 'email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'oPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Username',
            'sElement'    => 'registrationUsername',
            'sColumnName' => 'username',
            'iMinLength'  => 4,
            'iMaxLength'  => 15,
            'oPattern'    => '/^(?![0-9_])\w+$/'
        ),
        array(
            'sName'       => 'Password',
            'sElement'    => 'registrationPassword',
            'sColumnName' => 'password',
            'iMinLength'  => 4,
            'iMaxLength'  => 30
        )
    );

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
     * @return json
     */
    public function registerStudent()
    {
        $aResult = array();
        $aValidationResult = $this->validateInputs();

        if ($aValidationResult['result'] === true) {
            $this->sanitizeData();
            $this->prepareData();
        } else {
            $aResult = $aValidationResult;
        }
        echo json_encode($aResult);
    }

    /**
     * validateInputs
     * Method for validating inputs sent by AJAX.
     * @return array
     */
    private function validateInputs()
    {
        $aValidationResult = array(
            'result' => true
        );

        if (strlen(trim($this->aParams['registrationMname'])) !== 0) {
            array_push($this->aInputRules, array(
                'sName'       => 'Middle name',
                'sElement'    => 'registrationMname',
                'sColumnName' => 'middleName',
                'iMinLength'  => 2,
                'iMaxLength'  => 30,
                'oPattern'    => '/^[a-zA-Z\s\.]+$/'
            ));
        }

        foreach ($this->aInputRules as $aInputRule) {
            $sInput = trim($this->aParams[$aInputRule['sElement']]);

            if (strlen($sInput) < $aInputRule['iMinLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be minimum of ' . $aInputRule['iMinLength'] . ' characters.'
                );
                break;
            }
            if (strlen($sInput) > $aInputRule['iMaxLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be maximum of ' . $aInputRule['iMaxLength'] . ' characters.'
                );
                break;
            }
            if (($aInputRule['sElement'] !== 'registrationPassword') && (!preg_match($aInputRule['oPattern'], $sInput))) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        if ($this->aParams['registrationPassword'] !== $this->aParams['registrationConfirmPassword']) {
            $aValidationResult = array(
                'result'  => false,
                'element' => $aInputRule['sElement'],
                'msg'     => 'Passwords do not match.'
            );
        }

        return $aValidationResult;
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
        foreach ($this->aInputRules as $aInputRule) {
            $sInput = $this->aParams[$aInputRule['sElement']];
            $this->aParams[$aInputRule['sColumnName']] = $sInput;
            unset($this->aParams[$aInputRule['sElement']]);
        }
        print_r($this->aParams);
    }
}
