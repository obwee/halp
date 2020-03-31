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
     * @var TrainingModel $oScheduleModel
     * Class instance for schedule model.
     */
    private $oTrainingModel;

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
        // Instantiate the SchedulesModel class and store it inside $this->oScheduleModel.
        $this->oTrainingModel = new TrainingModel();
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
        $aValidationResult = Validations::validateScheduleInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            // Declare an array with keys equivalent to that inside the database.
            $aDatabaseColumns = array(
                'iScheduleId'   => 'id',
                'iInstructorId' => 'instructorId',
                'iVenueId'      => 'venueId',
                'iCourseId'     => 'courseId',
                'sStart'        => 'fromDate',
                'sEnd'          => 'toDate',
                'iSlots'        => 'numSlots'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            $this->aParams['remainingSlots'] = $this->getRemainingSlots($this->aParams);

            if ($this->aParams['remainingSlots'] < 0) {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'Remaining slots cannot be less than 0.'
                );
                echo json_encode($aResult);
                exit();
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
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    public function addSchedule()
    {
        // Remove array elements with empty values.
        $this->aParams = array_filter($this->aParams);

        $aValidationResult = Validations::validateScheduleInputs($this->aParams, 'Insert');
        if ($aValidationResult['bResult'] === true) {
            // Declare an array with keys equivalent to that inside the database.
            $aDatabaseColumns = array(
                'iInstructorId' => 'instructorId',
                'iVenueId'      => 'venueId',
                'iCourseId'     => 'courseId',
                'sStart'        => 'fromDate',
                'sEnd'          => 'toDate',
                'iSlots'        => 'numSlots'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);

            $this->aParams['remainingSlots'] = $this->aParams['numSlots'];

            // Perform insert.
            $iQuery = $this->oScheduleModel->addSchedule($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Schedule added!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    public function disableSchedule()
    {
        Utils::sanitizeData($this->aParams);
        if (empty($this->aParams['iScheduleId']) === true || !preg_match('/^[0-9]+$/', $this->aParams['iScheduleId'])) {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'Invalid schedule to be deleted.'
            );
        } else {
            $aDatabaseColumns = array(
                'iScheduleId' => 'scheduleId'
            );
            Utils::renameKeys($this->aParams, $aDatabaseColumns);

            if ($this->oTrainingModel->fetchNumberOfEnrollees($this->aParams) !== 0) {
                echo json_encode(array(
                    'bResult' => false,
                    'sMsg'    => 'Schedule cannot be disabled since there are reserved students.'
                ));
                exit;
            }

            if ($this->oScheduleModel->disableSchedule($this->aParams['scheduleId']) == 0) {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occurred.'
                );
            } else {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Schedule deleted!'
                );
            }
        }

        echo json_encode($aResult);
    }

    /**
     * getRemainingSlots
     * @param array $aData
     * @return int
     */
    private function getRemainingSlots($aData)
    {
        $oTrainingModel = new TrainingModel();
        $aIds = array(
            ':scheduleId' => $aData['id']
        );
        $iNumberOfEmployees = $oTrainingModel->fetchNumberOfEnrollees($aIds);
        return $aData['numSlots'] - $iNumberOfEmployees;
    }
}
