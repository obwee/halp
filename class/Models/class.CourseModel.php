<?php
require_once('utils/dbConnection.php');

class CourseModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    public function fetchCourses()
    {
        // Query the tbl_courses for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT tc.id AS courseId, tc.courseName, tc.courseDescription,
                   ts.id AS scheduleId, ts.fromDate, ts.toDate
            FROM tbl_courses tc
            INNER JOIN
            tbl_schedules    ts
            ON tc.id = ts.courseId
            WHERE ts.fromDate > CURDATE() and ts.toDate > CURDATE()
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }
}