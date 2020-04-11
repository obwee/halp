<?php

class Payment extends BaseController
{
    /**
     * @var PaymentModel $oPaymentModel
     * Class instance for Payment Methods model.
     */
    private $oPaymentModel;

    /**
     * Admins constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the UsersModel class and store it inside $this->oVenueModel.
        $this->oPaymentModel = new PaymentModel();

        parent::__construct();
    }

    /**
     * fetchModeOfPayments
     * Fetch method of payments from the database.
     */
    public function fetchModeOfPayments()
    {
        echo json_encode($this->oPaymentModel->fetchModeOfPayments());
    }

    /**
     * addPaymentMethod
     * Add a payment method to the database.
     */
    public function addPaymentMethod()
    {
        $aValidationResult = Validations::validatePaymentModeInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'paymentMode' => ':methodName'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);
            // Perform insert.
            $iQuery = $this->oPaymentModel->addPaymentMethod($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Payment method added!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * updatePaymentMethod
     * Updates the details of an admin from the database.
     */
    public function updatePaymentMethod()
    {
        $aValidationResult = Validations::validatePaymentModeInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'methodId'    => ':id',
                'paymentMode' => ':methodName'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);
            // Perform update.
            $iQuery = $this->oPaymentModel->updatePaymentMethod($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Payment method updated!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * enableDisablePaymentMethod
     * Mark a payment mode as active/inactive from the database.
     */
    public function enableDisablePaymentMethod()
    {
        $aData = array(
            'id' => $this->aParams['methodId'],
            'status' => ($this->aParams['methodAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Perform enabling/disabling.
        $iQuery = $this->oPaymentModel->enableDisablePaymentMethod($aData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Payment method ' . $this->aParams['methodAction'] . 'd!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    public function fetchPaymentDetails()
    {
        Utils::sanitizeData($this->aParams);
        $aPaymentDetails = $this->oPaymentModel->getPaymentDetails($this->aParams);
        $aResult = array();

        foreach ($aPaymentDetails as $iKey => $aPaymentData) {
            if (empty($aPaymentData['paymentId']) === true) {
                echo json_encode([]);
                exit();
            }

            $aResult[$iKey]['paymentId'] = $aPaymentData['paymentId'];
            $aResult[$iKey]['paymentDate'] = $aPaymentData['paymentDate'];
            $aResult[$iKey]['paymentMethod'] = $aPaymentData['paymentMethod'];
            $aResult[$iKey]['coursePrice'] = $aPaymentData['coursePrice'];
            $aResult[$iKey]['paymentAmount'] = $aPaymentData['paymentAmount'];
            $aResult[$iKey]['remainingBalance'] = $aPaymentData['coursePrice'] - $aPaymentData['paymentAmount'];
            $aResult[$iKey]['paymentImage'] = '..' . DS . 'payments' . DS . $aPaymentData['paymentFile'];
            $aResult[$iKey]['paymentStatus'] = $this->aPaymentApprovalStatus[$aPaymentData['isApproved']];
        }

        echo json_encode(array_values($aResult));
    }

    public function addPayment()
    {
        $aValidationResult = Validations::validateFileForPayment($this->aParams['paymentFile']);
        if ($aValidationResult['bResult'] === false) {
            echo json_encode($aValidationResult);
            exit();
        }

        $aPaymentFile = array_merge($this->aParams['paymentFile'], pathinfo($this->aParams['paymentFile']['name']));
        $aStudentDetails = $this->oStudentModel->getUserDetails(['userId' => $this->getUserId()]);

        $sDateNow = date('Y-m-d H:i:s');
        $sFileName = str_replace(' ', '_', str_replace(':', '-', $sDateNow)) . '_' . $aStudentDetails['firstName'] . '-' . $aStudentDetails['lastName'] . '.' . $aPaymentFile['extension'];

        $aData = array(
            'trainingId'  => $this->aParams['trainingId'],
            'paymentDate' => $sDateNow,
            'paymentFile' => $sFileName,
        );

        $aSavePayment = $this->oPaymentModel->addPayment($aData);

        if ($aSavePayment === 0) {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred.'
            );
        } else {
            Utils::moveUploadedFile($aPaymentFile, $sFileName);
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Payment added!'
            );
        }

        echo json_encode($aResult);
    }
}
