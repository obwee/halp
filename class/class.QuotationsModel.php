<?php
include_once 'utils/dbConnection.php';

/**
 * QuotationsModel
 * Class for communicating to the database related to quotations.
 */
class QuotationsModel
{

    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * insertQuotationSender
     * Insert new quotation sender to tbl_quotation_senders table.
     */
    public function insertQuotationSender($aSenderDetails)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_quotation_senders
                (firstName, middleName, lastName, email, contactNum, companyName)
            VALUES
                (:firstName, :middleName, :lastName, :email, :contactNum, :companyName)
        ");

        // Execute the above statement.
        $statement->execute($aSenderDetails);

        // Return the last inserted id.
        return $this->oConnection->lastInsertId();
    }

    /**
     * checkIfSenderExists
     * Check if sender exists inside the tbl_quotation_senders table.
     */
    public function checkIfSenderExists($sFirstName, $sLastName)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT quoteSenderId
            FROM tbl_quotation_senders
            WHERE firstName = :firstName AND lastName = :lastName
        ");

        // Execute the above statement.
        $statement->execute(
            array(
                ':firstName' => $sFirstName,
                ':lastName'  => $sLastName
            )
        );

        // Return the result of the execution of the above statement.
        return $statement->fetchColumn();
    }

    /**
     * insertQuotationDetails
     * Insert new quotation details to tbl_quotation_details table.
     */
    public function insertQuotationDetails($aSenderDetails)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_quotation_details
                (userId, senderId, courseId, scheduleId, dateSent, isCompanySponsored)
            VALUES
                (:userId, :senderId, :courseId, :scheduleId, :dateSent, :isCompanySponsored)
        ");

        // Execute the above statement.
        $statement->execute($aSenderDetails);

        // Return the last inserted id.
        return $this->oConnection->lastInsertId();
    }
}