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
     * @var StudentModel $oStudentModel
     * Class instance for Student model.
     */
    private $oStudentModel;

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

    /**
     * requestQuotation
     * Method for requesting quotation.
     */
    public function requestQuotation()
    {
        $aResult = array();
        $aValidationResult = Validations::validateQuotationInputs($this->aParams);

        if ($aValidationResult['result'] === true) {
            Utils::sanitizeData($this->aParams);

            $this->oStudentModel = new StudentModel();

            $iUserId = $this->oStudentModel->checkIfUserExists($this->aParams['quoteFname'], $this->aParams['quoteLname']);
            $iQuoteSenderId = $this->oQuotationModel->checkIfSenderExists($this->aParams['quoteFname'], $this->aParams['quoteLname']);

            Utils::prepareData($this->aParams, 'quotation');

            if (empty($iUserId) === true && empty($iQuoteSenderId) === true) {
                $aSenderDetails = array(
                    ':firstName'   => $this->aParams[':firstName'],
                    ':middleName'  => $this->aParams[':middleName'],
                    ':lastName'    => $this->aParams[':lastName'],
                    ':email'       => $this->aParams[':email'],
                    ':contactNum'  => $this->aParams[':contactNum']
                );
                $iQuoteSenderId = $this->oQuotationModel->insertQuotationSender($aSenderDetails);
            }

            $this->aParams[':senderId'] = $iQuoteSenderId;
            $sDateNow = date('Y-m-d H:i:s');

            foreach ($this->aParams[':quoteCourses'] as $iKey => $mValue) {
                $aQuotationDetails = array(
                    ':userId'             => $iUserId,
                    ':senderId'           => $iQuoteSenderId,
                    ':courseId'           => $this->aParams[':quoteCourses'][$iKey],
                    ':scheduleId'         => $this->aParams[':quoteSchedules'][$iKey],
                    ':numPax'             => $this->aParams[':quoteNumPax'][$iKey],
                    ':companyName'        => $this->aParams[':companyName'],
                    ':dateRequested'      => $sDateNow,
                    ':isCompanySponsored' => $this->aParams[':quoteBillToCompany']
                );
                $this->oQuotationModel->insertQuotationDetails($aQuotationDetails);
            }

            $aResult = array(
                'result' => true,
                'msg'    => 'Quotation requested!'
            );
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    public function addNewQuotation()
    {
        print_r($this->aParams);
    }
}