<?php

/**
 * Schedules
 * Class for schedule-related functionalities.
 */
class Schedules extends BaseController
{
    /**
     * @var SchedulesModel $oScheduleModel
     * Class instance for schedule model.
     */
    private $oScheduleModel;

    /**
     * Schedules constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the SchedulesModel class and store it inside $this->oScheduleModel.
        $this->oScheduleModel = new SchedulesModel();
    }

    /**
     * fetchSchedules
     * Method for fetching schedules.
     */
    public function fetchSchedules()
    {
        $aSchedules = $this->oScheduleModel->fetchSchedules();

        foreach ($aSchedules as $iKey => $aSchedule) {
            // Add 1 day to each end date for rendering to Full Calendar JS in the front-end.
            $oEndDate = new DateTime($aSchedule['end']);
            $oEndDate->modify('+1 day');
            $aSchedules[$iKey]['end'] = $oEndDate->format('Y-m-d');

            $aSchedules[$iKey]['venue'] = array(
                'id'   => $aSchedule['venueId'],
                'name' => $aSchedule['venue']
            );

            $aSchedules[$iKey]['instructor'] = array(
                'id'   => $aSchedule['instructorId'],
                'name' => $aSchedule['instructor']
            );

            unset($aSchedules[$iKey]['venueId']);
            unset($aSchedules[$iKey]['instructorId']);

            $aSchedules[$iKey]['extendedProps'] = array_splice($aSchedules[$iKey], 4, -1);
        }

        echo json_encode($aSchedules);
    }

    /**
     * updateSchedule
     * Method for updating a schedule.
     */
    public function updateSchedule()
    {
        // Declare an array with keys equivalent to that inside the database.
        $aDatabaseColumns = array(
            'iScheduleId'   => 'id',
            'iInstructorId' => 'instructorId',
            'iVenueId'      => 'venueId',
            'sStart'        => 'fromDate',
            'sEnd'          => 'toDate',
            'iSlots'        => 'numSlots'
        );

        // Loop thru the POST data sent by AJAX for renaming.
        foreach($this->aParams as $sKey => $mValue) {
            $sNewKeys = $aDatabaseColumns[$sKey];
            $this->aParams[$sNewKeys] = $mValue;
            unset($this->aParams[$sKey]);
        }

        // Perform update.
        $iQuery = $this->oScheduleModel->updateSchedule($this->aParams);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Schedule updated!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }
}
