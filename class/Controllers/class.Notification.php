<?php

class Notification extends BaseController
{

    protected $aNotificationType = array(
        'enrollment request',
        'cancelled enrollment',
        'payment submitted',
        'payment rejected',
        'refund approved',
        'refund rejected',
        'quotation requested',
        'quotation approved'
    );

    protected $aNotificationIcon = array(
        'fa fa-user text-aqua',
        'fa fa-user text-aqua',
        'fa fa-user text-aqua',
        'fa fa-user text-aqua',
        'fa fa-user text-aqua',
        'fa fa-user text-aqua',
        'fa fa-user text-aqua',
        'fa fa-user text-aqua'
    );
    

    /**
     * Notification constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        parent::__construct();
    }

    /**
     * fetchNotifications
     * Fetch notifications from the database.
     */
    public function fetchNotifications()
    {
        $aNotifications = $this->oNotificationModel->fetchNotifications();

        if (empty($aNotifications) === true) {
            echo json_encode([]);
            exit();
        }

        foreach ($aNotifications as $iKey => $aValue) {
            $aStudentIds[$aValue['studentId']] = $aValue['studentId'];
        }

        $aStudentDetails = $this->oStudentModel->getStudentsDetails(array_values($aStudentIds));

        foreach ($aNotifications as $iKey => $aValue) {
            $iStudentKey = Utils::searchKeyByValueInMultiDimensionalArray($aValue['studentId'], $aStudentDetails, 'studentId');

            $aReturnData[$iKey]['notifText'] = $aStudentDetails[$iStudentKey]['studentName'];
            $aReturnData[$iKey]['notifText'] .= ' has ' . $this->aNotificationType[$aValue['type']];
            $aReturnData[$iKey]['notifText'] .= ' for ' . $aValue['courseCode'] . '.';

            $aReturnData[$iKey]['notifDate'] = $aValue['date'];
            $aReturnData[$iKey]['notifIcon'] = $this->aNotificationIcon[$aValue['type']];

            $aReturnData[$iKey]['scheduleId'] = $aValue['scheduleId'];
            $aReturnData[$iKey]['notifType'] = $aValue['type'];
        }

        echo json_encode($aReturnData);
    }
}
