<?php
require_once('utils/dbConnection.php');

/**
 * PaymentModel
 * Class for payment method-related database functionalities.
 */
class PaymentModel
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
     * fetchModeOfPayments
     * Queries the payment methods table in getting all the venues.
     * @return array
     */
    public function fetchModeOfPayments()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_payment_methods tpm
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * addPaymentMethod
     * Inserts a new record inside the payment methods table.
     * @param array $aData
     * @return int
     */
    public function addPaymentMethod($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_payment_methods (methodName)
            VALUES (:methodName)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * updatePaymentMethod
     * Queries the payment methods table in updating a payment mode.
     * @param array $aData
     * @return int
     */
    public function updatePaymentMethod($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payment_methods
            SET methodName = :methodName
            WHERE id = :id
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * enableDisablePaymentMethod
     * Queries the payment method table in enabling/disabling a payment mode.
     * @param array $aData
     * @return int
     */
    public function enableDisablePaymentMethod($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payment_methods
            SET status = :status
            WHERE id = :id
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }

    public function getPaymentDetails($aTrainingId)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tt.id AS trainingId, ts.coursePrice,
                tt.scheduleId, tp.paymentDate, tp.id AS paymentId,
                tp.paymentAmount AS paymentAmount, tp.paymentMethod,
                tp.isApproved, tp.paymentFile, tp.isPaid AS paymentStatus
            FROM tbl_training tt
            INNER JOIN tbl_schedules ts
            ON tt.scheduleId = ts.id
            LEFT JOIN tbl_payments tp
            ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tt.id = :trainingId
        ");

        // Execute the above statement.
        $statement->execute($aTrainingId);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function addPayment($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_payments
                (trainingId, paymentDate, paymentFile)
            VALUES
                (:trainingId, :paymentDate, :paymentFile)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }
}
