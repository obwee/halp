<?php
require_once('utils/dbConnection.php');

/**
 * RefundsModel
 * Class for refund-related database functionalities.
 */
class RefundsModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * VenueModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * requestRefund
     * Queries the refunds table for requesting a refund.
     * @param array $aData
     * @return int
     */
    public function requestRefund($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_refunds
                (trainingId, refundReason, dateRequested)
            VALUES
                (:trainingId, :refundReason, :dateRequested)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * checkIfAlreadyRequestedForRefund
     * @param array $aData
     * @return int
     */
    public function checkIfAlreadyRequestedForRefund($iTrainingId)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            SELECT COUNT(*)
            FROM tbl_refunds
            WHERE trainingId = ?
        ");

        // Return the result of the execution of the above statement.
        $statement->execute([$iTrainingId]);

        return $statement->fetchColumn();
    }

    /**
     * fetchAllRefundRequests
     * @return array
     */
    public function fetchAllRefundRequests()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tu.userId AS studentId,
                CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                tu.contactNum, tu.email, tr.isApproved AS refundStatus,
                tt.id AS trainingId
            FROM tbl_training      tt
            INNER JOIN tbl_users   tu
                ON tt.studentId = tu.userId
            INNER JOIN tbl_refunds tr
                ON tr.trainingId = tt.id
            WHERE 1 = 1
            GROUP BY tt.id
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchRefundDetails($aTrainingId)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tt.id AS trainingId, tt.scheduleId, tp.id AS paymentId,
                tr.id AS refundId, ts.coursePrice,
                tp.paymentAmount AS paymentAmount, tp.paymentMethod,
                tp.isApproved, tp.paymentFile, tp.isPaid AS paymentStatus,
                tr.dateRequested, tr.refundReason, tr.executor AS approvedBy
            FROM tbl_training tt
            INNER JOIN tbl_schedules ts
                ON tt.scheduleId = ts.id
            INNER JOIN tbl_payments tp
                ON tp.trainingId = tt.id
            INNER JOIN tbl_refunds tr
                ON tr.trainingId = tt.id
            WHERE 1 = 1
                AND tt.id = :trainingId
                AND tp.isPaid != 0
        ");

        // Execute the above statement.
        $statement->execute($aTrainingId);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * rejectRefund
     * Queries the refunds table in rejecting refund.
     * @param array $iTrainingId
     * @return int
     */
    public function rejectRefund($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_refunds
            SET
                isApproved = 2,
                executor   = :executor
            WHERE id = :id
            AND isApproved = 0
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }

    /**
     * approveRefund
     * Queries the refunds table in rejecting refund.
     * @param array $iTrainingId
     * @return int
     */
    public function approveRefund($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_refunds
            SET
                isApproved = 1,
                executor   = :executor
            WHERE id = :id
            AND isApproved = 0
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }

    public function getRefundsByTrainingId($aTrainingIds)
    {
        $sPlaceHolders = str_repeat('?, ',  count($aTrainingIds) - 1) . '?';

        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT tr.trainingId, tu.userId AS studentId,
                   MAX(tr.isApproved) AS refundStatus
            FROM tbl_refunds tr
            INNER JOIN tbl_training tt
                ON tt.id = tr.trainingId
            INNER JOIN tbl_users tu
                ON tu.userId = tt.studentId
            WHERE 1 = 1
                AND tr.trainingId IN ($sPlaceHolders)
            GROUP BY tr.trainingId
        ");

        // Execute the above statement.
        $statement->execute($aTrainingIds);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }
}
