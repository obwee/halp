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
        $sPlaceHolders = str_repeat('?, ',  count($aScheduleIds) - 1) . '?';

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

    /**
     * enrollForTraining
     * Enroll a student for training.
     * @param int $iScheduleId
     * @param int $iCourseId
     * @param int $iStudentId
     * @return int
     */
    public function enrollForTraining($iScheduleId, $iCourseId, $iStudentId)
    {
        try {
            $this->oConnection->beginTransaction();

            // Prepare an insert query to the training table.
            $oTrainingStatement = $this->oConnection->prepare("
                INSERT INTO tbl_training
                    (scheduleId, studentId)
                VALUES
                    (?, ?)
            ");

            $oTrainingStatement->execute([
                $iScheduleId,
                $iStudentId
            ]);

            // Prepare an insert query to the payment table.
            $oPaymentStatement = $this->oConnection->prepare("
                INSERT INTO tbl_payments
                    (trainingId, paymentDate)
                VALUES
                    (?, ?)
            ");

            // Execute update.
            $oPaymentStatement->execute([
                $this->oConnection->lastInsertId(),
                date('Y-m-d H:i:s')
            ]);

            // Prepare an update query to the schedule table.
            $oScheduleStatement = $this->oConnection->prepare("
                UPDATE tbl_schedules
                    SET remainingSlots = (remainingSlots - 1)
                WHERE 1 = 1
                    AND id         = ?
                    AND courseId   = ?
            ");

            // Execute update.
            $oScheduleStatement->execute([
                $iScheduleId,
                $iCourseId
            ]);
            return $this->oConnection->commit();
        } catch (PDOException $oError) {
            $this->oConnection->rollBack();
            return 0;
        }
    }
}
