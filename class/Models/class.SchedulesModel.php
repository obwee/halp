<?php
require_once('utils/dbConnection.php');

/**
 * SchedulesModel
 * Class for schedule-related database functionalities.
 */
class SchedulesModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * SchedulesModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * fetchSchedules
     * Queries the database in getting all the schedules.
     * @return array
     */
    public function fetchSchedules()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                ts.id, tc.courseCode AS title, ts.coursePrice, ts.fromDate AS start, ts.toDate AS end,
                ts.numSlots, ts.remainingSlots, ts.instructorId, ts.recurrence, ts.numRepetitions,
                tv.id AS venueId, tv.venue,
                CONCAT(tu.firstName, ' ', tu.lastName) AS instructor, tc.id AS courseId, ts.status,
                CASE
                    WHEN tv.venue = 'Manila' THEN '#4fa242'
                    WHEN tv.venue = 'Makati' THEN '#b169ec'
                END AS color
            FROM tbl_schedules     ts
            INNER JOIN tbl_courses tc
            ON ts.courseId     = tc.id
            INNER JOIN tbl_venue   tv
            ON ts.venueId      = tv.id
            INNER JOIN tbl_users    tu
            ON ts.instructorId = tu.userId
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * updateSchedule
     * Updates the schedule table.
     * @param array $aData
     * @return int
     */
    public function updateSchedule($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET
                fromDate       = :fromDate,
                toDate         = :toDate,
                venueId        = :venueId,
                courseId       = :courseId,
                instructorId   = :instructorId,
                numSlots       = :numSlots,
                remainingSlots = :remainingSlots,
                coursePrice    = :coursePrice
            WHERE id = :id
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * updateRecurringSchedule
     * Updates the schedule table.
     * @param array $aData
     * @return int
     */
    public function updateRecurringSchedule($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET
                fromDate       = :fromDate,
                toDate         = :toDate,
                venueId        = :venueId,
                courseId       = :courseId,
                instructorId   = :instructorId,
                numSlots       = :numSlots,
                remainingSlots = :remainingSlots,
                coursePrice    = :coursePrice,
                recurrence     = :recurrence,
                numRepetitions = :numRepetitions
            WHERE id = :id
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * addSchedule
     * Inserts a new record inside the schedule table.
     * @param array $aData
     * @return int
     */
    public function addSchedule($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_schedules
                (fromDate, toDate, venueId, courseId, coursePrice, instructorId, numSlots, remainingSlots, recurrence, numRepetitions)
            VALUES
                (:fromDate, :toDate, :venueId, :courseId, :coursePrice, :instructorId, :numSlots, :remainingSlots, :recurrence, :numRepetitions)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * disableSchedule
     * Disable a schedule.
     * @param int $iScheduleId
     * @return int
     */
    public function disableSchedule($iScheduleId)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET status = 'Inactive'
            WHERE id = ?
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute([$iScheduleId]);
    }

    /**
     * fetchSchedulesForSpecificInstructor
     * Queries the database in getting all the schedules for a specific instructor.
     * @param array aId
     * @return array
     */
    public function fetchSchedulesForSpecificInstructor($aId)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tc.courseCode, ts.id AS scheduleId,
                ts.fromDate, ts.toDate, tv.venue
            FROM tbl_schedules     ts
            INNER JOIN tbl_courses tc
            ON ts.courseId     = tc.id
            INNER JOIN tbl_venue   tv
            ON ts.venueId      = tv.id
            WHERE 1 = 1
                AND ts.instructorId = :userId
                AND ts.fromDate     > CURDATE()
                AND ts.toDate       > CURDATE()
        ");

        // Execute the above statement.
        $statement->execute($aId);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * fetchSchedulesForSpecificVenue
     * Queries the database in getting all the schedules for a specific venue.
     * @param int $iVenueId
     * @return array
     */
    public function fetchSchedulesForSpecificVenue($iVenueId)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tc.courseCode, ts.id AS scheduleId,
                ts.fromDate, ts.toDate,
                CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName
            FROM tbl_schedules     ts
            INNER JOIN tbl_courses tc
            ON ts.courseId     = tc.id
            INNER JOIN tbl_users   tu
            ON ts.instructorId = tu.userId
            WHERE 1 = 1
                AND ts.venueId  = ?
                AND ts.fromDate > CURDATE()
                AND ts.toDate   > CURDATE()
        ");

        // Execute the above statement.
        $statement->execute([$iVenueId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * fetchSchedulesForSpecificCourse
     * Queries the database in getting all the schedules for a specific course.
     * @param int $iCourseId
     * @return array
     */
    public function fetchSchedulesForSpecificCourse($iCourseId)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                ts.id AS scheduleId, tv.venue,
                ts.fromDate, ts.toDate,
                CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName
            FROM tbl_schedules     ts
            INNER JOIN tbl_venue   tv
            ON ts.venueId      = tv.id
            INNER JOIN tbl_users   tu
            ON ts.instructorId = tu.userId
            WHERE 1 = 1
                AND ts.courseId = ?
                AND ts.fromDate > CURDATE()
                AND ts.toDate   > CURDATE()
                AND ts.status   = 'Active'
        ");

        // Execute the above statement.
        $statement->execute([$iCourseId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * changeInstructors
     * Updates the instructor status inside the schedules table.
     * @param array $aData
     * @return int
     */
    public function changeInstructors($aData)
    {
        try {
            $this->oConnection->beginTransaction();

            // Prepare an update query to the schedules table.
            $oStatement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET
                instructorId = ?
            WHERE 1 = 1
                AND id = ?
                AND fromDate > CURDATE()
                AND toDate   > CURDATE()
        ");

            foreach ($aData as $iScheduleId => $iInstructorId) {
                // Execute update.
                $oStatement->execute([
                    $iInstructorId,
                    $iScheduleId
                ]);
            }
            return $this->oConnection->commit();
        } catch (PDOException $oError) {
            $this->oConnection->rollBack();
            return 0;
        }
    }

    /**
     * changeVenues
     * Updates the venue status inside the schedules table.
     * @param array $aData
     * @return int
     */
    public function changeVenues($aData)
    {
        $this->oConnection->beginTransaction();

        // Prepare an update query to the schedules table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET
                venueId = ?
            WHERE 1 = 1
                AND id = ?
                AND fromDate > CURDATE()
                AND toDate   > CURDATE()
        ");

        foreach ($aData as $iScheduleId => $iVenueId) {
            // Execute update.
            $oStatement->execute([
                $iVenueId,
                $iScheduleId
            ]);
        }
        return $this->oConnection->commit();
    }

    /**
     * changeCourses
     * Updates the courses status inside the schedules table.
     * @param array $aData
     * @return int
     */
    public function changeCourses($aData)
    {
        $this->oConnection->beginTransaction();

        // Prepare an update query to the schedules table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET
                courseId = ?
            WHERE 1 = 1
                AND id = ?
                AND fromDate > CURDATE()
                AND toDate   > CURDATE()
        ");

        foreach ($aData as $iScheduleId => $iCourseId) {
            // Execute update.
            $oStatement->execute([
                $iCourseId,
                $iScheduleId
            ]);
        }
        return $this->oConnection->commit();
    }

    public function fetchOldScheduleDetails($aParams)
    {
        $sQuery = $this->oConnection->prepare(
            "SELECT tt.Id AS trainingId, ts.coursePrice, tt.scheduleId,
                    SUM(tp.paymentAmount) AS totalPayment,
                    MAX(tp.isPaid) AS paymentStatus
             FROM tbl_schedules ts
             INNER JOIN tbl_training tt
             ON ts.id = tt.scheduleId
             LEFT JOIN tbl_payments tp
             ON tp.trainingId = tt.id
             WHERE 1 = 1
             AND tt.id = ?
             AND tt.studentId = ?
             GROUP BY tt.id"
        );

        $sQuery->execute(array(
            $aParams['trainingId'],
            $aParams['studentId']
        ));

        return $sQuery->fetch();  
    }

    public function changeRemainingSlots($iOldScheduleId, $iNewScheduleId)
    {
        try {
            $this->oConnection->beginTransaction();

            $statement = $this->oConnection->prepare("
                UPDATE tbl_schedules
                SET remainingSlots = (remainingSlots + 1)
                WHERE id = ?
            ");

            $statement->execute([$iOldScheduleId]);

            $statement = $this->oConnection->prepare("
                UPDATE tbl_schedules
                SET remainingSlots = (remainingSlots - 1)
                WHERE id = ?
            ");

            $statement->execute([$iNewScheduleId]);
            return $this->oConnection->commit();
        } catch (PDOException $oError) {
            $this->oConnection->rollBack();
            return 0;
        }
    }

    public function getScheduleDetailsById($iScheduleId)
    {
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_schedules ts
            WHERE ts.id = ?
        ");

        // Execute the above statement.
        $statement->execute([$iScheduleId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetch();
    }
}
