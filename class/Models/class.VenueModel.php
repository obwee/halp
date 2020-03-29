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

    /**
     * addVenue
     * Inserts a new record inside the venue table.
     * @param array $aData
     * @return int
     */
    public function addVenue($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            INSERT INTO tbl_venue
                (venue, address, contactNum)
            VALUES
                (:venue, :address, :contactNum)
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * updateVenue
     * Queries the venue table in updating a venue.
     * @param array $aData
     * @return int
     */
    public function updateVenue($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_venue
            SET
                venue      = :venue,
                address    = :address,
                contactNum = :contactNum
            WHERE id = :id
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }

    /**
     * deleteVenue
     * Queries the venue table in deleting a venue.
     * @param array $aData
     * @return int
     */
    public function enableDisableVenue($aData)
    {
        // Prepare an update query to the schedules table.
        $statement = $this->oConnection->prepare("
            UPDATE tbl_venue
            SET status = :status
            WHERE id = :id
        ");

        // Return the result of the execution of the above statement.
        return $statement->execute($aData);
    }
}
