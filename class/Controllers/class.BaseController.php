<?php

/**
 * BaseController
 */
class BaseController
{

    protected $oStudentModel;

    protected $aPaymentStatus = array(
        'Not Yet Paid',
        'Partially Paid',
        'Fully Paid'
    );

    /**
     * @var array $aParams
     * Holder of request parameters sent by AJAX.
     */
    protected $aParams;

    public function __construct()
    {
        // Instantiate the StudentModel class and store it inside $this->oStudentModel.
        $this->oStudentModel = new StudentModel();
    }

    protected function getUserId() {
        return $this->oStudentModel->getUserIdByUsername(Session::get('username'));
    }

    protected function getUserIdOfQuoteRequester($sFirstName, $sLastName) {
        return $this->oStudentModel->getUserIdByFirstAndLastName($sFirstName, $sLastName);
    }

    protected function unsetKeys(&$aData, $aUnnecessaryData)
    {
        foreach ($aUnnecessaryData as $sKey) {
            unset($aData[$sKey]);
        }
    }

    /**
     * getInterval
     */
    protected function getInterval($aCourseDetails)
    {
        if ($aCourseDetails['recurrence'] !== 'none') {
            $iInterval = $aCourseDetails['numRepetitions'] . ' ' . Utils::getDayName($aCourseDetails['fromDate']) . 's';
        } else {
            $iInterval = ((strtotime($aCourseDetails['fromDate']) - strtotime($aCourseDetails['fromDate'])) / 86400) + 1;
            $iInterval .= ($iInterval === 1) ? ' day' : ' days';
        }
        return $iInterval;
    }
}