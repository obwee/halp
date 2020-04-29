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
     * fetchAdminNotifications
     * Queries the users table in getting all the admin notifications.
     * @param int $iLimit
     * @return array
     */
    public function fetchAdminNotifications($iLimit)
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tn.*, tc.courseCode
            FROM tbl_notifications tn
            INNER JOIN tbl_courses tc
            ON tn.courseId = tc.id
            WHERE tn.receiver = 'admin'
            ORDER BY tn.date DESC
            LIMIT ?, ?
        ");

        // Execute the above statement.
        $oStatement->execute([$iLimit, $iLimit + 5]);

        // Return the number of rows returned by the executed query.
        return $oStatement->fetchAll();
    }

    public function fetchUnopenedAdminNotifsCount()
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_notifications tn
            WHERE hasOpenedByAdmin = 0 AND receiver = 'admin'
        ");

        // Execute the above statement.
        $oStatement->execute();

        // Return the number of rows returned by the executed query.
        return $oStatement->rowCount();
    }

    /**
     * fetchStudentNotifications
     * Queries the users table in getting all the student notifications.
     * @param int $iLimit
     * @return array
     */
    public function fetchStudentNotifications($iStudentId, $iLimit)
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tn.*, tc.courseCode
            FROM tbl_notifications tn
            INNER JOIN tbl_courses tc
            ON tn.courseId = tc.id
            WHERE tn.receiver = 'student' AND studentId = ?
            ORDER BY tn.date DESC
            LIMIT ?, ?
        ");

        // Execute the above statement.
        $oStatement->execute([$iStudentId, $iLimit, $iLimit + 5]);

        // Return the number of rows returned by the executed query.
        return $oStatement->fetchAll();
    }

    public function fetchUnopenedStudentNotifsCount()
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_notifications tn
            WHERE hasOpenedByStudent = 0 AND receiver = 'student'
        ");

        // Execute the above statement.
        $oStatement->execute();

        // Return the number of rows returned by the executed query.
        return $oStatement->rowCount();
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
                (studentId, courseId, scheduleId, type, receiver, date)
            VALUES
                (:studentId, :courseId, :scheduleId, :type, :receiver, :date)
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    public function updateAdminNotifCount()
    {
        // Prepare an update query to the schedule table.
        $oScheduleStatement = $this->oConnection->prepare("
            UPDATE tbl_notifications
            SET hasOpenedByAdmin = 1
            WHERE receiver = 'admin'
        ");

        // Execute update.
        $oScheduleStatement->execute();
    }

    public function updateStudentNotifCount($iStudentId)
    {
        // Prepare an update query to the schedule table.
        $oScheduleStatement = $this->oConnection->prepare("
            UPDATE tbl_notifications
            SET hasOpenedByStudent = 1
            WHERE studentId = ? AND receiver = 'student'
        ");

        // Execute update.
        $oScheduleStatement->execute([$iStudentId]);
    }

    public function updateStatus($iNotifId)
    {
        // Prepare an update query to the schedule table.
        $oScheduleStatement = $this->oConnection->prepare("
            UPDATE tbl_notifications
            SET status = 1
            WHERE id = ?
        ");

        // Execute update.
        $oScheduleStatement->execute([$iNotifId]);
    }
}
