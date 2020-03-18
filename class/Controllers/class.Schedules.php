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
        print_r($this->aParams);
    }
}