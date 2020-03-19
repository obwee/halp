<?php
require_once('utils/dbConnection.php');

/**
 * VenueModel
 * Class for venue-related database functionalities.
 */
class VenueModel
{
    /**
     * @var dbConnection $oConnection
     * Holder for dbConnection instance.
     */
    private $oConnection;

    /**
     * VenueModel constructor.
     */
    public function __construct()
    {
        $this->oConnection = new dbConnection();
    }

    /**
     * fetchVenues
     * Queries the venue table in getting all the venues.
     * @return array
     */
    public function fetchVenues()
    {
        // Prepare a select query.
        $statement = $this->oConnection->prepare("
            SELECT *
            FROM tbl_venue tv
        ");

        // Execute the above statement.
        $statement->execute();

        // Return the number of rows returned by the executed query.
        return $statement->fetchAll();
    }

}
