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

    /**
     * addVenue
     * Add a venue to the database.
     */
    public function addVenue()
    {
        // Declare an array with keys equivalent to that inside the database.
        $aDatabaseColumns = array(
            'branch'        => 'venue',
            'branchAddress' => 'address',
            'branchContact' => 'contactNum'
        );

        // Loop thru the POST data sent by AJAX for renaming.
        foreach ($this->aParams as $sKey => $mValue) {
            $sNewKeys = $aDatabaseColumns[$sKey];
            $this->aParams[$sNewKeys] = $mValue;
            unset($this->aParams[$sKey]);
        }

        Utils::sanitizeData($this->aParams);

        // Perform insert.
        $iQuery = $this->oVenueModel->addVenue($this->aParams);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Venue added!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * updateVenue
     * Update a venue from the database.
     */
    public function updateVenue()
    {
        // Declare an array with keys equivalent to that inside the database.
        $aDatabaseColumns = array(
            'venueId'       => 'id',
            'branch'        => 'venue',
            'branchAddress' => 'address',
            'branchContact' => 'contactNum'
        );

        // Loop thru the POST data sent by AJAX for renaming.
        foreach ($this->aParams as $sKey => $mValue) {
            $sNewKeys = $aDatabaseColumns[$sKey];
            $this->aParams[$sNewKeys] = $mValue;
            unset($this->aParams[$sKey]);
        }

        Utils::sanitizeData($this->aParams);

        // Perform insert.
        $iQuery = $this->oVenueModel->updateVenue($this->aParams);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Venue updated!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    public function deleteVenue()
    {
        $aId = array(
            'id' => $this->aParams['venueId']
        );

        // Perform delete.
        $iQuery = $this->oVenueModel->deleteVenue($aId);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Venue deleted!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }
}
