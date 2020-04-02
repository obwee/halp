<?php

class Courses extends BaseController
{
    /**
     * @var QuotationsModel $oQuotationModel
     * Class instance for quotation model.
     */
    private $oQuotationModel;

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
     * @var TrainingModel $oTrainingModel
     * Class instance for training model.
     */
    private $oTrainingModel;

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
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the CourseModel class and store it inside $this->oCourseModel.
        $this->oCourseModel = new CourseModel();
        // Instantiate the SchedulesModel class and store it inside $this->oSchedulesModel.
        $this->oSchedulesModel = new SchedulesModel();
        // Instantiate the TrainingModel class and store it inside $this->oTrainingModel.
        $this->oTrainingModel = new TrainingModel();
        // Instantiate the AdminsModel class and store it inside $this->oInstructorsModel.
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

        // Get the difference of the aCourses array and aEnrolledCourses array
        // by serializing the arrays and performing an array_diff.
        // Afterwards, unserialize the difference.
        $aCoursesAvailable = array_map('unserialize', (array_diff(array_map('serialize', $aCourses), array_map('serialize', $aEnrolledCourses))));

        // Get schedules, venues, instructors, and slots for each courses available and remove duplicates.
        foreach ($aCoursesAvailable as $aCourse) {
            $iFromDate = strtotime($aCourse['fromDate']);
            $iToDate = strtotime($aCourse['toDate']);
            $iInterval = (($iToDate - $iFromDate) / 86400) + 1;

            $aSchedules[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['fromDate'] . ' - ' . $aCourse['toDate'] . ' (' . $iInterval . ' days)';
            $aCoursePrice[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['coursePrice'];
            $aVenues[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['venue'];
            $aInstructors[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['instructorId'];
            $aSlots[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['remainingSlots'];
            $aCoursesToEnroll[$aCourse['courseId']] = $aCourse;
        }

        // Add the schedules, venues, instructors, and slots to its respective course.
        foreach ($aCoursesToEnroll as $aCourse) {
            $aCoursesToEnroll[$aCourse['courseId']]['schedules'] = $aSchedules[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['prices'] = $aCoursePrice[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['venues'] = $aVenues[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['instructors'] = $aInstructors[$aCourse['courseId']];
            $aCoursesToEnroll[$aCourse['courseId']]['slots'] = $aSlots[$aCourse['courseId']];
        }

        // Extract schedule IDs of enrolled courses in getting training data.
        foreach ($aEnrolledCourses as $aEnrolledCourse) {
            array_push($aScheduleIds, $aEnrolledCourse['scheduleId']);
        }

        // Unset unnecessary data to be returned to the front-end.
        $aUnnecessaryData = array(
            'venue',
            'instructorId',
            'instructorName',
            'remainingSlots'
        );

        Utils::unsetUnnecessaryData($aCoursesToEnroll, $aUnnecessaryData);

        // Get training data.
        $aTrainingData = $this->oTrainingModel->getTrainingData($iStudentId, $aScheduleIds);

        // Insert training data to each of the enrolled courses.
        foreach ($aEnrolledCourses as $iKey => $aEnrolledCourse) {
            // Search schedule ID index inside the training data.
            $iIndex = Utils::searchKeyByValueInMultiDimensionalArray($aEnrolledCourse['scheduleId'], $aTrainingData, 'scheduleId');
            $aEnrolledCourses[$iKey]['trainingId'] = $aTrainingData[$iIndex]['trainingId'];
            $aEnrolledCourses[$iKey]['paymentId'] = $aTrainingData[$iIndex]['paymentId'];
            $aEnrolledCourses[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aTrainingData[$iIndex]['paymentStatus']];
        }

        echo json_encode(array(
            'aEnrolledCourses'  => $aEnrolledCourses,
            'aCoursesAvailable' => array_values($aCoursesToEnroll),
            'aInstructors'      => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
        ));
    }
}
