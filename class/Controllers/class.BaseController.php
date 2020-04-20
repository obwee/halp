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

    protected $aApprovalStatus = array(
        'Not Yet Approved',
        'Approved',
        'Rejected'
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

    protected function getUserId()
    {
        return $this->oStudentModel->getUserIdByUsername(Session::get('username'));
    }

    protected function getUserIdOfQuoteRequester($sFirstName, $sLastName)
    {
        return $this->oStudentModel->getUserIdByFirstAndLastName($sFirstName, $sLastName);
    }

    protected function getUserDetails($iStudentId)
    {
        return $this->oStudentModel->getUserDetails(['userId' => $iStudentId]);
    }

    /**
     * getInterval
     */
    protected function getInterval($aCourseDetails)
    {
        if ($aCourseDetails['recurrence'] !== 'none') {
            $iInterval = $aCourseDetails['numRepetitions'] . ' ' . Utils::getDayName($aCourseDetails['fromDate']) . 's';
        } else {
            $iInterval = ((strtotime($aCourseDetails['toDate']) - strtotime($aCourseDetails['fromDate'])) / 86400) + 1;
            $iInterval .= ($iInterval === 1) ? ' Day' : ' Days';
        }
        return $iInterval;
    }

    /**
     * changeEndDateIfRecurring
     */
    protected function changeEndDateIfRecurring($aSchedule)
    {
        if (isset($aSchedule['recurrence']) === true && $aSchedule['recurrence'] === 'weekly') {
            // Add number of repetitions as weeks for event recursion.
            $oEndDate = new DateTime($aSchedule['fromDate']);
            $oEndDate->modify('+' . $aSchedule['numRepetitions'] - 1 . ' week');
            $aSchedule['toDate'] = $oEndDate->format('Y-m-d');
        }
        return $aSchedule['toDate'];
    }
}
