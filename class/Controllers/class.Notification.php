<?php

class Notification extends BaseController
{

    protected $aNotificationType = array(
        array(
            'sText' => 'enrollment request',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => '/Nexus/dashboard/admin/enrollment?'
        ),
        array(
            'sText' => 'cancelled enrollment',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array(
            'sText' => 'payment submitted',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array(
            'sText' => 'payment rejected',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array(
            'sText' => 'refund approved',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array(
            'sText' => 'refund rejected',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array(
            'sText' => 'quotation requested',
            'sIcon' => 'fa fa-user text-aqua',
            'sLink' => ''
        ),
        array(
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
     * fetchNotifications
     * Fetch notifications from the database.
     */
    public function fetchNotifications()
    {
        $aNotifications = $this->oNotificationModel->fetchNotifications($this->aParams['iLimit']);

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
            $aReturnData[$iKey]['notifText'] .= ' has ' . $this->aNotificationType[$aValue['type']]['sText'];
            $aReturnData[$iKey]['notifText'] .= ' for ' . $aValue['courseCode'] . '.';

            $aReturnData[$iKey]['notifDate'] = $aValue['date'];
            $aReturnData[$iKey]['notifIcon'] = $this->aNotificationType[$aValue['type']]['sIcon'];

            $aReturnData[$iKey]['notifLink'] = $this->aNotificationType[$aValue['type']]['sLink'];
            $aReturnData[$iKey]['notifLink'] .= 'studentName=' . urlencode($aStudentDetails[$iStudentKey]['studentName']);
            $aReturnData[$iKey]['notifLink'] .= '&courseName=' . urlencode($aValue['courseCode']);

            $aReturnData[$iKey]['scheduleId'] = $aValue['scheduleId'];
            $aReturnData[$iKey]['notifType'] = $aValue['type'];
        }

        echo json_encode($aReturnData);
    }
}
