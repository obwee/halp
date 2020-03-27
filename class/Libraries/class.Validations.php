<?php

/**
 * Validations
 * Class library for validating input data.
 */
class Validations
{
    /**
     * @var array $aRegistrationRules
     * Array of rules for validating registration inputs sent by AJAX.
     */
    public static $aRegistrationRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'registrationFname',
            'sColumnName' => ':firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'registrationLname',
            'sColumnName' => ':lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'registrationContactNum',
            'sColumnName' => ':contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'registrationEmail',
            'sColumnName' => ':email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'oPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Username',
            'sElement'    => 'registrationUsername',
            'sColumnName' => ':username',
            'iMinLength'  => 4,
            'iMaxLength'  => 15,
            'oPattern'    => '/^(?![0-9_])\w+$/'
        ),
        array(
            'sName'       => 'Password',
            'sElement'    => 'registrationPassword',
            'sColumnName' => ':password',
            'iMinLength'  => 4,
            'iMaxLength'  => 30
        )
    );

    /**
     * @var array $aSendEmailRules
     * Array of rules for validating inputs for emailing sent by AJAX.
     */
    public static $aSendEmailRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'emailFname',
            'sColumnName' => ':firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'emailLname',
            'sColumnName' => ':lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'emailAddress',
            'sColumnName' => ':email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'oPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Email title',
            'sElement'    => 'emailTitle',
            'sColumnName' => ':title',
            'iMinLength'  => 4,
            'iMaxLength'  => 30,
            'oPattern'    => '/.+/'
        ),
        array(
            'sName'       => 'Email message',
            'sElement'    => 'emailMsg',
            'sColumnName' => ':message',
            'iMinLength'  => 4,
            'iMaxLength'  => 255,
            'oPattern'    => '/.+/'
        )
    );


    /**
     * @var array $aQuotationRules
     * Array of rules for validating quotation inputs sent by AJAX.
     */
    public static $aQuotationRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'quoteFname',
            'sColumnName' => ':firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'quoteLname',
            'sColumnName' => ':lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'quoteContactNum',
            'sColumnName' => ':contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'quoteEmail',
            'sColumnName' => ':email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'oPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        ),
        array(
            'sName'       => 'Course',
            'sElement'    => 'quoteCourses',
            'sColumnName' => ':quoteCourses',
            'iMinLength'  => 0,
            'iMaxLength'  => PHP_INT_MAX,
            'oPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aQuoteToEditRules
     * Array of rules for validating quotation inputs sent by AJAX for alteration.
     */
    public static $aQuoteToEditRules = array(
        array(
            'sName'       => 'Course',
            'sElement'    => 'quoteCourses',
            'sColumnName' => ':quoteCourses',
            'iMinLength'  => 0,
            'iMaxLength'  => PHP_INT_MAX,
            'oPattern'    => '/.+/'
        )
    );

    /**
     * @var array $aAddUpdateCourseRules
     * Array of rules for validating course inputs sent by AJAX.
     */
    public static $aAddUpdateCourseRules = array(
        array(
            'sName'       => 'Course code',
            'sElement'    => 'courseCode',
            'sColumnName' => ':courseCode',
            'iMinLength'  => 2,
            'iMaxLength'  => 10,
            'oPattern'    => '/^[a-zA-Z0-9&\-\s\.]+$/'
        ),
        array(
            'sName'       => 'Course title',
            'sElement'    => 'courseTitle',
            'sColumnName' => ':courseName',
            'iMinLength'  => 2,
            'iMaxLength'  => 50,
            'oPattern'    => '/^[a-zA-Z0-9&\-\s\.]+$/'
        ),
        array(
            'sName'       => 'Course details',
            'sElement'    => 'courseDetails',
            'sColumnName' => ':courseDescription',
            'iMinLength'  => 0,
            'iMaxLength'  => 50,
            'oPattern'    => '/^[a-zA-Z0-9&\-\s\.]+$/'
        ),
    );

    public static $aScheduleRules = array(
        array(
            'sName'       => 'Schedule',
            'sElement'    => 'iScheduleId',
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Course title',
            'sElement'    => 'iCourseId',
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Venue',
            'sElement'    => 'iVenueId',
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Start date',
            'sElement'    => 'sStart',
            'oPattern'    => '/^\d{4}-\d{2}-\d{2}/'
        ),
        array(
            'sName'       => 'End date',
            'sElement'    => 'sEnd',
            'oPattern'    => '/^\d{4}-\d{2}-\d{2}/'
        ),
        array(
            'sName'       => 'Instructor name',
            'sElement'    => 'iInstructorId',
            'oPattern'    => '/^[0-9]+$/'
        )
    );

    public static $aInstructorRules = array(
        array(
            'sName'       => 'First name',
            'sElement'    => 'firstName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Last name',
            'sElement'    => 'lastName',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Contact number',
            'sElement'    => 'contactNum',
            'iMinLength'  => 7,
            'iMaxLength'  => 12,
            'oPattern'    => '/^[0-9]+$/'
        ),
        array(
            'sName'       => 'Email address',
            'sElement'    => 'email',
            'iMinLength'  => 4,
            'iMaxLength'  => 50,
            'oPattern'    => '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD'
        )
    );

    public static $aMessageInstructorRules = array(
        array(
            'sName'       => 'Email title',
            'sElement'    => 'title',
            'iMinLength'  => 2,
            'iMaxLength'  => 30,
            'oPattern'    => '/^[a-zA-Z\s\.]+$/'
        ),
        array(
            'sName'       => 'Email message',
            'sElement'    => 'msg',
            'iMinLength'  => 4,
            'iMaxLength'  => 255,
            'oPattern'    => '/.+/'
        )
    );

    /**
     * validateRegistrationInputs
     * Method for validating registration inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateRegistrationInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['registrationMname'])) !== 0) {
            array_splice(self::$aRegistrationRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'registrationMname',
                    'sColumnName' => ':middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'oPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }
        if (strlen(trim($aParams['registrationCompanyName'])) !== 0) {
            array_splice(self::$aRegistrationRules, 4, 0, array(
                array(
                    'sName'       => 'Company name',
                    'sElement'    => 'registrationCompanyName',
                    'sColumnName' => ':companyName',
                    'iMinLength'  => 4,
                    'iMaxLength'  => 50,
                    'oPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aRegistrationRules as $aInputRule) {
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

    /**
     * validateEmailInputs
     * Method for validating email-sending inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateEmailInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        // Add rules for optional fields if filled-up.
        if (strlen(trim($aParams['emailMname'])) !== 0) {
            array_splice(self::$aSendEmailRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'emailMname',
                    'sColumnName' => ':middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'oPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aSendEmailRules as $aInputRule) {
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
            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '#' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateQuotationInputs
     * Method for validating quotation inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateQuotationInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        // Add rules for optional fields if filled-up.
        if (empty($aParams['quoteMname']) === false) {
            array_splice(self::$aQuotationRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'quoteMname',
                    'sColumnName' => ':middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'oPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }
        if (empty($aParams['quoteCompanyName']) === false) {
            array_splice(self::$aQuotationRules, 2, 0, array(
                array(
                    'sName'       => 'Company name',
                    'sElement'    => 'quoteCompanyName',
                    'sColumnName' => ':companyName',
                    'iMinLength'  => 4,
                    'iMaxLength'  => 50,
                    'oPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aQuotationRules as $aInputRule) {
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
            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '#' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        if (empty($aParams['quoteBillToCompany']) === false) {
            array_push(self::$aQuotationRules, array(
                'sElement'    => 'quoteBillToCompany',
                'sColumnName' => ':quoteBillToCompany'
            ));

            if ($aParams['quoteBillToCompany'] === 1 && empty($aParams['quoteCompanyName']) === true) {
                return array(
                    'result'  =>  false,
                    'element' =>  '#quoteCompanyName',
                    'msg'     => 'Please specify company name if billing to company.'
                );
            }
        }

        $sNumPaxRegex = '/^(?!-\d+|0)\d+$/';

        foreach ($aParams['numPax'] as $iNumPax) {
            if ($iNumPax < 1 || $iNumPax > 100 || !preg_match($sNumPaxRegex, $iNumPax)) {
                return array(
                    'result'  =>  false,
                    'element' =>  '#numPax',
                    'msg'     => 'Invalid value for number of persons.'
                );
            }
        }

        if (empty($aParams['quoteSchedules']) === false) {
            array_push(self::$aQuotationRules, array(
                'sElement'    => 'quoteSchedules',
                'sColumnName' => ':quoteSchedules'
            ));
        }

        array_push(self::$aQuotationRules, array(
            'sElement'    => 'quoteNumPax',
            'sColumnName' => ':quoteNumPax'
        ));

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateQuotationInputsForEdit
     * Method for validating quotation inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateQuotationInputsForEdit($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        if (empty($aParams['quoteCompanyName']) === false) {
            array_splice(self::$aQuoteToEditRules, 2, 0, array(
                array(
                    'sName'       => 'Company name',
                    'sElement'    => 'quoteCompanyName',
                    'sColumnName' => ':companyName',
                    'iMinLength'  => 4,
                    'iMaxLength'  => 50,
                    'oPattern'    => '/^[a-zA-Z0-9\s\.]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aQuoteToEditRules as $aInputRule) {
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
            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '#' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        if (empty($aParams['quoteBillToCompany']) === false) {
            array_push(self::$aQuoteToEditRules, array(
                'sElement'    => 'quoteBillToCompany',
                'sColumnName' => ':quoteBillToCompany'
            ));

            if ($aParams['quoteBillToCompany'] === 1 && empty($aParams['quoteCompanyName']) === true) {
                return array(
                    'result'  =>  false,
                    'element' =>  '#quoteCompanyName',
                    'msg'     => 'Please specify company name if billing to company.'
                );
            }
        }

        $sNumPaxRegex = '/^(?!-\d+|0)\d+$/';

        foreach ($aParams['numPax'] as $iNumPax) {
            if ($iNumPax < 1 || $iNumPax > 100 || !preg_match($sNumPaxRegex, $iNumPax)) {
                return array(
                    'result'  =>  false,
                    'element' =>  '#numPax',
                    'msg'     => 'Invalid value for number of persons.'
                );
            }
        }

        if (empty($aParams['quoteSchedules']) === false) {
            array_push(self::$aQuoteToEditRules, array(
                'sElement'    => 'quoteSchedules',
                'sColumnName' => ':quoteSchedules'
            ));
        }

        array_push(self::$aQuoteToEditRules, array(
            'sElement'    => 'quoteNumPax',
            'sColumnName' => ':quoteNumPax'
        ));

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateAddUpdateCourseInputs
     * Method for validating add course inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateAddUpdateCourseInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'bResult' => true
        );

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aAddUpdateCourseRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);

            if (strlen($sInput) < $aInputRule['iMinLength']) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => '.' . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' must be minimum of ' . $aInputRule['iMinLength'] . ' characters.'
                );
                break;
            }
            if (strlen($sInput) > $aInputRule['iMaxLength']) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => '.' . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' must be maximum of ' . $aInputRule['iMaxLength'] . ' characters.'
                );
                break;
            }
            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'bResult'  => false,
                    'sElement' => '.' . $aInputRule['sElement'],
                    'sMsg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        if ($aValidationResult['bResult'] === true) {
            if (empty($aParams['courseAmount']) === true || $aParams['courseAmount'] <= 0) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.courseAmount',
                    'sMsg'     => 'Course amount cannot be empty/zero.'
                );
            }
            if (!preg_match('/^[0-9]+$/', $aParams['courseAmount'])) {
                return array(
                    'bResult'  => false,
                    'sElement' => '.courseAmount',
                    'sMsg'     => 'Invalid course amount.'
                );
            }
        }

        // Add course amount inside the $aAddCourseRules array for data preparation.
        array_push(self::$aAddUpdateCourseRules, array(
            'sElement'    => 'courseAmount',
            'sColumnName' => ':coursePrice'
        ));

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateScheduleInputs
     * Method for validating schedule inputs sent by AJAX.
     * @param string $sAction = 'Update'
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateScheduleInputs($aParams, $sAction = 'Update')
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        if ($sAction === 'Insert') {
            // Remove the rule for iScheduleId.
            unset(self::$aScheduleRules[0]);
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aScheduleRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);

            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        $sNumSlotsRegex = '/^(?!-\d+|0)\d+$/';

        if ($aParams['iSlots'] < 1 || $aParams['iSlots'] > 100 || !preg_match($sNumSlotsRegex, $aParams['iSlots'])) {
            return array(
                'result'  =>  false,
                'element' =>  '.numSlots',
                'msg'     => 'Invalid value for number of slots.'
            );
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateInstructorInputs
     * Method for validating instruction inputs sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateInstructorInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        // Add rules for optional fields if filled-up.
        if (isset($aParams['instructorId']) === true && strlen(trim($aParams['instructorId'])) !== 0) {
            array_splice(self::$aInstructorRules, 1, 0, array(
                array(
                    'sName'       => 'Instructor',
                    'sElement'    => 'instructorId',
                    'iMinLength'  => 0,
                    'iMaxLength'  => PHP_INT_MAX,
                    'oPattern'    => '/^[0-9]+$/'
                ),
            ));
        }
        if (strlen(trim($aParams['middleName'])) !== 0) {
            array_splice(self::$aInstructorRules, 1, 0, array(
                array(
                    'sName'       => 'Middle name',
                    'sElement'    => 'middleName',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'oPattern'    => '/^[a-zA-Z\s\.]+$/'
                )
            ));
        }
        if (strlen(trim($aParams['certificationTitle'])) !== 0) {
            array_splice(self::$aInstructorRules, 1, 0, array(
                array(
                    'sName'       => 'Certification title',
                    'sElement'    => 'certificationTitle',
                    'iMinLength'  => 2,
                    'iMaxLength'  => 30,
                    'oPattern'    => '/^[a-zA-Z0-9,\-\s]+$/'
                )
            ));
        }

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aInstructorRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);

            if (strlen($sInput) < $aInputRule['iMinLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be minimum of ' . $aInputRule['iMinLength'] . ' characters.'
                );
                break;
            }
            if (strlen($sInput) > $aInputRule['iMaxLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be maximum of ' . $aInputRule['iMaxLength'] . ' characters.'
                );
                break;
            }
            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateChangeInstructorInputs
     * Method for validating instruction inputs to be changed sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateChangeInstructorInputs($aParams)
    {
        foreach ($aParams['courseInstructors'] as $iScheduleId => $iInstructorId) {
            // Check if the values are not a digit.
            if (!preg_match('/^[\d]/', $iScheduleId)) {
                return array(
                    'result'  => false,
                    'element' => '.courseInstructors',
                    'msg'     => 'Invalid instructor.'
                );
            }
            if (!preg_match('/^[\d]/', $iInstructorId)) {
                return array(
                    'result'  => false,
                    'element' => '.courseInstructors',
                    'msg'     => 'Invalid instructor.'
                );
            }
        }

        return array(
            'result' => true
        );
    }

    /**
     * validateMessageInstructorInputs
     * Method for validating instruction inputs to be changed sent by AJAX.
     * @param array $aParams
     * @return array $aValidationResult
     */
    public static function validateMessageInstructorInputs($aParams)
    {
        // Prepare the validation result.
        $aValidationResult = array(
            'result' => true
        );

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        foreach (self::$aMessageInstructorRules as $aInputRule) {
            $sInput = trim($aParams[$aInputRule['sElement']]);

            if (strlen($sInput) < $aInputRule['iMinLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be minimum of ' . $aInputRule['iMinLength'] . ' characters.'
                );
                break;
            }
            if (strlen($sInput) > $aInputRule['iMaxLength']) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' must be maximum of ' . $aInputRule['iMaxLength'] . ' characters.'
                );
                break;
            }
            if (!preg_match($aInputRule['oPattern'], $sInput)) {
                $aValidationResult = array(
                    'result'  => false,
                    'element' => '.' . $aInputRule['sElement'],
                    'msg'     => $aInputRule['sName'] . ' input is invalid.'
                );
                break;
            }
        }

        if ($aValidationResult['result'] === true && $aParams['file']['size'] !== 0) {
            $aValidationResult = self::validateFileForMessagingInstructor($aParams['file']);
        }

        // Return the result of the validation.
        return $aValidationResult;
    }

    /**
     * validateFileForMessagingInstructor
     * Validates the file uploaded for messaging instructor.
     * @param array $aFile (The file object.)
     * @return array $aFileValidation (Result of the validation.)
     */
    private static function validateFileForMessagingInstructor($aFile)
    {
        $aFileValidation = array(
            'result' => true
        );

        if ($aFile['type'] !== 'application/pdf') {
            $aFileValidation = array(
                'result'  => false,
                'element' => '.file',
                'msg'     => 'File must be PDF.'
            );
        }
        if ($aFile['size'] > 10485760) {
            $aFileValidation = array(
                'result'  => false,
                'element' => '.file',
                'msg'     => 'File must not exceed 10 MB.'
            );
        }

        return $aFileValidation;
    }
}
