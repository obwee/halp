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
     */
    public function fetchSchedules()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                ts.id, tc.courseCode AS title, ts.fromDate AS start, ts.toDate AS end,
                ts.numSlots, ts.remainingSlots, tv.id AS venueId, tv.venue,
                CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName,
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
}
