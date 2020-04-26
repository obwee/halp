<?php
include_once 'utils/dbConnection.php';

/**
 * StudentModel
 * Class for communicating to the database related to students.
 */
class StudentModel
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
     * insertStudent
     * Insert student to database.
     * @param array $aStudentData
     * @return bool
     */
    public function insertStudent($aStudentData)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare(" 
            INSERT INTO tbl_users
             (username, password, firstName, middleName, lastName, position, companyName, contactNum, email) 
            VALUES
             (:username, :password, :firstName, :middleName, :lastName, :position, :companyName, :contactNum, :email)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aStudentData);
    }

    /**
     * checkUsernameIfTaken
     * Checks if the username is already taken.
     * @param string $sUsername
     * @return int
     */
    public function checkUsernameIfTaken($sUsername)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_users
            WHERE username = :username
        ");

        // Execute the above statement.
        $statement->execute(
            array(
                ':username' => $sUsername
            )
        );

        // Return the number of rows returned by the executed query.
        return $statement->rowCount();
    }

    /**
     * insertEmail
     * Insert email to database.
     * @param array $aEmailDetails
     * @return bool
     */
    public function insertEmail($aEmailDetails)
    {
        // Prepare an insert query.
        $statement = $this->oConnection->prepare("
        INSERT INTO tbl_emails
            (firstName, middleName, lastName, email, title, message, dateSent)
        VALUES
            (:firstName, :middleName, :lastName, :email, :title, :message, :dateSent)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aEmailDetails);
    }

    /**
     * getUserIdByUsername
     * Get user ID inside the tbl_users table using username stored inside session.
     */
    public function getUserIdByUsername($sUsername)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT userId
            FROM tbl_users
            WHERE username = ?
        ");

        // Execute the above statement.
        $statement->execute(
            array(
                $sUsername
            )
        );

        // Return the result of the execution of the above statement.
        return $statement->fetchColumn();
    }

    /**
     * getUserIdByFirstAndLastName
     * Get user ID inside the tbl_users table using first name and last name.
     */
    public function getUserIdByFirstAndLastName($sFirstName, $sLastName)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT userId
            FROM tbl_users
            WHERE 1 = 1
                AND firstName = ?
                AND lastName = ?
        ");

        // Execute the above statement.
        $statement->execute(
            array(
                $sFirstName,
                $sLastName
            )
        );

        // Return the result of the execution of the above statement.
        return $statement->fetchColumn();
    }

    /**
     * getUserDetails
     * Get user ID inside the tbl_users table.
     */
    public function getUserDetails($aUserId)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT firstName, middleName, lastName, contactNum, email, companyName
            FROM tbl_users
            WHERE userId = :userId
        ");

        // Execute the above statement.
        $statement->execute($aUserId);

        // Return the result of the execution of the above statement.
        return $statement->fetch();
    }

    public function fetchEnrollees()
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT tu.userId AS studentId, tt.id AS trainingId, CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                   tc.courseCode, ts.coursePrice, tv.venue, ts.fromDate, ts.toDate, ts.numRepetitions, ts.recurrence,
                   ts.instructorId, tt.scheduleId, tp.id AS paymentId, tp.paymentMethod, tp.paymentDate,
                   tp.paymentAmount, tp.paymentFile, tp.isPaid AS paymentStatus, tp.isApproved AS paymentApproval
            FROM tbl_users           tu
            INNER JOIN tbl_training  tt
                ON tt.studentId  = tu.userId
            INNER JOIN tbl_schedules ts
                ON ts.id         = tt.scheduleId
            INNER JOIN tbl_courses   tc
                ON tc.id         = ts.courseId
            INNER JOIN tbl_venue     tv
                ON tv.id         = ts.venueId
            LEFT JOIN tbl_payments   tp
                ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tt.isDone = 0
                AND tt.isCancelled = 0
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    public function fetchStudents()
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT tu.userId AS studentId, CONCAT(tu.firstname, ' ', tu.lastName) AS studentName
            FROM tbl_users tu
            WHERE position = 'Student'
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }

    public function fetchFilteredEnrollees($aParams)
    {
        $sQuery = "
            SELECT tu.userId AS studentId, tt.id AS trainingId, CONCAT(tu.firstName, ' ', tu.lastName) AS studentName,
                  tc.courseCode, ts.coursePrice, tv.venue, ts.fromDate, ts.toDate, ts.numRepetitions, ts.recurrence,
                  ts.instructorId, tt.scheduleId, tp.id AS paymentId, tp.paymentMethod, tp.paymentDate,
                  tp.paymentAmount, tp.paymentFile, tp.isPaid AS paymentStatus, tp.isApproved AS paymentApproval
            FROM tbl_users           tu
            INNER JOIN tbl_training  tt
                ON tt.studentId  = tu.userId
            INNER JOIN tbl_schedules ts
                ON ts.id         = tt.scheduleId
            INNER JOIN tbl_courses   tc
                ON tc.id         = ts.courseId
            INNER JOIN tbl_venue     tv
                ON tv.id         = ts.venueId
            LEFT JOIN tbl_payments   tp
                ON tp.trainingId = tt.id
            WHERE 1 = 1
                AND tt.isDone = 0
                AND tt.isCancelled = 0
        ";

        $aWhere = array(
            'paymentStatus' => 'AND tp.isPaid IN (%s) ',
            'venueId'       => 'AND tv.id IN (%s) ',
            'courseId'      => 'AND tc.id = %s ',
            'scheduleId'    => 'AND ts.id = %s '
        );

        foreach($aParams as $sKey => $mValue) {
            if (is_array($mValue) === true) {
                $sQuery .= sprintf($aWhere[$sKey], implode(', ', $mValue));
                continue;
            }
            $sQuery .= sprintf($aWhere[$sKey], $mValue);
        }

        $oStatement = $this->oConnection->prepare($sQuery);
        $oStatement->execute();
        return $oStatement->fetchAll();
    }

    public function getStudentsDetails($aStudentDetails)
    {
        $sPlaceHolders = str_repeat ('?, ',  count ($aStudentDetails) - 1) . '?';

        // Query the tbl_quotation_details.
        $statement = $this->oConnection->prepare("
            SELECT
                userId AS studentId,
                CONCAT(firstName, ' ', lastName) AS studentName
            FROM tbl_users
            WHERE userId IN ($sPlaceHolders)
        ");

        // Execute the above statement along with the needed where clauses.
        $statement->execute($aStudentDetails);

        // Return the result of the execution of the above statement.
        return $statement->fetchAll();
    }
}
