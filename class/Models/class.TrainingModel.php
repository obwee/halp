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
                tp.paymentAmount AS paymentAmount,
                tp.isPaid AS paymentStatus, tp.paymentFile
            FROM tbl_training tt
            LEFT JOIN tbl_payments tp
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

            // // Prepare an insert query to the payment table.
            // $oPaymentStatement = $this->oConnection->prepare("
            //     INSERT INTO tbl_payments
            //         (trainingId, paymentDate)
            //     VALUES
            //         (?, ?)
            // ");

            // // Execute update.
            // $oPaymentStatement->execute([
            //     $this->oConnection->lastInsertId(),
            //     date('Y-m-d H:i:s')
            // ]);

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

    public function fetchTrainingDetails($iStudentId, $iTrainingId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tc.courseName, tc.courseDescription, tc.courseCode, ts.coursePrice,
                   ts.fromDate, ts.toDate, tv.venue, ts.recurrence, ts.numRepetitions
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
                ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
                ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
                ON tt.scheduleId = ts.id
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
                AND tt.id = ?
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId, $iTrainingId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetch();
    }

    public function fetchTrainingDataOfSelectedStudent($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tt.id AS trainingId, tc.courseName, tc.courseDescription, tc.courseCode, ts.coursePrice,
                    ts.fromDate, ts.toDate, tv.venue, ts.recurrence, ts.numRepetitions,
                    ts.instructorId, tp.id AS paymentId, tp.paymentMethod, tp.paymentDate,
                    -- tp.isPaid AS paymentStatus
                    SUM(tp.paymentAmount) AS paymentAmount, tp.paymentFile, tp.isPaid AS paymentStatus
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
                ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
                ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
                ON tt.scheduleId = ts.id
            INNER JOIN tbl_payments  tp
                ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
                AND tp.isPaid IN (0)
                AND tp.isApproved != 2
            GROUP BY tt.id
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchPaidReservations($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT  tt.id AS trainingId, tc.courseName, tc.courseCode, ts.coursePrice,
                    ts.fromDate, ts.toDate, tv.venue, ts.recurrence, ts.numRepetitions,
                    CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
            ON tt.scheduleId = ts.id
            INNER JOIN tbl_users     tu
            ON ts.instructorId = tu.userId
            INNER JOIN tbl_payments  tp
            ON tp.trainingId  = tt.id
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
                AND tp.isPaid = 2
            GROUP BY tt.id
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchTrainingDataOfSelectedStudentWithRejectedPayment($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tt.id AS trainingId, tc.courseName, tc.courseDescription, tc.courseCode, ts.coursePrice,
                    ts.fromDate, ts.toDate, tv.venue, ts.recurrence, ts.numRepetitions,
                    ts.instructorId, tp.id AS paymentId, tp.paymentMethod, tp.paymentDate,
                    -- tp.isPaid AS paymentStatus
                    SUM(tp.paymentAmount) AS paymentAmount, tp.paymentFile, tp.isPaid AS paymentStatus
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
                ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
                ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
                ON tt.scheduleId = ts.id
            INNER JOIN tbl_payments  tp
                ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
                AND tp.isApproved = 2
                AND tp.rejectReason IS NOT NULL
            GROUP BY tt.id
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchRejectedPayments($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT  tt.id AS trainingId, tc.courseName, tc.courseCode, ts.coursePrice,
                    ts.fromDate, ts.toDate, tv.venue, ts.recurrence, ts.numRepetitions,
                    CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
            ON tt.scheduleId = ts.id
            INNER JOIN tbl_users     tu
            ON ts.instructorId = tu.userId
            INNER JOIN tbl_payments  tp
            ON tp.trainingId  = tt.id
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
                AND tp.isApproved = 2
                AND tp.rejectReason IS NOT NULL
            GROUP BY tt.id
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function cancelReservation($aData)
    {
        $sQuery = $this->oConnection->prepare("
            UPDATE tbl_training
            SET
                isCancelled = 1,
                cancellationReason = :cancellationReason
            WHERE 1 = 1
                AND id = :id
        ");

        // Execute the above statement.
        return $sQuery->execute($aData);
    }

    public function fetchCancelledReservations($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tc.courseCode, ts.coursePrice, ts.fromDate, ts.toDate,
                   tv.venue, ts.recurrence, ts.numRepetitions,
                   CONCAT(tu.firstName, ' ', tu.lastName) AS instructorName,
                   tt.cancellationReason
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
            ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
            ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
            ON tt.scheduleId = ts.id
            INNER JOIN tbl_users     tu
            ON ts.instructorId = tu.userId
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.isCancelled = 1
                AND tt.studentId = ?
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchTrainingDataOfSelectedStudentWithRefunds($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT tt.id AS trainingId, tc.courseName, tc.courseCode, ts.coursePrice,
                    ts.fromDate, ts.toDate, tv.venue, ts.recurrence, ts.numRepetitions,
                    ts.instructorId, CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                    tu.contactNum, tu.email, tr.isApproved AS refundStatus
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts
                ON tc.id = ts.courseId
            INNER JOIN tbl_venue     tv
                ON tv.id = ts.venueId
            INNER JOIN tbl_training  tt
                ON tt.scheduleId = ts.id
            INNER JOIN tbl_refunds   tr
                ON tr.trainingId = tt.id
            INNER JOIN tbl_users     tu
                ON tu.userId = tt.studentId
            WHERE 1 = 1
                AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND tt.studentId = ?
            GROUP BY tt.id
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }
}
