<?php

class Courses extends BaseController
{
    /**
     * @var QuotationsModel $oModel
     * Class instance for Student model.
     */
    private $oQuotationModel;

    /**
     * @var CourseModel $oModel
     * Class instance for Student model.
     */
    private $oCourseModel;

    /**
     * @var SchedulesModel $oModel
     * Class instance for Student model.
     */
    private $oSchedulesModel;

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
        parent::__construct();
    }

    public function fetchAllCourses()
    {
        echo json_encode($this->oCourseModel->fetchAllCourses());
    }

    public function addCourse()
    {
        $aValidationResult = Validations::validateAddUpdateCourseInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
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
        } else {
            $aResult = $aValidationResult;
        }
        echo json_encode($aResult);
    }

    public function updateCourse()
    {
        $aValidationResult = Validations::validateAddUpdateCourseInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
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
        } else {
            $aResult = $aValidationResult;
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
        $aScheduleIds = array();

        $aStudentId = array(
            ':studentId' => $this->getUserId()
        );

        $aEnrolledCourses = $this->oCourseModel->fetchEnrolledCourses($aStudentId);
        $aCourses = $this->oCourseModel->fetchAvailableCoursesAndSchedules();

        // Extract schedule IDs of enrolled courses in getting training data.
        foreach ($aEnrolledCourses as $aEnrolledCourse) {
            array_push($aScheduleIds, $aEnrolledCourse['scheduleId']);
        }

        print_r($aScheduleIds);
        print_r($aEnrolledCourses);

        // Get the difference of the aCourses array and aEnrolledCourses array
        // by serializing the arrays and performing an array_diff.
        // Afterwards, unserialize the difference.
        $aCoursesAvailable = array_map('unserialize', (array_diff(array_map('serialize', $aCourses), array_map('serialize', $aEnrolledCourses))));

        foreach ($aCoursesAvailable as $iKey => $aCourse) {
            $iFromDate = strtotime($aCourse['fromDate']);
            $iToDate = strtotime($aCourse['toDate']);
            $iInterval = (($iToDate - $iFromDate) / 86400) + 1;

            $aSchedules[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['fromDate'] . ' - ' . $aCourse['toDate'] . ' (' . $iInterval . ' days)';
            $aCoursesToEnroll[$aCourse['courseId']] = $aCourse;
        }

        foreach ($aCoursesToEnroll as $aCourse) {
            $aCoursesToEnroll[$aCourse['courseId']]['schedule'] = $aSchedules[$aCourse['courseId']];
        }

        echo json_encode(array(
            'aEnrolledCourses'  => $aEnrolledCourses,
            'aCoursesAvailable' => array_values($aCoursesToEnroll)
        ));
    }
}
