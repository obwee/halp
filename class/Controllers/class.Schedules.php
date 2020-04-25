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
     * @var CourseModel $oCourseModel
     * Class instance for course model.
     */
    private $oCourseModel;

    /**
     * @var PaymentModel $oPaymentModel
     * Class instance for payment model.
     */
    private $oPaymentModel;

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
        // Instantiate the TrainingModel class and store it inside $this->oTrainingModel.
        $this->oTrainingModel = new TrainingModel();
        // Instantiate the CourseModel class and store it inside $this->oCourseModel.
        $this->oCourseModel = new CourseModel();
        // Instantiate the PaymentModel class and store it inside $this->oPaymentModel.
        $this->oPaymentModel = new PaymentModel();
    }

    /**
     * fetchSchedules
     * Method for fetching schedules.
     */
    public function fetchSchedules()
    {
        $aSchedules = $this->oScheduleModel->fetchSchedules();

        foreach ($aSchedules as $iKey => $aSchedule) {
            $this->prepareEventData($aSchedules[$iKey], $aSchedule);

            if ($aSchedule['recurrence'] === 'weekly') {
                $this->prepareRecurringEventData($aSchedules[$iKey], $aSchedule);
            }

            $aUnnecessaryData = array(
                'courseId',
                'numSlots',
                'remainingSlots',
                'instructor',
                'instructorId',
                'venue',
                'venueId',
                'status',
                'recurrence',
                'numRepetitions'
            );
            Utils::unsetKeys($aSchedules[$iKey], $aUnnecessaryData);
        }

        echo json_encode($aSchedules);
    }

    private function prepareEventData(&$aData, $aDetails)
    {
        // Add 1 day to each end date for rendering to Full Calendar JS in the front-end.
        $oEndDate = new DateTime($aDetails['end']);
        $oEndDate->modify('+1 day');
        $aData['end'] = $oEndDate->format('Y-m-d');

        $aVenues = array(
            'id'   => $aDetails['venueId'],
            'name' => $aDetails['venue']
        );

        $aInstructors = array(
            'id'   => $aDetails['instructorId'],
            'name' => $aDetails['instructor']
        );

        $aData['extendedProps'] = array(
            'isRecurring'    => false,
            'numSlots'       => $aDetails['numSlots'],
            'remainingSlots' => $aDetails['remainingSlots'],
            'courseId'       => $aDetails['courseId'],
            'status'         => $aDetails['status'],
            'venue'          => $aVenues,
            'instructor'     => $aInstructors
        );
    }

    private function prepareRecurringEventData(&$aData, $aDetails)
    {
        $aData['borderColor'] = 'red';
        $aData['extendedProps']['isRecurring'] = true;
        $aData['extendedProps']['frequency'] = $aDetails['numRepetitions'] . ' ' . date('l', strtotime($aDetails['end'])) . 's';
        $aData['rrule'] = array(
            'freq'      => $aDetails['recurrence'],
            'interval'  => 1,
            'byweekday' => array(
                substr(strtolower(date('l', strtotime($aDetails['end']))), 0, 2) // Day of the week.
            ),
            'dtstart'   => $aData['start'],
            'until'     => $aData['end']
        );

        $aUnnecessaryData = array(
            'start',
            'end'
        );
        Utils::unsetKeys($aData, $aUnnecessaryData);
    }

    /**
     * updateSchedule
     * Method for updating a schedule.
     */
    public function updateSchedule()
    {
        $this->aParams = array_filter($this->aParams);
        $aValidationResult = Validations::validateScheduleInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {

            // if (empty($this->aParams['bReschedule']) === false && $this->aParams['bReschedule'] == true && $this->aParams['iRemainingSlots'] < $this->aParams['iSlots']) {
            //     $aResult = array(
            //         'bResult' => false,
            //         'sMsg'    => 'Cannot update schedules. Inform the enrolees first.'
            //     );
            //     echo json_encode($aResult);
            //     exit();
            // }

            // Declare an array with keys equivalent to that inside the database.
            $aDatabaseColumns = array(
                'iScheduleId'     => 'id',
                'iInstructorId'   => 'instructorId',
                'iCoursePrice'    => 'coursePrice',
                'iVenueId'        => 'venueId',
                'iCourseId'       => 'courseId',
                'sStart'          => 'fromDate',
                'sEnd'            => 'toDate',
                'iSlots'          => 'numSlots',
                'iRecurrence'     => 'recurrence',
                'iNumRepetitions' => 'numRepetitions'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);
            $this->aParams['toDate'] = $this->changeEndDateIfRecurring($this->aParams);
            $this->aParams['remainingSlots'] = $this->getRemainingSlots($this->aParams);

            if ($this->aParams['remainingSlots'] < 0) {
                $aResult = array(
                    'bResult'  => false,
                    'sElement' => '.remainingSlots',
                    'sMsg'     => 'Remaining slots cannot be less than ' . $this->aParams['remainingSlots'] . '.'
                );
                echo json_encode($aResult);
                exit();
            }

            $aUnnecessaryKeys = array(
                'iRemainingSlots',
                'bReschedule'
            );
            Utils::unsetKeys($this->aParams, $aUnnecessaryKeys);

            // Perform update.
            $iQuery = $this->executeScheduleUpdate($this->aParams);

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

    private function executeScheduleUpdate($aParams)
    {
        // Update the schedule depending on recurrence field.
        if (isset($aParams['recurrence']) === true) {
            $aParams['numRepetitions'] = $aParams['numRepetitions'] ?? 1;
            return $this->oScheduleModel->updateRecurringSchedule($aParams);
        }
        return $this->oScheduleModel->updateSchedule($aParams);
    }

    public function addSchedule()
    {
        // Remove array elements with empty values.
        $this->aParams = array_filter($this->aParams);

        $aValidationResult = Validations::validateScheduleInputs($this->aParams, 'Insert');
        if ($aValidationResult['bResult'] === true) {
            // Declare an array with keys equivalent to that inside the database.
            $aDatabaseColumns = array(
                'iInstructorId'   => 'instructorId',
                'iCoursePrice'    => 'coursePrice',
                'iVenueId'        => 'venueId',
                'iCourseId'       => 'courseId',
                'sStart'          => 'fromDate',
                'sEnd'            => 'toDate',
                'iSlots'          => 'numSlots',
                'iRecurrence'     => 'recurrence',
                'iNumRepetitions' => 'numRepetitions'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);
            $this->aParams['remainingSlots'] = $this->aParams['numSlots'];
            $this->aParams['toDate'] = $this->changeEndDateIfRecurring($this->aParams);
            $this->aParams['recurrence'] = $this->aParams['recurrence'] ?? 'none';
            $this->aParams['numRepetitions'] = $this->aParams['numRepetitions'] ?? 1;
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

    public function rescheduleTraining()
    {
        $aNewKeys = array(
            'course'   => 'courseId',
            'schedule' => 'scheduleId'
        );
        Utils::renameKeys($this->aParams, $aNewKeys);
        Utils::sanitizeData($this->aParams);

        $aValidateParams = Validations::validateIdsForReschedule($this->aParams);
        if ($aValidateParams['bResult'] === false) {
            echo json_encode($aValidateParams);
            exit;
        }

        $aOldScheduleDetails = $this->oScheduleModel->fetchOldScheduleDetails($this->aParams);
        $aNewScheduleDetails = $this->oCourseModel->getCourseAndScheduleDetails($this->aParams['scheduleId']);

        $iBalance = $aOldScheduleDetails['totalPayment'] - $aNewScheduleDetails['coursePrice'];
        
        if ($iBalance > 0 || $iBalance === 0) {
            $iIsPaid = 2;
        } else {
            $iIsPaid = 1;
        }
        $iIsPaid = ($aOldScheduleDetails['totalPayment'] === 0) ? 0 : $iIsPaid;

        $aParams = array(
            'isPaid'     => $iIsPaid,
            'scheduleId' => $this->aParams['scheduleId'],
            'trainingId' => $this->aParams['trainingId'],
            'studentId'  => $this->aParams['studentId']
        );
        $this->oPaymentModel->changePaymentStatus($aParams);
        $this->oScheduleModel->changeRemainingSlots($aOldScheduleDetails['scheduleId'], $aParams['scheduleId']);
        $this->oTrainingModel->changeSchedule($aParams['scheduleId'], $aParams['trainingId']);

        echo json_encode(
            array(
                'bResult' => true,
                'sMsg'    => 'Reschedule successful!'
            )
        );
    }
}
