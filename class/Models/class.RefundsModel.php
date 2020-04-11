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
                (trainingId, refundReason)
            VALUES
                (:trainingId, :refundReason)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }
}
