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
     * Quotations constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the CourseModel class and store it inside $this->oCourseModel.
        $this->oCourseModel = new CourseModel();

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
            'id' => $this->aParams['courseId'],
            'status' => ($this->aParams['courseAction'] === 'enable') ? 'Active' : 'Inactive'
        );

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
     * fetchCoursesToEnroll
     */
    public function fetchCoursesToEnroll()
    {
        $aStudentId = array(
            ':studentId' => $this->getUserId()
        );

        $aCourses = $this->oCourseModel->fetchAvailableCoursesAndSchedules();
        $aEnrolledCourses = $this->oCourseModel->fetchEnrolledCourses($aStudentId);

        // Get the difference of the aCourses array and aEnrolledCourses array
        // by serializing the arrays and performing an array_diff.
        // Afterwards, unserialize the difference.
        $aCoursesAvailable = array_map('unserialize', (array_diff(array_map('serialize', $aCourses), array_map('serialize', $aEnrolledCourses))));

        $aCoursesToEnroll = array();
        $aSchedules = array();

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

        print_r($aCoursesToEnroll);
        die;
        // print_r($aEnrolledCourses);
        // print_r($aCoursesAvailable); die;
    }
}
