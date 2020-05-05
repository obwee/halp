<?php

use Fpdf\Fpdf;

/**
 * PdfSalesReport
 * Class for printing sales report.
 */
class PdfSalesReport extends Fpdf
{

    /**
     * @var array $aReportData
     */
    private $aReportData;

    /**
     * @var array $aFilters
     */
    private $aFilters;

    /**
     * PdfSalesReport constructor.
     */
    public function __construct($aReportData, $aFilters)
    {
        // Invoke FPDF's constructor.
        parent::__construct('L', 'mm', 'Letter');

        $this->aReportData = $aReportData;

        $this->aFilters = $aFilters;

        // Initialize page.
        $this->AddPage();
        // Set auto page break to false
        $this->SetAutoPageBreak(false);
        // Set PDF file title.
        $this->SetTitle('Sales Report');
        // Enable page aliases (Total page counter).
        $this->AliasNbPages();
    }

    /**
     * preparePage
     * Prepares the page before output.
     */
    public function preparePage()
    {
        $this->setDateAndBranch();
        $this->setTableHeader();
        $this->setTableContents();
        $this->Footer();
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


        $this->SetFont('BebasNeue-Regular', '', 20);

        // Line break.
        $this->Ln(5);

        // Move to the right.
        $this->Cell(113);

        // Set page header title.
        $this->Cell(35, 8, 'Sales Report', 0, 1, 'C');
    }

    protected function setDateAndBranch()
    {
        $aFiltersToDisplay = array(
            'dateRange' => array(
                'sTitle' => 'DATE:',
                'iWidth' => array(
                    'sTitle' => 15,
                    'sValue' => 30
                ),
                'sValue' => $this->aFilters['dateRange']
            ),
            'course'    => array(
                'sTitle' => 'COURSE:',
                'iWidth' => array(
                    'sTitle' => 15,
                    'sValue' => 30
                ),
                'sValue' => $this->aFilters['course']
            ),
            'venue'     => array(
                'sTitle' => 'BRANCH:',
                'iWidth' => array(
                    'sTitle' => 15,
                    'sValue' => 30
                ),
                'sValue' => $this->aFilters['venue']
            ),
            'schedule'  => array(
                'sTitle' => 'SCHEDULE:',
                'iWidth' => array(
                    'sTitle' => 15,
                    'sValue' => 30
                ),
                'sValue' => $this->aFilters['schedule']
            )
        );

        $this->Ln(7);

        $iCount = 0;
        foreach ($aFiltersToDisplay as $sKey => $aValue) {
            $this->Cell(40);

            $this->SetFont('BebasNeue-Regular', '', 12);
            $this->Cell($aValue['iWidth']['sTitle'], 5, $aValue['sTitle'], 0, 0, 'L');

            $this->SetFont('Arial', '', 9);
            $this->Cell($aValue['iWidth']['sTitle'], 5, $aValue['sValue'], 0, 0, 'L');

            $iCount++;

            if ($iCount !== 0 && $iCount % 2 === 0) {
                $this->Ln(5);
            } else {
                $this->Cell(40);
            }
        }
        $this->Ln(5);
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
        $this->Cell(25, 5, 'COURSE', 1, 0, 'C');
        $this->Cell(60, 5, 'SCHEDULE', 1, 0, 'C');
        $this->Cell(15, 5, 'VENUE', 1, 0, 'C');
        $this->Cell(23, 5, 'COURSE AMOUNT', 1, 0, 'C');
        $this->Cell(20, 5, 'AMOUNT PAID', 1, 0, 'C');
        $this->Cell(30, 5, 'DATE PAID', 1, 0, 'C');
        $this->Cell(30, 5, 'STATUS', 1, 0, 'C');

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
            'courseCode'    => array(
                'iWidth' => 25
            ),
            'schedule'      => array(
                'iWidth' => 60
            ),
            'venue'         => array(
                'iWidth' => 15
            ),
            'coursePrice'   => array(
                'iWidth' => 23
            ),
            'paymentAmount' => array(
                'iWidth' => 20
            ),
            'paymentDate'   => array(
                'iWidth' => 30
            ),
            'paymentStatus' => array(
                'iWidth' => 30
            ),
        );

        foreach ($this->aReportData as $iKey => $aData) {
            foreach ($aData as $sKey => $sValue) {
                $this->Cell($aCellProperties[$sKey]['iWidth'], 5, $sValue, 1, 0, 'C');
            }
            $this->Ln(5);
        }
    }

    // Page footer
    public function Footer()
    {
        $this->SetY(-10);

        $this->SetFont('Arial', 'I', 8);

        $this->Cell(0, 10, 'Created On: ' . Utils::formatDate(dateNow()), 0, 0, 'L');

        $this->SetX($this->lMargin);
        $this->Cell(0, 10, 'Prepared By: ' . Session::get('fullName'), 0, 0, 'C');

        $this->SetX($this->lMargin);

        $this->Cell(0, 10, 'Page: ' . $this->PageNo() . ' of {nb}', 0, 0, 'R');
    }
}
