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
                ts.id, tc.courseCode AS title, ts.fromDate AS start, ts.toDate AS end,
                ts.numSlots, ts.remainingSlots, ts.instructorId, tv.id AS venueId, tv.venue,
                CONCAT(tu.firstName, ' ', tu.lastName) AS instructor, tc.id AS courseId,
                CASE
                    WHEN tv.venue = 'Manila' THEN 'purple'
                    WHEN tv.venue = 'Makati' THEN 'blue'
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
                fromDate     = :fromDate,
                toDate       = :toDate,
                venueId      = :venueId,
                courseId     = :courseId,
                instructorId = :instructorId,
                numSlots     = :numSlots
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
                (fromDate, toDate, venueId, courseId, instructorId, numSlots)
            VALUES
                (:fromDate, :toDate, :venueId, :courseId, :instructorId, :numSlots)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * deleteSchedule
     * Delete a schedule.
     * @param array $aData
     * @return int
     */
    public function deleteSchedule($aScheduleId)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            DELETE FROM tbl_schedules
            WHERE id = :id
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aScheduleId);
    }
}
