<?php

class Courses extends BaseController
{
    /**
     * @var CourseModel $oCourseModel
     * Class instance for course model.
     */
    private $oCourseModel;

    /**
     * @var SchedulesModel $oSchedulesModel
     * Class instance for schedule model.
     */
    private $oSchedulesModel;

    /**
     * @var InstructorsModel $oInstructorsModel
     * Class instance for admin model.
     */
    private $oInstructorsModel;

    /**
     * Quotations constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        $this->aParams = $aPostVariables;
        $this->oCourseModel = new CourseModel();
        $this->oSchedulesModel = new SchedulesModel();
        $this->oInstructorsModel = new InstructorsModel();
        parent::__construct();
    }

    public function fetchAllCourses()
    {
        echo json_encode($this->oCourseModel->fetchAllCourses());
    }

    public function addCourse()
    {
        Utils::sanitizeData($this->aParams);
        Utils::prepareData($this->aParams, 'addUpdateCourse');

        $aResult = $this->oCourseModel->addCourse($this->aParams);

        if ($aResult === true) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Course added!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred. Please try again.'
            );
        }
        echo json_encode($aResult);
    }

    public function updateCourse()
    {
        Utils::sanitizeData($this->aParams);
        Utils::prepareData($this->aParams, 'addUpdateCourse');

        $aResult = $this->oCourseModel->updateCourse($this->aParams);

        if ($aResult === true) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Course updated!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred. Please try again.'
            );
        }
        echo json_encode($aResult);
    }

    public function enableDisableCourse()
    {
        $aData = array(
            'id'     => $this->aParams['courseId'],
            'status' => ($this->aParams['courseAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Check if courses still has upcoming trainings before disabling.
        if ($aData['status'] === 'Inactive') {
            $aSchedules = $this->oSchedulesModel->fetchSchedulesForSpecificCourse($aData['id']);
            if (count($aSchedules) > 0) {
                echo json_encode(array(
                    'bResult'    => false,
                    'aSchedules' => $aSchedules
                ));
                exit;
            }
        }

        // Perform enabling/disabling.
        $iQuery = $this->oCourseModel->enableDisableCourse($aData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Course ' . $this->aParams['courseAction'] . 'd!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * changeCourses
     * Change the courses in behalf of the course to be disabled.
     */
    public function changeCourses()
    {
        $aValidationResult = Validations::validateChangeCourseInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);

            // Perform update on schedules.
            $iQuery = $this->oSchedulesModel->changeCourses($this->aParams['courses']);

