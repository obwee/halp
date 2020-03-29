<?php

class Venue extends BaseController
{
    /**
     * @var VenueModel $oModel
     * Class instance for Venue model.
     */
    private $oVenueModel;

    /**
     * @var SchedulesModel $oModel
     * Class instance for Venue model.
     */
    private $oSchedulesModel;

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
        // Instantiate the VenueModel class and store it inside $this->oVenueModel.
        $this->oSchedulesModel = new SchedulesModel();
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

    public function enableDisableVenue()
    {
        $oData = array(
            'id' => $this->aParams['venueId'],
            'status' => ($this->aParams['venueAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Check if venue still has upcoming trainings before disabling.
        if ($oData['status'] === 'Inactive') {
            $aSchedules = $this->oSchedulesModel->fetchSchedulesForSpecificVenue($oData['id']);
            if (count($aSchedules) > 0) {
                echo json_encode(array(
                    'bResult'    => false,
                    'aSchedules' => $aSchedules
                ));
                exit;
            }
        }

        // Perform enabling/disabling.
        $iQuery = $this->oVenueModel->enableDisableVenue($oData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Venue ' . $this->aParams['venueAction'] . 'd!'
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
