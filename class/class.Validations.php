<?php

/**
 * Validations
 * Library class for validating input data.
 */
class Validations
{
    /**
     * @var array $aInputRules
     * Array of rules for validating inputs sent by AJAX.
     */
    public static $aInputRules = array(
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
            'sColumnName' => 'contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'oPattern'    => '/^[0-9]+$/'
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
     * validateRegistrationInputs
     * Method for validating inputs sent by AJAX.
     * @return array
     */
    public static function validateRegistrationInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['registrationMname'])) !== 0) {
            array_push(self::$aInputRules, array(
                'sName'       => 'Middle name',
                'sElement'    => 'registrationMname',
                'sColumnName' => 'middleName',
                'iMinLength'  => 2,
                'iMaxLength'  => 30,
                'oPattern'    => '/^[a-zA-Z\s\.]+$/'
            ));
        }
        if (strlen(trim($aParams['registrationCompanyName'])) !== 0) {
            array_push(self::$aInputRules, array(
                'sName'       => 'Company name',
                'sElement'    => 'registrationCompanyName',
                'sColumnName' => 'companyName',
                'iMinLength'  => 4,
                'iMaxLength'  => 50,
                'oPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aInputRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);

            if (strlen($sInput) < $aInputRule['iMinLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '#' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be minimum of ' . $aInputRule['iMinLength'] . ' characters.'
                );
                break;
            }
            if (strlen($sInput) > $aInputRule['iMaxLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '#' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be maximum of ' . $aInputRule['iMaxLength'] . ' characters.'
                );
                break;
            }
            if (($aInputRule['sElement'] !== 'registrationPassword') && (!preg_match($aInputRule['oPattern'], $sInput))) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '#' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        // Check if passwords are equal.
        if ($aParams['registrationPassword'] !== $aParams['registrationConfirmPassword']) {
            $aValidationResult = array(
                'result'  => false,
                'element' => '#' . $aInputRule['sElement'],
                'msg'     => 'Passwords do not match.'
            );
        }

        // Return the result of the validation.
        return $aValidationResult;
    }
}