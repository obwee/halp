<?php
require_once('utils/dbConnection.php');

/**
 * InstructorsModel
 * Class for instructor-related database functionalities.
 */
class InstructorsModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * UsersModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * fetchInstructors
     * Queries the users table in getting all the instructors.
     * @return array
     */
    public function fetchInstructors()
    {
        // Prepare a select query.
        $oStatement = $this->oConnection->prepare("
            SELECT
                tu.userId AS id, tu.firstName, tu.middleName, tu.lastName,
                tu.contactNum, tu.email, tu.certificationTitle, tu.status
            FROM tbl_users tu
            WHERE tu.position = 'Instructor'
        ");

        // Execute the above statement.
        $oStatement->execute();

        // Return the number of rows returned by the executed query.
        return $oStatement->fetchAll();
    }

    /**
     * addInstructor
     * Inserts a new record inside the users table.
     * @param array $aData
     * @return int
     */
    public function addInstructor($aData)
    {
        // Prepare an update query to the schedules table.
        $oStatement = $this->oConnection->prepare("
            INSERT INTO tbl_users
                (firstName, middleName, lastName, email, contactNum, certificationTitle, position)
            VALUES
                (:firstName, :middleName, :lastName, :email, :contactNum, :certificationTitle, 'Instructor')
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * updateInstructor
     * Updates the instructor details inside the users table.
     * @param array $aData
     * @return int
     */
    public function updateInstructor($aData)
    {
        // Prepare an update query to the schedules table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET
                firstName          = :firstName,
                middleName         = :middleName,
                lastName           = :lastName,
                email              = :email,
                contactNum         = :contactNum,
                certificationTitle = :certificationTitle
            WHERE userId = :userId
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }

    /**
     * enableDisableInstructor
     * Updates the instructor status inside the users table.
     * @param array $aData
     * @return int
     */
    public function enableDisableInstructor($aData)
    {
        // Prepare an update query to the schedules table.
        $oStatement = $this->oConnection->prepare("
            UPDATE tbl_users
            SET
                status = :status
            WHERE userId = :userId
        ");

        // Return the result of the execution of the above statement.
        return $oStatement->execute($aData);
    }
}
