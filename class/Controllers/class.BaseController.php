<?php

/**
 * BaseController
 */
class BaseController
{
    /**
     * @var StudentModel $oStudentModel
     */
    protected $oStudentModel;

    /**
     * @var NotificationModel $oNotificationModel
     */
    protected $oNotificationModel;

    /**
     * @var PaymentModel $oPaymentModel
     */
    protected $oPaymentModel;

    /**
     * @var array $aPaymentStatus
     * Holder of payment statuses depending on isPaid value.
     */
    protected $aPaymentStatus = array(
        'Not Yet Paid',
        'Partially Paid',
        'Fully Paid'
    );

    /**
     * @var array $aApprovalStatus
     * Holder of payment approval statuses depending on isApproved value.
     */
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
        $this->oStudentModel = new StudentModel();
        $this->oNotificationModel = new NotificationModel();
        $this->oPaymentModel = new PaymentModel();

        $this->oPaymentModel->updateUnsettledPayments();
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
