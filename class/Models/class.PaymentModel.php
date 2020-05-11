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
            WHERE methodName != 'Change'
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
                tp.isApproved, tp.paymentFile, tp.isPaid AS paymentStatus,
                tp.rejectReason
            FROM tbl_training tt
            INNER JOIN tbl_schedules ts
            ON tt.scheduleId = ts.id
            LEFT JOIN tbl_payments tp
            ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tt.id = :trainingId
                -- AND tp.isApproved != 2
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

    public function fetchStudentsThatHasPaid()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tu.userId AS studentId,
                CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                tu.contactNum, tu.email, tt.id AS trainingId
            FROM tbl_training       tt
            INNER JOIN tbl_users    tu
                ON tt.studentId = tu.userId
            INNER JOIN tbl_payments tp
                ON tp.trainingId = tt.id
            WHERE tp.isPaid = 0 AND tp.isApproved != 2 AND tt.isCancelled = 0
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchPaymentsByTrainingId($aTrainingIds)
    {
        $sPlaceHolders = str_repeat('?, ',  count($aTrainingIds) - 1) . '?';

        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT tp.id AS paymentId, tp.trainingId,
                   SUM(tp.paymentAmount) AS paymentAmount,
                   MAX(tp.isPaid) AS paymentStatus
            FROM tbl_payments tp
            WHERE tp.trainingId IN ($sPlaceHolders)
            -- GROUP BY tp.id
        ");

        // Execute the above statement.
        $statement->execute($aTrainingIds);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchTrainingDataByPaymentId($iPaymentId)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT tp.trainingId, ts.coursePrice, tt.isReserved, tt.scheduleId, tt.studentId, ts.courseId
            FROM tbl_payments tp
            INNER JOIN tbl_training tt
            ON tp.trainingId = tt.id
            INNER JOIN tbl_schedules ts
            ON ts.id = tt.scheduleId
            INNER JOIN tbl_courses tc
            ON tc.id = ts.courseId
            WHERE tp.id = ?
        ");

        // Execute the above statement.
        $statement->execute([$iPaymentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetch();
    }

    /**
     * approvePayment
     * Queries the payment table in approving payment.
     * @param array $aData
     * @return int
     */
    public function approvePayment($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payments
            SET
                paymentMethod = :paymentMethod, paymentAmount = :paymentAmount,
                isApproved = :isApproved, isPaid = :isPaid
            WHERE id = :id
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }

    /**
     * updatePaymentStatuses
     * Queries the payment table in updating payment status.
     * @param array $iTrainingId
     * @return int
     */
    public function updatePaymentStatuses($iTrainingId)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payments
            SET
                isPaid = 2
            WHERE trainingId = ?
            AND isApproved = 1
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute([$iTrainingId]);
    }

    /**
     * cancelRemainingPayments
     * Queries the payment table in updating payment status.
     * @param array $iTrainingId
     * @return int
     */
    public function cancelRemainingPayments($iTrainingId)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payments
            SET
                isApproved = 2,
                rejectReason = 'Fully paid already.'
            WHERE trainingId = ?
            AND isApproved = 0
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute([$iTrainingId]);
    }

    public function fetchStudentsWithRejectedPayments()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                tu.userId AS studentId,
                CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                tu.contactNum, tu.email
            FROM tbl_training       tt
            INNER JOIN tbl_users    tu
                ON tt.studentId = tu.userId
            INNER JOIN tbl_payments tp
                ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tp.isApproved = 2
                AND tp.rejectReason IS NOT NULL
            GROUP BY tu.userId
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    /**
     * rejectPayment
     * Queries the payment table in rejecting payment.
     * @param array $iTrainingId
     * @return int
     */
    public function rejectPayment($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payments
            SET
                isApproved = 2,
                rejectReason = :rejectReason
            WHERE id = :id
            AND isApproved = 0
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }

    /**
     * changePaymentStatus
     * Queries the payment table in changing payment status.
     * @param array $aParam
     * @return int
     */
    public function changePaymentStatus($aParam)
    {
        $statement = $this->oConnection->prepare("
            UPDATE tbl_payments tp
            SET
                tp.isPaid = ?
            WHERE 1 = 1
                AND tp.trainingId = ?
                AND tp.isApproved = 1
        ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute(array(
            $aParam['isPaid'],
            $aParam['trainingId']
        ));
    }

    public function updateUnsettledPayments()
    {
        $statement = $this->oConnection->prepare(
            "UPDATE tbl_training tt
                INNER JOIN tbl_schedules ts
                ON tt.scheduleId = ts.id
                LEFT JOIN tbl_payments tp
                ON tp.trainingId = tt.id
             SET
                tt.isCancelled = 1,
                tt.isReserved = 0,
                tt.cancellationReason = 'Unsettled payment.'
             WHERE 1 = 1
                AND tp.id IS NULL
                AND ts.fromDate < CURDATE()"
        );

        // Execute the above statement.
        return $statement->execute();
    }

    /**
     * getChange
     */
    public function getChange($aParams)
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT
                (SUM(tp.paymentAmount) - ts.coursePrice)
            FROM tbl_payments tp
            INNER JOIN tbl_training tt
                ON tp.trainingId = tt.id
            INNER JOIN tbl_schedules ts
                ON ts.id = tt.scheduleId
            WHERE 1 = 1
                AND tt.id = :trainingId
        ");

        // Execute the above statement.
        $statement->execute($aParams);

        // Return the number of rows returned by the executed query.
        return $statement->fetchColumn();
    }

    /**
     * clearChange
     */
    public function clearChange($aData)
    {
        // Prepare a delete query for the tbl_venue table.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_payments
                (trainingId, paymentDate, paymentMethod, paymentAmount, paymentFile, remarks, isApproved, isPaid)
            VALUES
                (:trainingId, :paymentDate, :paymentMethod, :paymentAmount, :paymentFile, :remarks, :isApproved, :isPaid)
            ");

        // Execute the above statement along with the needed where clauses then return.
        return $statement->execute($aData);
    }
}
