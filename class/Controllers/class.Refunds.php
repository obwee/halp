<?php

class Refunds extends BaseController
{
    /**
     * @var RefundsModel $oRefundsModel
     * Class instance for Refunds model.
     */
    private $oRefundsModel;

    /**
     * @var TrainingModel $oTrainingModel
     * Class instance for Training model.
     */
    private $oTrainingModel;

    /**
     * Venue constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the VenueModel class and store it inside $this->oVenueModel.
        $this->oRefundsModel = new RefundsModel();
        // Instantiate the VenueModel class and store it inside $this->oVenueModel.
        $this->oTrainingModel = new TrainingModel();
    }

    /**
     * requestRefund
     * Request a refund for a reservation.
     */
    public function requestRefund()
    {
        print_r($this->aParams);
    }
}
