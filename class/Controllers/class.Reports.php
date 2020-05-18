<?php

class Reports extends BaseController
{

    /**
     * @var ReportsModel $oReportsModel
     */
    private $oReportsModel;

    /**
     * @var VenueModel $oVenueModel
     */
    private $oVenueModel;

    /**
     * @var CourseModel $oCourseModel
     */
    private $oCourseModel;

    /**
     * @var SchedulesModel $oScheduleModel
     */
    private $oScheduleModel;

    /**
     * Reports constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        $this->oReportsModel = new ReportsModel();
        $this->oVenueModel = new VenueModel();
        $this->oCourseModel = new CourseModel();
        $this->oScheduleModel = new SchedulesModel();
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
            $aSalesReport[$iKey]['paymentAmount'] = Utils::toCurrencyFormat($aData['paymentAmount']);
            $aSalesReport[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aData['paymentStatus']];
            $aSalesReport[$iKey]['coursePrice'] = Utils::toCurrencyFormat($aData['coursePrice']);

            if ($aData['coursePrice'] < $aData['paymentAmount']) {
                $aSalesReport[$iKey]['paymentStatus'] = 'Has Change';
            }
        }

        $aUnnecessaryKeys = ['fromDate', 'toDate', 'recurrence', 'numRepetitions'];
        Utils::unsetUnnecessaryData($aSalesReport, $aUnnecessaryKeys);

        return array_values($aSalesReport);
    }

    public function printSalesReport()
    {
        // $aReportData = $this->aParams['aReportData'];
        // $aFilters = array_filter($this->aParams['aFilters'] ?? []);
        $aReportData = $_GET['aReportData'];
        $aFilters = $_GET['aFilters'] ?? [];

        if (is_array($aReportData) === false || (empty($aFilters) === false && is_array($aFilters) === false)) {
            echo 'Error!';
            exit();
        }

        $aFilters = array_filter(
            array(
                'fromDate'   => $_GET['aFilters']['fromDate'] ?? '',
                'toDate'     => $_GET['aFilters']['toDate'] ?? '',
                'venueId'    => $_GET['aFilters']['venue'] ?? '',
                'courseId'   => $_GET['aFilters']['course'] ?? '',
                'scheduleId' => $_GET['aFilters']['schedule'] ?? ''
            )
        );

        $aValidation = Validations::validateSalesReportFilters($aFilters);
        if ($aValidation['bResult'] === false) {
            echo $aValidation['sMsg'];
            exit;
        }

        $aFilters = $this->getFilterData($aFilters);
        $aReportData = $this->orderSalesDataToDisplay($aReportData);

        $oPrintSalesReport = new PdfSalesReport($aReportData, $aFilters);
        $oPrintSalesReport->preparePage();
        $oPrintSalesReport->Output('I', 'Sales-Report.pdf');
    }

    private function getFilterData($aData)
    {
        $aVenueDetails = (empty($aData['venueId']) === false) ? $this->oVenueModel->getVenueDetailsById($aData['venueId']) : [];
        $aCourseDetails = (empty($aData['courseId']) === false) ? $this->oCourseModel->getCourseDetailsById($aData['courseId']) : [];
        $aScheduleDetails = (empty($aData['scheduleId']) === false) ? $this->oScheduleModel->getScheduleDetailsById($aData['scheduleId']) : [];

        $aFilters = array(
            'dateRange' => (empty($aData['fromDate']) === false && empty($aData['toDate']) === false) ? Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) : 'N/A',
            'venue'     => $aVenueDetails['venue'] ?? 'N/A',
            'course'    => $aCourseDetails['courseCode'] ?? 'N/A',
            'schedule'  => (empty($aScheduleDetails) === false) ? Utils::formatDate($aScheduleDetails['fromDate']) . ' - ' . Utils::formatDate($aScheduleDetails['toDate']) . ' (' . $this->getInterval($aScheduleDetails) . ')' : 'N/A'
        );

        return $aFilters;
    }

    private function orderSalesDataToDisplay($aData)
    {
        $aSalesReportData = array();
        foreach ($aData as $iKey => $aParams) {
            $aSalesReportData[$iKey]['studentName'] = $aParams['studentName'];
            $aSalesReportData[$iKey]['courseCode'] = $aParams['courseCode'];
            $aSalesReportData[$iKey]['schedule'] = $aParams['schedule'];
            $aSalesReportData[$iKey]['venue'] = $aParams['venue'];
            $aSalesReportData[$iKey]['coursePrice'] = $aParams['coursePrice'];
            $aSalesReportData[$iKey]['paymentAmount'] = Utils::toCurrencyFormat($aParams['paymentAmount']);
            $aSalesReportData[$iKey]['paymentDate'] = $aParams['paymentDate'];
            $aSalesReportData[$iKey]['paymentStatus'] = $aParams['paymentStatus'];
        }
        return $aSalesReportData;
    }

    public function printClassList()
    {
        $aReportData = $_GET['aReportData'];
        $aScheduleDetails = $_GET['aScheduleDetails'];

        // echo "<pre>";
        // print_r($aReportData);
        // print_r($aScheduleDetails);
        // echo "</pre>";

        if (empty($aReportData) === true || empty($aScheduleDetails) === true) {
            echo 'Error!';
            exit();
        }

        $oPrintClassList = new PdfClassList($aReportData, $aScheduleDetails);
        $oPrintClassList->preparePage();
        $oPrintClassList->Output('I', 'Class-List.pdf');
    }

    public function getStatistics()
    {
        $aData = $this->oReportsModel->getStatistics();
        echo json_encode($aData);
    }

    public function getChartData()
    {
        $aData = $this->oReportsModel->getChartData();
        echo json_encode($aData);
    }
}
