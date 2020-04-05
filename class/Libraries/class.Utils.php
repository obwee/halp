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
        return usort(
            $aData,
            fn ($aFirstElement, $aSecondElement) =>
            strtotime($aFirstElement['dateRequested']) - strtotime($aSecondElement['dateRequested'])
        );
    }

    /**
     * sanitizeData
     * Method for santizing input data.
     * @param array &$aParams (Passed by reference)
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
     * Method for preparing data for querying the database.
     * @param array &$aParams (Passed by reference)
     * @param string $sInputRuleName
     */
    public static function prepareData(&$aParams, $sInputRuleName)
    {
        $aInputRules = array(
            'registration'    => array(
                'validationRule'    => Validations::$aRegistrationRules,
                'notRequiredInputs' => array(
                    ':middleName',
                    ':companyName'
                )
            ),
            'sendEmail'       => array(
                'validationRule'    => Validations::$aSendEmailRules,
                'notRequiredInputs' => array(
                    ':middleName',
                )
            ),
            'quotation'       => array(
                'validationRule'    => Validations::$aQuotationRules,
                'notRequiredInputs' => array(
                    ':middleName',
                    ':companyName',
                    ':quoteBillToCompany',
                    ':quoteSchedules'
                )
            ),
            'updateQuotation' => array(
                'validationRule'    => Validations::$aQuoteToEditRules,
                'notRequiredInputs' => array(
                    ':companyName',
                    ':quoteBillToCompany',
                    ':quoteSchedules'
                )
            ),
            'addUpdateCourse'  => array(
                'validationRule'    => Validations::$aAddUpdateCourseRules,
                'notRequiredInputs' => array(
                    'courseDetails'
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
            // Unset confirm password field, if any.
            unset($aParams['registrationConfirmPassword']);
        }

        if (in_array($sInputRuleName, ['quotation', 'updateQuotation'])) {
            $aParams[':quoteCourses']   = explode(',', $aParams[':quoteCourses']);
            $aParams[':quoteSchedules'] = explode(',', $aParams[':quoteSchedules']);
            $aParams[':quoteNumPax'] = explode(',', $aParams[':quoteNumPax']);
            unset($aParams['numPax']);
        }
    }

    /**
     * renameKeys
     * @param array &$aParams (Passed by reference)
     * @param string $sInputRuleName
     * Method for preparing data for querying the database.
     */
    public static function renameKeys(&$aParams, $aKeys)
    {
        // Loop thru the POST data sent by AJAX for renaming.
        foreach ($aKeys as $sKey => $mValue) {
            if (empty($aParams[$sKey]) === true) {
                // $aParams[$sKey] = '';
                continue;
            }
            $aParams[$mValue] = $aParams[$sKey];
            unset($aParams[$sKey]);
        }
    }

    /**
     * generateRandomString
     * Method for generating random string of 20 characters.
     */
    public static function generateRandomString()
    {
        return bin2hex(random_bytes(10));
    }

    /**
     * searchKeyByValueInMultiDimensionalArray
     * @return mixed
     */
    public static function searchKeyByValueInMultiDimensionalArray($mNeedle, $aHaystack, $sColumnToSearch)
    {
        return array_search($mNeedle, array_column($aHaystack, $sColumnToSearch));
    }

    /**
     * unsetUnnecessaryData
     */
    public static function unsetUnnecessaryData(&$aData, $aColumnsToUnset)
    {
        foreach ($aData as $iDataKey => $aDetails) {
            foreach ($aColumnsToUnset as $sKeyToUnset) {
                unset($aData[$iDataKey][$sKeyToUnset]);
            }
        }
    }

    /**
     * getDayName
     */
    public static function getDayName($sDate)
    {
        return date('l', strtotime($sDate));
    }
}
