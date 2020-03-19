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
            SELECT *
            FROM tbl_users tu
            WHERE position = 'Instructor'
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

}
