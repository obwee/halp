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
     * @var PaymentModel $oPaymentModel
     * Class instance for Payment model.
     */
    private $oPaymentModel;

    /**
     * @var $aPaymentMethods
     * Holder of payment methods.
     */
    private $aPaymentMethods;

    /**
     * Refunds constructor.
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
        // Instantiate the VenueModel class and store it inside $this->oVenueModel.
        $this->oPaymentModel = new PaymentModel();

        $this->aPaymentMethods = $this->oPaymentModel->fetchModeOfPayments();

        parent::__construct();
    }

    /**
     * requestRefund
     * Request a refund for a reservation.
     */
    public function requestRefund()
    {
        Utils::unsetKeys($this->aParams, ['agreementCheckbox']);
        Utils::sanitizeData($this->aParams);
        $this->aParams['dateRequested'] = dateNow();

        $iQuery = $this->oRefundsModel->requestRefund($this->aParams);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Refund requested!'
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
     * checkIfAlreadyRequestedForRefund
     */
    public function checkIfAlreadyRequestedForRefund()
    {
        Utils::sanitizeData($this->aParams);

        $iQuery = $this->oRefundsModel->checkIfAlreadyRequestedForRefund($this->aParams['iTrainingId']);

        if ($iQuery == 0) {
            $aResult = array(
                'bResult' => true
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'Refund for this reservation has been already requested.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * fetchAllRefundRequests
     */
    public function fetchAllRefundRequests()
    {
        $aRefundRequests = $this->oRefundsModel->fetchAllRefundRequests();

        foreach ($aRefundRequests as $iKey => $aDetails) {
            $aRefundRequests[$iKey]['refundStatus'] = $this->aApprovalStatus[$aDetails['refundStatus']];
        }

        echo json_encode($aRefundRequests);
    }

    /**
     * fetchRefundDetails
     */
    public function fetchRefundDetails()
    {
        Utils::sanitizeData($this->aParams);
        $aRefundDetails = $this->oRefundsModel->fetchRefundDetails($this->aParams);

        $iTotalPayment = 0;
        foreach ($aRefundDetails as $iKey => $aRefundData) {
            $iTotalPayment += $aRefundData['paymentAmount'];
        }

        foreach ($aRefundDetails as $iKey => $aRefundData) {
            if ($aRefundData['paymentMethod'] === null) {
                $aResult[$iKey]['paymentMethod'] = 'N/A';
            } else {
                // Get payment method index.
                $iMopIndex = Utils::searchKeyByValueInMultiDimensionalArray($aRefundData['paymentMethod'], $this->aPaymentMethods, 'id');
                $aResult[$iKey]['paymentMethod'] = $this->aPaymentMethods[$iMopIndex]['methodName'];
            }

            $aResult[$iKey]['trainingId']       = $aRefundData['trainingId'];
            $aResult[$iKey]['refundId']         = $aRefundData['refundId'];
            $aResult[$iKey]['refundReason']     = $aRefundData['refundReason'];
            $aResult[$iKey]['dateRequested']    = Utils::formatDate($aRefundData['dateRequested']);
            $aResult[$iKey]['coursePrice']      = Utils::toCurrencyFormat($aRefundData['coursePrice']);
            $aResult[$iKey]['paymentAmount']    = Utils::toCurrencyFormat($aRefundData['paymentAmount']);
            $aResult[$iKey]['remainingBalance'] = Utils::getRemainingBalance($aRefundData);
            $aResult[$iKey]['paymentImage']     = '..' . DS . 'payments' . DS . $aRefundData['paymentFile'];
            $aResult[$iKey]['paymentApproval']  = $this->aApprovalStatus[$aRefundData['isApproved']];
            $aResult[$iKey]['paymentStatus']    = $this->aPaymentStatus[$aRefundData['paymentStatus']];
            $aResult[$iKey]['totalBalance']     = Utils::toCurrencyFormat($aRefundData['coursePrice'] - $iTotalPayment);
            $aResult[$iKey]['approvedBy']       = $aRefundData['approvedBy'] ?? 'N/A';

            if ($aResult[$iKey]['paymentStatus'] === 'Fully Paid') {
                $aResult[$iKey]['paymentAmount'] = $aResult[$iKey]['coursePrice'];
                break;
            }
        }

        echo json_encode(array_values($aResult));
    }

    public function rejectRefund()
    {
        $aDatabaseColumns = array(
            'iRefundId' => ':id',
        );

        Utils::renameKeys($this->aParams, $aDatabaseColumns);
        Utils::sanitizeData($this->aParams);

        $this->aParams[':executor'] = Session::get('fullName');

        // Perform update.
        $iQuery = $this->oRefundsModel->rejectRefund($this->aParams);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Refund rejected!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    public function approveRefund()
    {
        Utils::sanitizeData($this->aParams);

        $aApproveRefundData = array(
            ':id'       => $this->aParams['iRefundId'],
            ':executor' => Session::get('fullName')
        );

        $aCancelReservationData = array(
            ':id'                 => $this->aParams['iTrainingId'],
            ':cancellationReason' => $this->aParams['sRefundReason']
        );

        // Perform update.
        $iApproveQuery = $this->oRefundsModel->approveRefund($aApproveRefundData);
        $iCancelQuery = $this->oTrainingModel->cancelReservation($aCancelReservationData);

        if ($iApproveQuery > 0 && $iCancelQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Refund approved!'
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
