<?php

class Forms
{

    /**
     * @var array $aParams
     * Holder of request parameters sent by AJAX.
     */
    private $aParams;

    /**
     * @var CourseModel $oModel
     * Class instance for Course model.
     */
    private $oCourseModel;

    /**
     * Forms constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the StudentModel class and store it inside $this->oCourseModel.
        $this->oCourseModel = new CourseModel();
    }
    /**
     * fetchHomepageData
     * Fetch homepage-related data from the database.
     * @param array $aDetails
     * @return int
     */
    public function fetchHomepageData()
    {
        $aResult = $this->oCourseModel->fetchCourses();
        $aCourses = array();
        $aSchedules = array();

        foreach ($aResult as $iKey => $aCourse) {
            $iFromDate = strtotime($aCourse['fromDate']);
            $iToDate = strtotime($aCourse['toDate']);
            $iInterval = (($iToDate - $iFromDate) / 86400) + 1;

            $aSchedules[$aCourse['courseId']][] = $aCourse['fromDate'] . ' - ' . $aCourse['toDate'] . ' (' . $iInterval . ' days)';
            $aCourses[$aCourse['courseId']] = $aCourse;
        }

        foreach ($aCourses as $aCourse) {
            $aCourses[$aCourse['courseId']]['schedule'] = $aSchedules[$aCourse['courseId']];
        }

        echo json_encode(array_values($aCourses));
    }
}
