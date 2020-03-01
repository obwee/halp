<?php

/**
 * Quotations
 * Class for quotation-related functionalities.
 */
class Quotations extends BaseController
{
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

    /**
     * fetchSenders
     * Fetch senders of each quotation.
     */
    public function fetchSenders()
    {
        $aSendersViaSenderId = $this->oQuotationModel->fetchSendersBySenderId();
        $aSendersViaUserId   = $this->oQuotationModel->fetchSendersByUserId();

        $aSenders = [...$aSendersViaSenderId, ...$aSendersViaUserId];

        if (empty($aSenders) === true) {
            $aResult = array(
                'bResult' => false,
                'aData'  => ''
            );
        } else {
            Utils::sortByDate($aSenders);
            $aResult = array(
                'bResult' => true,
                'aData'  => $aSenders
            );
        }

        echo json_encode($aResult);
    }

    /**
     * fetchRequests
     * Fetch quotation requests of a particular sender.
     */
    public function fetchRequests()
    {
        $aData = array(
            ':userId'         => $this->aParams['iUserId'],
            ':senderId'       => $this->aParams['iSenderId'],
            'isQuotationSent' => 0
        );

        $aDetails = $this->oQuotationModel->fetchRequests($aData);

        foreach ($aDetails as $iKey => $aDetail) {
            $aDetails[$iKey]['isCompanySponsored'] = ($aDetail['isCompanySponsored'] === true) ? 'Yes' : 'No';
            $aDetails[$iKey]['fullDate'] = date('F j, Y', strtotime($aDetail['dateRequested']));
        }

        echo json_encode($aDetails);
    }

    /**
    * fetchDetails
    * Fetch quotation details of a particular quote request.
    */
    public function fetchDetails()
    {
        $aData = array(
            ':userId'         => $this->aParams['iUserId'],
            ':senderId'       => $this->aParams['iSenderId'],
            ':dateRequested'  => $this->aParams['sDateRequested'],
            'isQuotationSent' => 0
        );

        $aDetails = $this->oQuotationModel->fetchDetails($aData);

        foreach ($aDetails as $iKey => $aDetail) {
            if (empty($aDetail['fromDate'] === false) && empty($aDetail['toDate']) === false) {
                $aDetails[$iKey]['fromDate'] = date('F j, Y', strtotime($aDetail['fromDate']));
                $aDetails[$iKey]['toDate']   = date('F j, Y', strtotime($aDetail['toDate']));
            }
        }

        echo json_encode($aDetails);
    }
}