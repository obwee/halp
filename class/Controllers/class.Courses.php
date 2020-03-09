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
        $aCourses = $this->oCourseModel->fetchAllCourses();

        foreach($aCourses as $iKey => $aCourse) {
            $aCourses[$iKey]['coursePrice'] = 'P' . number_format($aCourse['coursePrice']);
            $aCourses[$iKey]['courseDescription'] = ($aCourse['courseDescription'] !== '') ? $aCourse['courseDescription'] : '-';
        }

        echo json_encode($aCourses);
    }

    /**
     * fetchCoursesToEnroll
     */
    public function fetchCoursesToEnroll()
    {
        $aStudentId = array(
            ':studentId' => $this->getUserId()
        );

        $aCourses = $this->oCourseModel->fetchCourses();
        $aEnrolledCourses = $this->oCourseModel->fetchEnrolledCourses($aStudentId);
        // Get the difference of the aCourses and aEnrolledCourses by serializing the arrays and performing an array_diff.
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
