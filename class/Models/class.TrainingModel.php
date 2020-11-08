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

            // // Prepare an update query to the schedule table.
            // $oScheduleStatement = $this->oConnection->prepare("
            //     UPDATE tbl_schedules
            //         SET remainingSlots = (remainingSlots - 1)
            //     WHERE 1 = 1
            //         AND id         = ?
            //         AND courseId   = ?
            // ");

            // // Execute update.
            // $oScheduleStatement->execute([
            //     $iScheduleId,
            //     $iCourseId
            // ]);

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
                -- AND ts.fromDate > CURDATE()
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
                AND tp.isPaid = 0
                AND tp.isApproved != 2
                AND tt.isCancelled = 0
            GROUP BY tt.id
        ");

        print_r($statement);

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
                AND tt.isCancelled = 0
            GROUP BY tt.id
            ORDER BY ts.fromDate, tc.courseName ASC
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchRejectedReservations($iStudentId)
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
                -- AND ts.fromDate > CURDATE()
                -- AND ts.toDate > CURDATE()
                AND tt.studentId = ?
                AND tp.isApproved = 2
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
                -- AND ts.fromDate > CURDATE()
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
                isReserved = 0,
                cancellationReason = :cancellationReason
            WHERE id = :id
        ");

        // Execute the above statement.
        $sQuery->execute($aData);

        $sQuery = $this->oConnection->prepare("
            INSERT INTO tbl_cancellations (trainingId) VALUES (:id)
        ");

        // Execute the above statement.
        return $sQuery->execute(array(
            ':id' => $aData[':id']
        ));
    }

    public function checkIfCancelled($iTrainingId)
    {
        $sQuery = $this->oConnection->prepare(
            "SELECT * FROM tbl_cancellations WHERE trainingId = ?"
        );

        $sQuery->execute([$iTrainingId]);

        return $sQuery->rowCount() > 0;
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
                    tu.contactNum, tu.email, tr.isApproved AS refundStatus, tr.refundReason
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
                -- AND ts.toDate > CURDATE()
                AND tt.studentId = ?
            GROUP BY tt.id
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function fetchTrainingRequests($iStudentId)
    {
        // Query the tbl_courses.
        $statement = $this->oConnection->prepare("
            SELECT ts.courseId, tt.id AS trainingId, ts.id AS scheduleId,
                   tc.courseCode, ts.fromDate, ts.toDate, ts.recurrence, ts.numRepetitions,
                   tv.venue, ts.coursePrice, CONCAT(tu.firstName, ' ', tu.lastName) AS instructor,
                   tp.id AS paymentId, tp.paymentMethod, tp.paymentDate, tp.paymentAmount,
                   tp.paymentFile, tp.isPaid AS paymentStatus, tp.isApproved AS paymentApproval
            FROM tbl_schedules ts
            INNER JOIN tbl_training tt
                ON tt.scheduleId = ts.id
            INNER JOIN tbl_courses tc
                ON tc.id = ts.courseId
            INNER JOIN tbl_venue tv
                ON tv.id = ts.venueId
            INNER JOIN tbl_users tu
                ON tu.userId = ts.instructorId
            LEFT JOIN tbl_payments tp
                ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tt.studentId = ?
                AND tt.isDone = 0
                AND tt.isCancelled = 0
        ");

        // Execute the above statement.
        $statement->execute([$iStudentId]);

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

    public function markAsReserved($iTrainingId, $iScheduleId)
    {
        try {
            $this->oConnection->beginTransaction();

            $oTrainingStatement = $this->oConnection->prepare("
                UPDATE tbl_training
                SET isReserved = 1
                WHERE id = ?
            ");

            $oTrainingStatement->execute([
                $iTrainingId
            ]);

            $oTrainingStatement = $this->oConnection->prepare("
                UPDATE tbl_schedules
                SET remainingSlots = (remainingSlots - 1)
                WHERE id = ?
            ");

            $oTrainingStatement->execute([
                $iScheduleId
            ]);

            return $this->oConnection->commit();
        } catch (PDOException $oError) {
            $this->oConnection->rollBack();
            return 0;
        }
    }

    public function markAsUnreserved($iScheduleId)
    {
        $oTrainingStatement = $this->oConnection->prepare("
            UPDATE tbl_schedules
            SET remainingSlots = (remainingSlots + 1)
            WHERE id = ?
        ");

        return $oTrainingStatement->execute([$iScheduleId]);
    }

    public function getTrainingDataByTrainingId($iTrainingId)
    {
        $sQuery = $this->oConnection->prepare(
            "SELECT tt.*, ts.courseId
             FROM tbl_training tt
             INNER JOIN tbl_schedules ts
             ON tt.scheduleId = ts.id
             WHERE tt.id = ?"
        );

        $sQuery->execute([$iTrainingId]);

        return $sQuery->fetch();
    }

    public function changeSchedule($iScheduleId, $iTrainingId)
    {
        $oTrainingStatement = $this->oConnection->prepare("
            UPDATE tbl_training
            SET scheduleId = ?
            WHERE id = ?
        ");

        return $oTrainingStatement->execute([$iScheduleId, $iTrainingId]);
    }

    public function fetchClassLists()
    {
        $oQuery = $this->oConnection->prepare(
            "SELECT tc.courseCode, ts.fromDate, ts.toDate, ts.numSlots, ts.remainingSlots,
                    CONCAT(tu.firstName, ' ', tu.lastName) AS instructor, tv.venue,
                    ts.recurrence, ts.numRepetitions, ts.id AS scheduleId
             FROM tbl_schedules ts
             INNER JOIN tbl_users tu
             ON tu.userId = ts.instructorId
             INNER JOIN tbl_venue tv
             ON tv.id = ts.venueId
             INNER JOIN tbl_courses tc
             ON tc.id = ts.courseId
             WHERE 1 = 1
                -- AND ts.fromDate > CURDATE()
                AND ts.toDate > CURDATE()
                AND ts.status = 'Active'
                AND tv.status = 'Active'
            GROUP BY ts.id
            ORDER BY ts.toDate ASC
        ");

        $oQuery->execute();

        return $oQuery->fetchAll();
    }

    public function fetchFinishedTrainings()
    {
        $oQuery = $this->oConnection->prepare(
            "SELECT tc.courseCode, ts.fromDate, ts.toDate, ts.numSlots, ts.remainingSlots,
                    CONCAT(tu.firstName, ' ', tu.lastName) AS instructor, tv.venue,
                    ts.recurrence, ts.numRepetitions, ts.id AS scheduleId
             FROM tbl_schedules ts
             INNER JOIN tbl_users tu
             ON tu.userId = ts.instructorId
             INNER JOIN tbl_venue tv
             ON tv.id = ts.venueId
             INNER JOIN tbl_courses tc
             ON tc.id = ts.courseId
             INNER JOIN tbl_training tt
             ON tt.scheduleId = ts.id
             WHERE 1 = 1
                AND tt.isDone = 1
            GROUP BY ts.id
            ORDER BY ts.toDate ASC
        ");

        $oQuery->execute();

        return $oQuery->fetchAll();
    }

    public function updateFinishedTrainings()
    {
        $oTrainingStatement = $this->oConnection->prepare("
            UPDATE tbl_training tt
                INNER JOIN tbl_schedules ts
                ON ts.id = tt.scheduleId
            SET tt.isDone = 1
            WHERE ts.toDate < CURDATE()
        ");

        return $oTrainingStatement->execute();        
    }
}
