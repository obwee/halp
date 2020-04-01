<?php
require_once('utils/dbConnection.php');

/**
 * TrainingModel
 * Class for training-related database functionalities.
 */
class TrainingModel
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
     * fetchNumberOfEnrollees
     * Fetch the number of enrollees for a specific course and schedule.
     * @param array $aData
     * @return int
     */
    public function fetchNumberOfEnrollees($aData)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                COUNT(*) AS numberOfEnrollees
            FROM tbl_training tt
            WHERE 1 = 1
                AND scheduleId = :scheduleId
        ");

        // Execute the above statement.
        $statement->execute($aData);

        // Return the column of the executed query.
        return $statement->fetchColumn();
    }

    /**
     * getTrainingData
     * Fetch the training data of a particular student.
     * @param array $aData
     * @return int
     */
    public function getTrainingData($sUserId, $aScheduleIds)
    {
        $sPlaceHolders = str_repeat ('?, ',  count ($aScheduleIds) - 1) . '?';

        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tt.id AS trainingId,
                tt.scheduleId, tp.id AS paymentId,
                tp.isPaid AS paymentStatus
            FROM tbl_training tt
            INNER JOIN tbl_payments tp
            ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND studentId = $sUserId
                AND scheduleId IN ($sPlaceHolders)
        ");

        // Execute the above statement.
        $statement->execute($aScheduleIds);

        // Return the column of the executed query.
        return $statement->fetchAll();
    }

}