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

    /**
     * QuotationsModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * insertQuotationSender
     * Insert new quotation sender to tbl_quotation_senders table.
     * @return int
     */
    public function insertQuotationSender($aSenderDetails)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_quotation_senders
                (firstName, middleName, lastName, email, contactNum)
            VALUES
                (:firstName, :middleName, :lastName, :email, :contactNum)
        ");

        // Execute the above statement.
        $statement->execute($aSenderDetails);

        // Return the last inserted id.
        return $this->oConnection->lastInsertId();
    }

    /**
     * checkIfSenderExists
     * Check if sender exists inside the tbl_quotation_senders table.
     * @return string
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
     * @return int
     */
    public function insertQuotationDetails($aSenderDetails)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_quotation_details
                (userId, senderId, courseId, scheduleId, numPax, companyName, isCompanySponsored, dateRequested)
            VALUES
                (:userId, :senderId, :courseId, :scheduleId, :numPax, :companyName, :isCompanySponsored, :dateRequested)
        ");

        // Execute the above statement.
        $statement->execute($aSenderDetails);

        // Return the last inserted id.
        return $this->oConnection->lastInsertId();
    }

    /**
     * fetchSendersBySenderId
     * Fetch quotation senders from the tbl_quotation_senders table using quoteSenderId.
     * @return array
     */
    public function fetchSendersBySenderId($aIsQuotationSent)
    {
        // Prepare an inner join select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tqd.senderId, tqd.userId,
                tqs.firstName, tqs.middleName, tqs.lastName, tqs.email, tqs.contactNum,
                tqd.dateRequested
            FROM       tbl_quotation_details tqd
            INNER JOIN tbl_quotation_senders tqs
            ON tqs.quoteSenderId = tqd.senderId
            WHERE tqd.isQuotationSent = :isQuotationSent
            GROUP BY tqd.userId, tqd.senderId
        ");

        // Execute the above statement.
        $statement->execute($aIsQuotationSent);

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    /**
     * fetchSendersByUserId
     * Fetch quotation senders from the tbl_quotation_senders table using userId.
     */
    public function fetchSendersByUserId($aIsQuotationSent)
    {
        // Query the tbl_quotation_senders.
        $statement = $this->oConnection->prepare("
            SELECT
                tqd.senderId, tqd.userId,
                tu.firstName, tu.middleName, tu.lastName, tu.email, tu.contactNum,
                tqd.dateRequested
            FROM       tbl_quotation_details tqd
            INNER JOIN tbl_users             tu
            ON tu.userId = tqd.userId
            WHERE tqd.isQuotationSent = :isQuotationSent
            GROUP BY tqd.userId, tqd.senderId
        ");

        // Execute the above statement.
        $statement->execute($aIsQuotationSent);

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    /**
     * fetchRequests
     * Fetch quotation details from the tbl_quotation_senders table using senderId and userId.
     * @param array $aData
     */
    public function fetchRequests($aData)
    {
        // Query the tbl_quotation_details.
        $statement = $this->oConnection->prepare("
            SELECT
                dateRequested, companyName, isCompanySponsored, userId, senderId,
                COUNT(dateRequested) as numberOfCourses
            FROM tbl_quotation_details
            WHERE
                userId = :userId AND senderId = :senderId AND isQuotationSent = :isQuotationSent
            GROUP BY dateRequested
            ORDER BY dateRequested ASC
        ");

        // Execute the above statement along with the needed where clauses.
        $statement->execute($aData);

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    /**
     * fetchDetails
     * Fetch quotation details from the tbl_quotation_details table using senderId and userId.
     * @param array $aData
     */
    public function fetchDetails($aData)
    {
        // Query the tbl_quotation_details.
        $statement = $this->oConnection->prepare("
            SELECT
                tqd.courseId, tc.courseDescription, tc.courseName, tc.courseCode, tc.coursePrice,
                tqd.numPax, tqd.companyName, tqd.isCompanySponsored,
                ts.fromDate, ts.toDate, tv.venue
            FROM tbl_quotation_details tqd
            INNER JOIN tbl_courses           tc ON tqd.courseId   = tc.id
            LEFT  JOIN tbl_schedules         ts ON tqd.scheduleId = ts.id
            LEFT  JOIN tbl_venue             tv ON ts.venueId = tv.id
            WHERE
                tqd.userId = :userId AND tqd.senderId = :senderId
                AND tqd.isQuotationSent = :isQuotationSent AND tqd.dateRequested = :dateRequested
        ");

        // Execute the above statement along with the needed where clauses.
        $statement->execute($aData);

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    /**
     * deleteQuotation
     * Delete the old quotation for editing purposes.
     */
    public function deleteQuotation($aIds)
    {
        // Prepare a delete query for the tbl_quotation_details table.
        $statement = $this->oConnection->prepare("
            DELETE FROM tbl_quotation_details
            WHERE senderId = :senderId AND userId = :userId AND dateRequested = :dateRequested
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aIds);
    }

    public function deleteSenderAndQuotations($aIds)
    {
        // Prepare a delete query for the tbl_quotation_senders table.
        $statement = $this->oConnection->prepare("
            DELETE FROM tbl_quotation_senders WHERE quoteSenderId = :quoteSenderId
        ");

        // Execute the above statement along with the needed where clauses.
        $statement->execute(
            array(
                ':quoteSenderId' => $aIds[':senderId']
            )
        );

        // Prepare a delete query for the tbl_quotation_details table.
        $statement = $this->oConnection->prepare("
            DELETE FROM tbl_quotation_details WHERE senderId = :senderId AND userId = :userId
        ");
    
        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aIds);
    }
    
    /**
     * approveQuotation
     * Approve the quotation.
     */
    public function approveQuotation($aIds)
    {
        // Prepare a delete query for the tbl_quotation_details table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_quotation_details
            SET isQuotationSent = 1
            WHERE senderId = :senderId AND userId = :userId AND dateRequested = :dateRequested
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aIds);
    }

    /**
     * fetchSenderAndQuotationDetails
     * Fetch sender and quotation details.
     */
    public function fetchSenderAndQuotationDetails($aIds)
    {
        // Query the tbl_quotation_details.
        $statement = $this->oConnection->prepare("
            SELECT
                tqd.companyName, tqd.isCompanySponsored,
                tqd.courseId, tc.courseName, tqd.numPax,
                ts.fromDate, ts.toDate
            FROM tbl_quotation_details tqd
            INNER JOIN tbl_courses     tc ON tqd.courseId   = tc.id
            LEFT  JOIN tbl_schedules   ts ON tqd.scheduleId = ts.id
            WHERE
                tqd.userId = :userId AND tqd.senderId = :senderId
                AND tqd.isQuotationSent = :isQuotationSent AND tqd.dateRequested = :dateRequested
        ");

        // Execute the above statement along with the needed where clauses.
        $statement->execute($aIds);
    }
}