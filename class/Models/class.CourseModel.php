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

    public function addCourse($aCourseDetails)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_courses
                (courseName, coursePrice, courseDescription, courseCode)
            VALUES
                (:courseName, :coursePrice, :courseDescription, :courseCode)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aCourseDetails);
    }

    public function updateCourse($aCourseDetails)
    {
        // Prepare an update query.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_courses
            SET
                courseName = :courseName,
                coursePrice = :coursePrice,
                courseDescription = :courseDescription,
                courseCode = :courseCode
            WHERE id = :courseId
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aCourseDetails);
    }

    /**
     * enableDisableCourse
     * Queries the courses table in enabling/disabling a course.
     * @param array $aData
     * @return int
     */
    public function enableDisableCourse($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_courses
            SET status = :status
            WHERE id = :id
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }

    public function fetchAllCourses()
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_courses tc
            ORDER BY tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchAvailableCoursesAndSchedules()
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tc.id AS courseId, tc.courseName, tc.courseDescription, tc.courseCode, tc.coursePrice,
                   ts.id AS scheduleId, ts.fromDate, ts.toDate, tv.venue,
                   ts.instructorId, CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            INNER JOIN tbl_users     tu
            ON ts.instructorId = tu.userId
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND ts.remainingSlots != 0
                AND tc.status = 'Active'
                AND tv.status = 'Active'
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchEnrolledCourses($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tc.id AS courseId, tc.courseName, tc.courseDescription, tc.courseCode, tc.coursePrice,
                   ts.id AS scheduleId, ts.fromDate, ts.toDate, tv.venue,
                   ts.instructorId, CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
            ON tt.scheduleId = ts.id
            INNER JOIN tbl_users     tu
            ON ts.instructorId = tu.userId
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }
}