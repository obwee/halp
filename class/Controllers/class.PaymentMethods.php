<?php

class PaymentMethods extends BaseController
{
    /**
     * @var PaymentMethodsModel $oPaymentMethodsModel
     * Class instance for Payment Methods model.
     */
    private $oPaymentMethodsModel;

    /**
     * Admins constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the UsersModel class and store it inside $this->oVenueModel.
        $this->oPaymentMethodsModel = new PaymentMethodsModel();
    }

    /**
     * fetchModeOfPayments
     * Fetch method of payments from the database.
     */
    public function fetchModeOfPayments()
    {
        echo json_encode($this->oPaymentMethodsModel->fetchModeOfPayments());
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
            $iQuery = $this->oPaymentMethodsModel->addPaymentMethod($this->aParams);

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
            $iQuery = $this->oPaymentMethodsModel->updatePaymentMethod($this->aParams);

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
        $iQuery = $this->oPaymentMethodsModel->enableDisablePaymentMethod($aData);

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
}
