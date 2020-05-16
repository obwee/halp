<?php
require_once('utils/dbConnection.php');

/**
 * ReportsModel
 * Class for venue-related database functionalities.
 */
class ReportsModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * ReportsModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * fetchSalesReport
     * @return array
     */
    public function fetchSalesReport()
    {
        $oQuery = $this->oConnection->prepare(
            "SELECT MAX(tp.paymentDate) AS paymentDate, CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                    tc.courseCode, ts.fromDate, ts.toDate, ts.recurrence, ts.numRepetitions, tv.venue,
                    ts.coursePrice, SUM(tp.paymentAmount) AS paymentAmount, MAX(tp.isPaid) AS paymentStatus,
                    ts.id AS scheduleId
             FROM tbl_schedules ts
             INNER JOIN tbl_training tt
             ON tt.scheduleId = ts.id
             INNER JOIN tbl_venue tv
             ON tv.id = ts.venueId
             INNER JOIN tbl_payments tp
             ON tp.trainingId = tt.id
             INNER JOIN tbl_users tu
             ON tu.userId = tt.studentId
             INNER JOIN tbl_courses tc
             ON tc.id = ts.courseId
                WHERE 1 = 1
                AND tp.isPaid = 1
             GROUP BY ts.id
             ORDER BY ts.toDate ASC"
        );

        $oQuery->execute();

        return $oQuery->fetchAll();
    }

    public function fetchFilteredSalesReport($aParams)
    {
        $sQuery = "SELECT MAX(tp.paymentDate) AS paymentDate, CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                   tc.courseCode, ts.fromDate, ts.toDate, ts.recurrence, ts.numRepetitions, tv.venue,
                   ts.coursePrice, SUM(tp.paymentAmount) AS paymentAmount, MAX(tp.isPaid) AS paymentStatus,
                   ts.id AS scheduleId
            FROM tbl_schedules ts
            INNER JOIN tbl_training tt
            ON tt.scheduleId = ts.id
            INNER JOIN tbl_venue tv
            ON tv.id = ts.venueId
            INNER JOIN tbl_payments tp
            ON tp.trainingId = tt.id
            INNER JOIN tbl_users tu
            ON tu.userId = tt.studentId
            INNER JOIN tbl_courses tc
            ON tc.id = ts.courseId
            WHERE 1 = 1  AND tp.isPaid = 1 ";

        $aWhere = array(
            'fromDate'   => 'AND ts.fromDate >= "%s" ',
            'toDate'     => 'AND ts.toDate <= "%s" ',
            'venueId'    => 'AND tv.id = %s ',
            'courseId'   => 'AND tc.id = %s ',
            'scheduleId' => 'AND ts.id = %s '
        );

        foreach ($aParams as $sKey => $sValue) {
            $sQuery .= sprintf($aWhere[$sKey], $sValue);
        }

        $sQuery .= "GROUP BY ts.id ORDER BY ts.toDate ASC";

        $oStatement = $this->oConnection->prepare($sQuery);
        $oStatement->execute();
        return $oStatement->fetchAll();
    }

    public function getStatistics()
    {
        $aData = array();

        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_quotation_details tqd
            LEFT JOIN tbl_quotation_senders tqs
                ON tqs.quoteSenderId = tqd.senderId
            LEFT JOIN tbl_users tu
                ON tu.userId = tqd.userId
            WHERE tqd.isQuotationSent = 0
            GROUP BY tqd.userId, tqd.senderId
        ");

        $oStatement->execute();
        $aData['iQuotationCount'] = $oStatement->rowCount();

        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_payments tp
            RIGHT JOIN tbl_training tt
            ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tp.isPaid = 1
                AND tp.isApproved = 1
                AND tt.isDone = 0
                AND tt.isCancelled = 0
            GROUP BY tt.id
        ");

        $oStatement->execute();
        $aData['iPartiallyPaidCount'] = $oStatement->rowCount();

        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_payments tp
            RIGHT JOIN tbl_training tt
            ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tp.isPaid = 2
                AND tp.isApproved = 1
                AND tt.isDone = 0
                AND tt.isCancelled = 0
            GROUP BY tt.id
        ");

        $oStatement->execute();
        $aData['iFullyPaidCount'] = $oStatement->rowCount();

        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT SUM(tp.paymentAmount) AS totalPayment, ts.coursePrice, tt.id
            FROM tbl_training tt
            LEFT JOIN tbl_payments tp
            ON tp.trainingId = tt.id
            INNER JOIN tbl_schedules ts
            ON ts.id = tt.scheduleId
            WHERE 1 = 1
                AND (tp.trainingId IS NULL OR tp.isPaid = 0)
            GROUP BY tp.trainingId
            HAVING totalPayment = 0
        ");

        $oStatement->execute();
        $aData['iUnpaidCount'] = $oStatement->fetchAll();

        return $aData;
    }
}
