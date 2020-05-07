<?php

use Fpdf\Fpdf;

/**
 * PdfClassList
 * Class for printing class list per schedule for reports.
 */
class PdfClassList extends Fpdf
{

    /**
     * @var array $aReportData
     */
    private $aReportData;

    /**
     * @var array $aScheduleDetails
     */
    private $aScheduleDetails;

    /**
     * PdfSalesReport constructor.
     */
    public function __construct($aReportData, $aScheduleDetails)
    {
        // Invoke FPDF's constructor.
        parent::__construct('L', 'mm', 'Letter');

        $this->aReportData = $aReportData;

        $this->aScheduleDetails = $aScheduleDetails;

        // Initialize page.
        $this->AddPage();
        // Set auto page break to false
        $this->SetAutoPageBreak(false);
        // Set PDF file title.
        $this->SetTitle('Class List');
        // Enable page aliases (Total page counter).
        $this->AliasNbPages();
    }

    /**
     * preparePage
     * Prepares the page before output.
     */
    public function preparePage()
    {
        $this->setPageTitle();
        $this->setInstructorAndSlotsLeft();
        $this->setTableHeader();
        $this->setTableContents();
        $this->setTotals();
    }

    /**
     * Header
     * Overrides the Header() method of Fpdf to create custom page header.
     */
    public function Header()
    {
        // Set the header logo.
        $this->Image('C:\xampp\htdocs\Nexus\resource\img\fpdf\Nexus-logo.png', 128, 10, 25, 25);

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 25);

        $this->Ln(24);

        // Move to the right.
        $this->Cell(93);

        // Set page header title.
        $this->Cell(73, 8, 'NEXUS IT TRAINING CENTER', 0, 1, '');

        // Set the font.
        $this->AddFont('Calibri', '', 'Calibri.php');
        $this->SetFont('Calibri', '', 8);

        // Move to the right.
        $this->Cell(75);

        // Set page header title.
        $this->Cell(110, 3, 'MAKATI: Unit 2417 Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City', 0, 1, 'C');

        // Move to the right.
        $this->Cell(75);

        // Set page header title.
        $this->Cell(110, 3, 'MANILA: Room 401 Dona Amparo Building, Espana Boulevard, Manila', 0, 1, 'C');

        // Move to the right.
        $this->Cell(85);

        $this->Cell(90, 3, '+63 2 8362-3755 | +63 2 8355-7759 | kdoz@live.com', 0, 0, 'C');
    }

    public function setPageTitle()
    {
        $this->SetFont('BebasNeue-Regular', '', 20);

        // Line break.
        $this->Ln(5);

        // Move to the right.
        $this->Cell(113);
        $this->Cell(35, 8, 'Class List for ' . $this->aScheduleDetails['courseCode'], 0, 1, 'C');

        // Move to the right.
        $this->Cell(113);
        $this->Cell(35, 8, $this->aScheduleDetails['schedule'], 0, 1, 'C');

        // Move to the right.
        $this->Cell(113);
        $this->Cell(35, 8, $this->aScheduleDetails['venue'] . ' BRANCH', 0, 1, 'C');
    }

    protected function setInstructorAndSlotsLeft()
    {
        $this->Ln(7);
        $this->Cell(50);

        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(20, 5, 'SLOTS LEFT:', 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 5, $this->aScheduleDetails['numOfStudents'], 0, 0, 'L');

        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(20, 5, 'INSTRUCTOR:', 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, $this->aScheduleDetails['instructor'], 0, 0, 'L');

        $this->Ln(8);
    }

    /**
     * setTableHeader
     */
    protected function setTableHeader()
    {
        // Set the font.
        $this->SetFont('BebasNeue-Regular', '', 12);

        // Table Header
        $this->Cell(55, 5, 'STUDENT NAME', 1, 0, 'C');
        $this->Cell(55, 5, 'EMAIL ADDRESS', 1, 0, 'C');
        $this->Cell(30, 5, 'CONTACT NUMBER', 1, 0, 'C');
        $this->Cell(25, 5, 'COURSE AMOUNT', 1, 0, 'C');
        $this->Cell(22, 5, 'DATE PAID', 1, 0, 'C');
        $this->Cell(25, 5, 'AMOUNT PAID', 1, 0, 'C');
        $this->Cell(23, 5, 'BALANCE', 1, 0, 'C');
        $this->Cell(23, 5, 'CREDITS', 1, 0, 'C');

        $this->Ln(5);
    }

    /**
     * setTableContents
     */
    protected function setTableContents()
    {
        $this->SetFont('Arial', '', 8);

        $aCellProperties = array(
            'studentName'   => array(
                'iWidth' => 55
            ),
            'email'         => array(
                'iWidth' => 55
            ),
            'contactNum'    => array(
                'iWidth' => 30
            ),
            'coursePrice'   => array(
                'iWidth' => 25
            ),
            'paymentDate'   => array(
                'iWidth' => 22
            ),
            'paymentAmount' => array(
                'iWidth' => 25
            ),
            'balance'       => array(
                'iWidth' => 23
            ),
            'credits'       => array(
                'iWidth' => 23
            )
        );

        foreach ($this->aReportData as $iKey => $aData) {
            foreach ($aData as $sKey => $sValue) {
                $this->Cell($aCellProperties[$sKey]['iWidth'], 5, $sValue, 1, 0, 'C');
            }
            $this->Ln(5);
        }
    }

    private function setTotals()
    {
        $iTotalPaymentAmount = 0;
        $iTotalBalance = 0;
        $iTotalCredits = 0;
        foreach ($this->aReportData as $iKey => $aData) {
            $iTotalPaymentAmount += preg_replace('/[P,]/', '', $aData['paymentAmount']);
            $iTotalBalance += preg_replace('/[P,]/', '', $aData['balance']);
            $iTotalCredits += preg_replace('/[P,]/', '', $aData['credits']);
        }

        $aTotals = array(
            array(
                'sTitle' => 'TOTAL AMOUNT:',
                'sValue' => Utils::toCurrencyFormat($iTotalPaymentAmount),
            ),
            array(
                'sTitle' => 'TOTAL BALANCE:',
                'sValue' => Utils::toCurrencyFormat($iTotalBalance),
            ),
            array(
                'sTitle' => 'TOTAL CREDITS:',
                'sValue' => Utils::toCurrencyFormat($iTotalCredits),
            ),
        );

        $this->Ln(15);
        foreach ($aTotals as $iKey => $aData) {
            $this->Cell(168);

            $this->SetFont('BebasNeue-Regular', '', 12);
            $this->Cell(30, 5, $aData['sTitle'], 0, 0, 'L');
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 5, $aData['sValue'], 0, 0, 'L');

            $this->Ln(5);
        }
    }

    // Page footer
    public function Footer()
    {
        $this->SetFont('Arial', 'I', 8);

        $this->SetY(-10);
        $this->Cell(0, 10, 'Created On: ' . Utils::formatDate(dateNow()), 0, 0, 'L');

        $this->SetX($this->lMargin);
        $this->Cell(0, 10, 'Prepared By: ' . Session::get('fullName'), 0, 0, 'C');

        $this->SetX($this->lMargin);
        $this->Cell(0, 10, 'Page: ' . $this->PageNo() . ' of {nb}', 0, 0, 'R');
    }
}
