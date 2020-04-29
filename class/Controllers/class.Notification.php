<?php

class Notification extends BaseController
{

    protected $aNotificationType = array(
        array( // 0
            'sText' => 'enrollment request',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => '/Nexus/dashboard/admin/enrollment?'
        ),
        array( // 1
            'sText' => 'cancelled enrollment',
            'sIcon' => 'fa fa-user-times text-aqua',
            'sLink' => ''
        ),
        array( // 2
            'sText' => 'payment submitted',
            'sIcon' => 'fa fa-money-bill-alt text-aqua',
            'sLink' => ''
        ),
        array( // 3
            'sText' => 'payment approved',
            'sIcon' => 'fa fa-money-bill-wave text-success',
            'sLink' => '/Nexus/dashboard/student/enrollment?'
        ),
        array( // 4
            'sText' => 'payment rejected',
            'sIcon' => 'fa fa-window-close text-danger',
            'sLink' => '/Nexus/dashboard/student/rejectedPayments?'
        ),
        array( // 5
            'sText' => 'refund approved',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array( // 6
            'sText' => 'refund rejected',
            'sIcon' => 'fa fa-times-circle text-aqua',
            'sLink' => ''
        ),
        array( // 7
            'sText' => 'quotation requested',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array( // 8
            'sText' => 'quotation approved',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        )
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
     * fetchAdminNotifications
     * Fetch notifications from the database.
     */
    public function fetchAdminNotifications()
    {
        $aNotifications = $this->oNotificationModel->fetchAdminNotifications($this->aParams['iLimit']);
        $iNotifCount = $this->oNotificationModel->fetchUnopenedAdminNotifsCount();

        if (empty($aNotifications) === true) {
            echo json_encode(array(
                'aNotifs'     => [],
                'iNotifCount' => 0
            ));
            exit();
        }

        foreach ($aNotifications as $iKey => $aValue) {
            $aStudentIds[$aValue['studentId']] = $aValue['studentId'];
        }

        $aStudentDetails = $this->oStudentModel->getStudentsDetails(array_values($aStudentIds));

        foreach ($aNotifications as $iKey => $aValue) {
            $iStudentKey = Utils::searchKeyByValueInMultiDimensionalArray($aValue['studentId'], $aStudentDetails, 'studentId');

            $aReturnData[$iKey]['notifText'] = $aStudentDetails[$iStudentKey]['studentName'];
            $aReturnData[$iKey]['notifText'] .= ' has ' . $this->aNotificationType[$aValue['type']]['sText'];
            $aReturnData[$iKey]['notifText'] .= ' for ' . $aValue['courseCode'] . '.';

            $aReturnData[$iKey]['notifDate'] = $aValue['date'];
            $aReturnData[$iKey]['notifIcon'] = $this->aNotificationType[$aValue['type']]['sIcon'];

            $aReturnData[$iKey]['notifLink'] = $this->aNotificationType[$aValue['type']]['sLink'];
            $aReturnData[$iKey]['notifLink'] .= 'studentName=' . urlencode($aStudentDetails[$iStudentKey]['studentName']);
            $aReturnData[$iKey]['notifLink'] .= '&courseName=' . urlencode($aValue['courseCode']);

            $aReturnData[$iKey]['notifType'] = $aValue['type'];
            $aReturnData[$iKey]['notifId'] = $aValue['id'];
            $aReturnData[$iKey]['notifStatus'] = $aValue['status'];

            $aReturnData[$iKey]['scheduleId'] = $aValue['scheduleId'];
        }

        echo json_encode(array(
            'aNotifs'     => array_values($aReturnData),
            'iNotifCount' => $iNotifCount
        ));
    }

    /**
     * fetchStudentNotifications
     * Fetch notifications from the database.
     */
    public function fetchStudentNotifications()
    {
        $aNotifications = $this->oNotificationModel->fetchStudentNotifications($this->getUserId(), $this->aParams['iLimit']);
        $iNotifCount = $this->oNotificationModel->fetchUnopenedStudentNotifsCount();

        if (empty($aNotifications) === true) {
            echo json_encode(array(
                'aNotifs'     => [],
                'iNotifCount' => 0
            ));
            exit();
        }

        foreach ($aNotifications as $iKey => $aValue) {
            $aStudentIds[$aValue['studentId']] = $aValue['studentId'];
        }

        foreach ($aNotifications as $iKey => $aValue) {
            $aReturnData[$iKey]['notifText'] = ucfirst($this->aNotificationType[$aValue['type']]['sText']);
            $aReturnData[$iKey]['notifText'] .= ' for ' . $aValue['courseCode'] . '.';

            $aReturnData[$iKey]['notifDate'] = $aValue['date'];
            $aReturnData[$iKey]['notifIcon'] = $this->aNotificationType[$aValue['type']]['sIcon'];

            $aReturnData[$iKey]['notifLink'] = $this->aNotificationType[$aValue['type']]['sLink'];
            $aReturnData[$iKey]['notifLink'] .= 'courseName=' . urlencode($aValue['courseCode']);

            $aReturnData[$iKey]['notifType'] = $aValue['type'];
            $aReturnData[$iKey]['notifId'] = $aValue['id'];
            $aReturnData[$iKey]['notifStatus'] = $aValue['status'];

            $aReturnData[$iKey]['scheduleId'] = $aValue['scheduleId'];
        }

        echo json_encode(array(
            'aNotifs'     => array_values($aReturnData),
            'iNotifCount' => $iNotifCount
        ));
    }


    public function updateAdminNotifCount()
    {
        $this->oNotificationModel->updateAdminNotifCount();
        echo json_encode(array('bResult' => true));
    }

    public function updateStudentNotifCount()
    {
        $this->oNotificationModel->updateStudentNotifCount($this->getUserId());
        echo json_encode(array('bResult' => true));
    }

    public function updateStatus()
    {
        if (filter_var($this->aParams['iNotifId'], FILTER_VALIDATE_INT) === false) {
            echo json_encode(array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred.'
            ));
            exit();
        }
        $this->oNotificationModel->updateStatus($this->aParams['iNotifId']);
        echo json_encode(array('bResult' => true));
    }
}
