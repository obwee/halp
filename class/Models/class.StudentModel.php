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
            SELECT firstName, middleName, lastName, contactNum, email
            FROM tbl_users
            WHERE userId = :userId
        ");

        // Execute the above statement.
        $statement->execute($aUserId);

        // Return the result of the execution of the above statement.
        return $statement->fetch();
    }

}
