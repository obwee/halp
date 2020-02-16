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
     */
    public function insertStudent($aStudentData)
    {
        // Query the tbl_users for a username equal to $username.
        $statement = $this->oConnection->prepare(" 
            INSERT INTO tbl_users
             (username, password, firstName, middleName, lastName, position, companyName, contactNum, email) 
            VALUES
             (:username, :password, :firstName, :middleName, :lastName, :position, :companyName, :contactNum, :email)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aStudentData);
    }

}