            if ($iQuery > 0) {
                $aData = array(
                    'id' => $this->aParams['courseId'],
                    'status' => 'Inactive'
                );
                // Disable instructor.
                $iQuery = $this->oCourseModel->enableDisableCourse($aData);

                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Course disabled!'
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

    /**
     * fetchCoursesToEnroll
     */
    public function fetchCoursesToEnroll()
    {
        $aCoursesToEnroll = array();
        $aSchedules = array();
        $aCoursePrice = array();
        $aVenues = array();
        $aInstructors = array();
        $aVenues = array();
        $aScheduleIds = array();
        $aSlots = array();

        $iStudentId = $this->getUserId();
        $aEnrolledCourses = $this->oCourseModel->fetchEnrolledCourses($iStudentId);
        $aCourses = $this->oCourseModel->fetchAvailableCoursesAndSchedules();

        // // Get the difference of the aCourses array and aEnrolledCourses array
        // // by serializing the arrays and performing an array_diff.
        // // Afterwards, unserialize the difference.
        // $aCoursesAvailable = array_map('unserialize', (array_diff(array_map('serialize', $aCourses), array_map('serialize', $aEnrolledCourses))));

        // Remove all enrolled courses to the courses available.
        foreach ($aEnrolledCourses as $iKey => $aEnrolledCourse) {
            foreach ($aCourses as $mKey => $aCourse) {
                if ($aEnrolledCourse['courseId'] === $aCourse['courseId']) {
                    unset($aCourses[$mKey]);
                }
            }
        }
        // print_r($aCoursesAvailable);

        // Get schedules, venues, instructors, and slots for each courses available and remove duplicates.
        foreach ($aCourses as $aCourse) {
            $aSchedules[$aCourse['courseId']][$aCourse['scheduleId']]   = Utils::formatDate($aCourse['fromDate']) . ' - ' . Utils::formatDate($aCourse['toDate']) . ' (' . $this->getInterval($aCourse) . ')';
            $aCoursePrice[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['coursePrice'];
            $aVenues[$aCourse['courseId']][$aCourse['scheduleId']]      = $aCourse['venue'];
            $aInstructors[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['instructorId'];
            $aSlots[$aCourse['courseId']][$aCourse['scheduleId']]       = $aCourse['remainingSlots'];
            $aCoursesToEnroll[$aCourse['courseId']]                     = $aCourse;
        }

        // Add the schedules, venues, instructors, and slots to its respective course.
        foreach ($aCoursesToEnroll as $aCourse) {
            $aCoursesToEnroll[$aCourse['courseId']]['schedules']   = $aSchedules[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['prices']      = $aCoursePrice[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['venues']      = $aVenues[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['instructors'] = $aInstructors[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['slots']       = $aSlots[$aCourse['courseId']];
        }

        // Unset unnecessary data to be returned to the front-end.
        $aUnnecessaryData = array(
            'venue',
            'instructorId',
            'instructorName',
            'remainingSlots'
        );
        Utils::unsetUnnecessaryData($aCoursesToEnroll, $aUnnecessaryData);

        // Extract schedule IDs of enrolled courses in getting training data.
        foreach ($aEnrolledCourses as $aEnrolledCourse) {
            array_push($aScheduleIds, $aEnrolledCourse['scheduleId']);
        }

        if (sizeof($aEnrolledCourses) !== 0) {
            // Get training data.
            $aTrainingData = $this->oTrainingModel->getTrainingData($iStudentId, $aScheduleIds);

            $aTotalPaymentAmount = array();
            // Get total amount paid per schedule.
            foreach ($aTrainingData as $iKey => $aValue) {
                if (array_key_exists($aValue['scheduleId'], $aTotalPaymentAmount) === true) {
                    $aTotalPaymentAmount[$aValue['scheduleId']] += $aValue['paymentAmount'];
                    continue;
                }
                $aTotalPaymentAmount[$aValue['scheduleId']] = $aValue['paymentAmount'];
            }

            // Insert training data and total amount paid per schedule to each of the enrolled courses.
            foreach ($aEnrolledCourses as $iKey => $aEnrolledCourse) {
                // Search schedule ID index inside the training data.
                $iIndex = Utils::searchKeyByValueInMultiDimensionalArray($aEnrolledCourse['scheduleId'], $aTrainingData, 'scheduleId');
                $aEnrolledCourses[$iKey]['schedule'] = Utils::formatDate($aEnrolledCourse['fromDate']) . ' - ' . Utils::formatDate($aEnrolledCourse['toDate']) . ' (' . $this->getInterval($aEnrolledCourse) . ')';;
                $aEnrolledCourses[$iKey]['trainingId'] = $aTrainingData[$iIndex]['trainingId'];
                $aEnrolledCourses[$iKey]['paymentBalance'] = $aEnrolledCourse['coursePrice'] - $aTotalPaymentAmount[$aEnrolledCourse['scheduleId']] ?? $aEnrolledCourse['coursePrice'];
                $aEnrolledCourses[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aTrainingData[$iIndex]['paymentStatus'] ?? 0];

                // If payment is already fully paid, unset.
                if ($aEnrolledCourses[$iKey]['paymentStatus'] === 'Fully Paid') {
                    unset($aEnrolledCourses[$iKey]);
                } else {
                    if ($aEnrolledCourses[$iKey]['paymentBalance'] != $aEnrolledCourses[$iKey]['coursePrice']) {
                        $aEnrolledCourses[$iKey]['paymentStatus'] = 'Partially Paid';
                    }
                }
            }
        }

        echo json_encode(array(
            'aEnrolledCourses'  => array_values($aEnrolledCourses),
            'aCoursesAvailable' => array_values($aCoursesToEnroll),
            'aInstructors'      => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
        ));
    }
}
