<?php
require_once('utils/dbConnection.php');

/**
 * NotificationModel
 * Class for instructor-related database functionalities.
 */
class NotificationModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * UsersModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * fetchNotifications
     * Queries the users table in getting all the instructors.
     * @param int $iLimit
     * @return array
     */
    public function fetchNotifications($iLimit)
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tn.*, tc.courseCode
            FROM tbl_notifications tn
            INNER JOIN tbl_courses tc
            ON tn.courseId = tc.id
            LIMIT ?, ?
        ");

        // Execute the above statement.
        $oStatement->execute([$iLimit, $iLimit + 5]);

        // Return the number of rows returned by the executed query.
        return $oStatement->fetchAll();
    }

    /**
     * insertNotification
     * Inserts a new record inside the notifications table.
     * @param array $aData
     * @return int
     */
    public function insertNotification($aData)
    {
        // Prepare an update query to the schedules table.
        $oStatement = $this->oConnection->prepare("
            INSERT INTO tbl_notifications
                (studentId, courseId, scheduleId, type, date)
            VALUES
                (:studentId, :courseId, :scheduleId, :type, :date)
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }
}
