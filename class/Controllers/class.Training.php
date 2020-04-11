<?php

class Training extends BaseController
{
    /**
     * @var TrainingModel $oTrainingModel
     * Class instance for Training model.
     */
    private $oTrainingModel;

    /**
     * @var AdminsModel $oAdminsModel
     * Class instance for Admin model.
     */
    private $oAdminsModel;

    /**
     * @var PaymentModel $oPaymentModel
     * Class instance for Payment model.
     */
    private $oPaymentModel;

    /**
     * Training constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;

        // Instantiate the TrainingModel class and store it inside $this->oVenueModel.
        $this->oTrainingModel = new TrainingModel();

        // Instantiate the AdminsModel class and store it inside $this->oAdminsModel.
        $this->oAdminsModel = new AdminsModel();

        // Instantiate the PaymentModel class and store it inside $this->oPaymentModel.
        $this->oPaymentModel = new PaymentModel();

        parent::__construct();
    }

    public function fetchTrainingDataOfSelectedStudent()
    {
        $aTrainingData = $this->oTrainingModel->fetchTrainingDataOfSelectedStudent($this->aParams['iStudentId']);

        foreach ($aTrainingData as $iKey => $aData) {
            $aTrainingData[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aInstructorIds[$iKey] = $aData['instructorId'];
            $aTrainingIds[$iKey] = $aData['trainingId'];
        }

        if (count($aTrainingIds) > 0) {
            // Get other payments, if any.
            $aTotalPaymentAmount = $this->oPaymentModel->fetchPaymentsByTrainingId($aTrainingIds);
        }

        // Change the payment amount.
        foreach ($aTotalPaymentAmount as $iKey => $aPaymentData) {
            $iTrainingKey = Utils::searchKeyByValueInMultiDimensionalArray($aPaymentData['trainingId'], $aTrainingData, 'trainingId');
            $aTrainingData[$iTrainingKey]['paymentAmount'] = $aPaymentData['paymentAmount'];
        }

        // Get instructor names.
        if (count($aInstructorIds) > 0) {
            $aInstructors = $this->oAdminsModel->fetchAdminsByInstructorIds($aInstructorIds);
        }

        // Append instructor name to the data to be returned.
        foreach ($aTrainingData as $iKey => $aData) {
            $iInstructorKey = Utils::searchKeyByValueInMultiDimensionalArray($aData['instructorId'], $aInstructors, 'instructorId');
            $aTrainingData[$iKey]['instructor']       = $aInstructors[$iInstructorKey]['instructorName'];
            $aTrainingData[$iKey]['paymentStatus']    = $this->aPaymentStatus[$aData['paymentStatus'] ?? 0];
            $aTrainingData[$iKey]['remainingBalance'] = Utils::getRemainingBalance($aData);
            $aTrainingData[$iKey]['coursePrice']      = Utils::toCurrencyFormat($aData['coursePrice']);
            $aTrainingData[$iKey]['paymentAmount']    = Utils::toCurrencyFormat($aData['paymentAmount']);
            $aTrainingData[$iKey]['paymentDate']      = Utils::formatDate($aData['paymentDate']);
        }

        $aUnnecessaryKeys = array(
            'fromDate',
            'toDate',
            'recurrence',
            'numRepetitions',
            'instructorId'
        );

        Utils::unsetUnnecessaryData($aTrainingData, $aUnnecessaryKeys);

        echo json_encode($aTrainingData);
    }

    public function fetchPaidReservations()
    {
        $aPaidReservations = $this->oTrainingModel->fetchPaidReservations($this->getUserId());

        foreach ($aPaidReservations as $iKey => $aData) {
            $aPaidReservations[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData). ')';
        }

        $aUnnecessaryKeys = ['fromDate', 'toDate', 'recurrence', 'numRepetitions'];
        Utils::unsetUnnecessaryData($aPaidReservations, $aUnnecessaryKeys);

        echo json_encode($aPaidReservations);
    }
}
