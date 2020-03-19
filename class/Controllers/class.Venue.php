<?php

class Venue extends BaseController
{
    /**
     * @var VenueModel $oModel
     * Class instance for Venue model.
     */
    private $oVenueModel;

    /**
     * Venue constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the VenueModel class and store it inside $this->oVenueModel.
        $this->oVenueModel = new VenueModel();
    }

    /**
     * fetchVenues
     * Fetch venues from the database.
     */
    public function fetchVenues()
    {
        echo json_encode($this->oVenueModel->fetchVenues());
    }
}
