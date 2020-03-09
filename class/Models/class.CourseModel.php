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
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tc.id AS courseId, tc.courseName, tc.courseDescription, tc.courseCode,
                   ts.id AS scheduleId, ts.fromDate, ts.toDate, tv.venue
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND ts.remainingSlots != 0
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchEnrolledCourses($aStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tc.id AS courseId, tc.courseName, tc.courseDescription, tc.courseCode,
                   ts.id AS scheduleId, ts.fromDate, ts.toDate, tv.venue
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            LEFT  JOIN tbl_training  tt
            ON tt.courseId = tc.id
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND ts.remainingSlots != 0
                AND tt.studentId = :studentId
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute($aStudentId);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }
}