<?php
require_once('utils/dbConnection.php');

/**
 * PaymentMethodsModel
 * Class for payment method-related database functionalities.
 */
class PaymentMethodsModel
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
}
