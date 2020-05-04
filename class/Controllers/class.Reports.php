<?php

class Reports extends BaseController
{

    /**
     * @var ReportsModel $oReportsModel
     */
    private $oReportsModel;

    /**
     * Reports constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        $this->oReportsModel = new ReportsModel();
        parent::__construct();
    }

    /**
     * fetchSalesReport
     */
    public function fetchSalesReport()
    {
        $aSalesReport = $this->oReportsModel->fetchSalesReport();
        if (empty($aSalesReport) === true) {
            echo json_encode([]);
            exit();
        }

        $aResult = $this->prepareSalesReport($aSalesReport);
        echo json_encode($aResult);
    }

    public function fetchFilteredSalesReport()
    {
        $aParams = array_filter(
            array(
                'fromDate'   => $this->aParams['fromDate'] ?? '',
                'toDate'     => $this->aParams['toDate'] ?? '',
                'venueId'    => $this->aParams['venue'] ?? '',
                'courseId'   => $this->aParams['course'] ?? '',
                'scheduleId' => $this->aParams['schedule'] ?? ''
            )
        );

        if (empty($aParams) === true) {
            echo json_encode(array(
                'bResult' => false,
                'sMsg'    => 'Please indicate filters to search.',
            ));
            exit;
        }

        $aValidation = Validations::validateSalesReportFilters($aParams);
        if ($aValidation['bResult'] === false) {
            echo json_encode($aValidation);
            exit;
        }

        $aSalesReport = $this->oReportsModel->fetchFilteredSalesReport($aParams);
        if (empty($aSalesReport) === true) {
            echo json_encode(
                array(
                    'bResult'      => true,
                    'aSalesReport' => []
                )
            );
            exit();
        }

        $aResult = $this->prepareSalesReport($aSalesReport);
        echo json_encode(
            array(
                'bResult'      => true,
                'aSalesReport' => $aResult
            )
        );
    }

    private function prepareSalesReport($aSalesReport)
    {
        foreach ($aSalesReport as $iKey => $aData) {
            $aSalesReport[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aSalesReport[$iKey]['paymentDate'] = Utils::formatDate($aData['paymentDate']);
            $aData[$iKey]['paymentAmount'] = Utils::toCurrencyFormat($aData['paymentAmount']);
            $aSalesReport[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aData['paymentStatus']];
            $aSalesReport[$iKey]['coursePrice'] = Utils::toCurrencyFormat($aData['coursePrice']);
        }

        $aUnnecessaryKeys = ['fromDate', 'toDate', 'recurrence', 'numRepetitions'];
        Utils::unsetUnnecessaryData($aSalesReport, $aUnnecessaryKeys);

        return array_values($aSalesReport);
    }
}
