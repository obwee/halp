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

}