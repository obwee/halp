<?php
require_once('utils/dbConnection.php');

/**
 * UsersModel
 * Class for venue-related database functionalities.
 */
class UsersModel
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
        $statement = $this->oConnection->prepare("
            SELECT
                tu.userId AS id, tu.firstName, tu.middleName, tu.lastName,
                tu.contactNum, tu.email, tu.certificationTitle, tu.status
            FROM tbl_users tu
            WHERE tu.position = 'Instructor'
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

}
