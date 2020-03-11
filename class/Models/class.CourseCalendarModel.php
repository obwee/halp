<?php
require_once('utils/dbConnection.php');

class CourseCalendarModel
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

    public function fetchCourses()
    {
        // Query the tbl_courses.

        $statement = $this->oConnection->prepare("
            SELECT * FROM tbl_courses");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }