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
     * validateCourseAndSchedule
     * Checks if course and schedule selected from the front-end is valid.
     * @param array $aDetails
     * @return int
     */
    public function validateCourseAndSchedule($aDetails)
    {
        // Query the tbl_courses for a username equal to $username.
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM       tbl_courses   tc
            INNER JOIN tbl_schedules ts ON tc.id = ts.courseId
            WHERE tc.courseName = :quoteCourse
            AND   ts.fromDate = :fromDate
            AND   ts.toDate = :toDate
        ");

        // Execute the above statement.
        $statement->execute($aDetails);

        // Return the number of rows returned by the executed query.
        return $statement->rowCount();
    }

    /**
     * insertQuotation
     * Insert quotation to database.
     * @param array $aQuoteDetails
     */
    public function insertQuotation($aQuoteDetails)
    {
    }
}
