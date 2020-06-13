<?php

class Forms extends BaseController
{
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
        $aResult = $this->oCourseModel->fetchAvailableCoursesAndSchedules();
        $aCourses = array();
        $aSchedules = array();
        $aSlots = array();

        foreach ($aResult as $aCourse) {
            $aSchedules[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['fromDate'] . ' - ' . $aCourse['toDate'] . ' (' . $this->getInterval($aCourse) . ')';
            $aSlots[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['remainingSlots'] . '/' . $aCourse['numSlots'];
            $aCourses[$aCourse['courseId']] = $aCourse;
        }

        foreach ($aCourses as $aCourse) {
            $aCourses[$aCourse['courseId']]['schedule'] = $aSchedules[$aCourse['courseId']];
            $aCourses[$aCourse['courseId']]['slots'] = $aSlots[$aCourse['courseId']];
        }

        echo json_encode(array_values($aCourses));
    }

    /**
     * fetchCoursesAndSchedulesForReports
     * Fetch homepage-related data from the database.
     * @param array $aDetails
     * @return int
     */
    public function fetchCoursesAndSchedulesForReports()
    {
        $aResult = $this->oCourseModel->fetchCoursesAndSchedulesForReports();
        $aCourses = array();
        $aSchedules = array();
        $aSlots = array();

        foreach ($aResult as $aCourse) {
            $aSchedules[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['fromDate'] . ' - ' . $aCourse['toDate'] . ' (' . $this->getInterval($aCourse) . ')';
            $aSlots[$aCourse['courseId']][$aCourse['scheduleId']] = $aCourse['remainingSlots'] . '/' . $aCourse['numSlots'];
            $aCourses[$aCourse['courseId']] = $aCourse;
        }

        foreach ($aCourses as $aCourse) {
            $aCourses[$aCourse['courseId']]['schedule'] = $aSchedules[$aCourse['courseId']];
            $aCourses[$aCourse['courseId']]['slots'] = $aSlots[$aCourse['courseId']];
        }

        echo json_encode(array_values($aCourses));
    }

    public function renderCourses()
    {
        $aCourses = array_filter($this->oCourseModel->fetchAllCourses(), fn ($aCourse) => $aCourse['status'] === 'Active' && $aCourse['courseDescription'] !== '');
        $aChunkedCourses = array_chunk($aCourses, 3);
        $sHtml = $this->prepareBoostrapMarkup($aChunkedCourses);

        echo $sHtml;
    }

    private function prepareBoostrapMarkup($aChunkedCourses)
    {
        $sHtml = '';
        foreach ($aChunkedCourses as $aCourses) {
            $sHtml .= '<div class="row">';
            foreach ($aCourses as $aDetails) {
                $sHtml .= '<div class="col-md-4">';
                $sHtml .= '<div class="card text-center">';
                $sHtml .= '<div class="card-body">';
                $sHtml .= '<h5 class="card-title">' . $aDetails['courseName'] . '</h5>';
                $sHtml .= '<p class="card-text">' . $aDetails['courseCode'] . '</p>';
                $sHtml .= '<p class="card-text">' . $aDetails['courseDescription'] . '</p>';
                $sHtml .= '<a href="#" class="btn btn-sm btn-info text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enroll Now&nbsp;&nbsp;&nbsp;&nbsp;</a>';
                $sHtml .= '</div>';
                $sHtml .= '</div>';
                $sHtml .= '</div>';
            }
                $sHtml .= '</div>';
        }
        return $sHtml;
    }
}
