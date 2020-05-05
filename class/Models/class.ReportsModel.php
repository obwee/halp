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
            WHERE 1 = 1 ";

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
}
