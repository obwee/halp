<?php

/**
 * Quotations
 * Class for quotation-related functionalities.
 */
class Quotations
{
    /**
     * @var array $aParams
     * Holder of request parameters sent by AJAX.
     */
    private $aParams;

    /**
     * @var QuotationsModel $oModel
     * Class instance for Student model.
     */
    private $oQuotationModel;

    /**
     * Quotations constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the StudentModel class and store it inside $this->oStudentModel.
        $this->oQuotationModel = new QuotationsModel();
    }
}