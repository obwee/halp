<?php

/**
 * Utils
 * Class library for utility functions.
 */
class Utils
{

    /**
     * sortByDate
     * Sort a multidimensional array by date using usort.
     * @param array $aData (Passed by reference)
     * @return $aData
     */
    public static function sortByDate(&$aData)
    {
        return usort($aData, fn($aFirstElement, $aSecondElement) =>
            strtotime($aFirstElement['dateRequested']) - strtotime($aSecondElement['dateRequested'])
        );
    }

    /**
     * sanitizeData
     * @param array &$aParams (Passed by reference)
     * Method for santizing input data.
     */
    public static function sanitizeData(&$aParams)
    {
        // Loop thru the array.
        foreach ($aParams as $sKey => $aValues) {
            // Perform htmlspecialchars() function on every values inside $aParams and trim whitespaces.
            if (is_array($aValues)) {
                continue;
            }
            $aParams[$sKey] = nl2br(strip_tags(htmlspecialchars(trim($aValues))));
        }
    }

    /**
     * prepareData
     * @param array &$aParams (Passed by reference)
     * @param string $sInputRuleName
     * Method for preparing data for querying the database.
     */
    public static function prepareData(&$aParams, $sInputRuleName)
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
                    ':companyName',
                    ':quoteBillToCompany',
                    ':quoteSchedules'
                )
            )
        );

        // Remove empty array elements.
        $aParams = array_filter($aParams);

        foreach ($aInputRules[$sInputRuleName]['notRequiredInputs'] as $sValue) {
            if (empty($aParams[$sValue]) === true) {
                $aParams[$sValue] = '';
            }
        }

        // Loop thru the array.
        foreach ($aInputRules[$sInputRuleName]['validationRule'] as $aInputRule) {
            // Get the value.
            $sInput = $aParams[$aInputRule['sElement']];
            // Rename array keys and supply the value.
            $aParams[$aInputRule['sColumnName']] = $sInput;
            // Unset old keys.
            unset($aParams[$aInputRule['sElement']]);
            // Unset confirm password field.
            unset($aParams['registrationConfirmPassword']);
        }

        if ($sInputRuleName === 'quotation') {
            $aParams[':quoteCourses']   = explode(',', $aParams[':quoteCourses']);
            $aParams[':quoteSchedules'] = explode(',', $aParams[':quoteSchedules']);
            $aParams[':quoteNumPax'] = explode(',', $aParams[':quoteNumPax']);
        }
    }

}