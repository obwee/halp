<?php

use Fpdf\Fpdf;

/**
 * Pdf
 * Class for printing PDF certificate of students.
 */
class Pdf extends Fpdf
{
    /**
     * Pdf constructor.
     */
    public function __construct()
    {
        // Invoke FPDF's constructor.
        parent::__construct('L', 'mm', 'Letter');
        // Initialize page.
        $this->AddPage();
        // Set auto page break to false
        $this->SetAutoPageBreak(false);
        // Set PDF file title.
        $this->SetTitle('Sales Report');
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

        $this->Cell(90, 3,'+63 2 8362-3755 | +63 2 8355-7759 | kdoz@live.com', 0, 0, 'C');

    
        $this->SetFont('BebasNeue-Regular', '', 20);

        // Line break.
        $this->Ln(5);

        // Move to the right.
        $this->Cell(113);

        // Set page header title.
        $this->Cell(35, 8, 'Sales Report', 0, 1, 'C');

        $this->SetFont('BebasNeue-Regular', '', 12);
        
        // Set page header title.
        $this->Cell(15, 5, 'DATE:', 0, 0, 'L');

        $this->SetFont('Arial', '', 9);

        // Set page header title.
        $this->Cell(50, 5, '[Date Range]', 0, 0, 'L');

        $this->SetFont('BebasNeue-Regular', '', 12);

        $this->Cell(90);

        // Set page header title.
        $this->Cell(20, 5, 'BRANCH:', 0, 0, 'L');

        $this->SetFont('Arial', '', 9);

        // Set page header title.
        $this->Cell(50, 5, '[Branch]', 0, 0, 'L');

        // Line break.
        $this->Ln(8);


    }

    /**
     * initializePage()
     * Initializes the contents of the quotation.
     */
    public function InitializePage()
    {
        // Set the font.
        $this->SetFont('BebasNeue-Regular', '', 12);

        //Table Header
        $this->Cell(22, 5, 'TRANSACTION ID', 1, 0, 'C');

        $this->Cell(55, 5, 'STUDENT NAME', 1, 0, 'C');

        $this->Cell(25, 5, 'COURSE', 1, 0, 'C');

        $this->Cell(25, 5, 'SCHEDULE', 1, 0, 'C');

        $this->Cell(15, 5, 'VENUE', 1, 0, 'C');

        $this->Cell(23, 5, 'COURSE AMOUNT', 1, 0, 'C');

        $this->Cell(20, 5, 'DATE PAID', 1, 0, 'C');

        $this->Cell(12, 5, 'MOP', 1, 0, 'C');

        $this->Cell(20, 5, 'AMOUNT PAID', 1, 0, 'C');

        $this->Cell(15, 5, 'STATUS', 1, 0, 'C');

        $this->Cell(20, 5, 'APPROVED BY', 1, 0, 'C');

        $this->Ln(5);
    }

    /**
     * setRow
     * Set the quotation's content.
     */
    public function setRow()
    {
        $this->SetFont('Arial', '', 8);

        //Table Content
        $this->Cell(22, 5, '1', 1, 0, 'C');

        $this->Cell(55, 5, '[Student Name]', 1, 0, 'C');

        $this->Cell(25, 5, '[Course]', 1, 0, 'C');

        $this->Cell(25, 5, '[Schedule]', 1, 0, 'C');

        $this->Cell(15, 5, '[Venue]', 1, 0, 'C');

        $this->Cell(23, 5, '[Course Amount]', 1, 0, 'C');

        $this->Cell(20, 5, '[Date Paid]', 1, 0, 'C');

        $this->Cell(12, 5, '[MOP]', 1, 0, 'C');

        $this->Cell(20, 5, '[Amount Paid]', 1, 0, 'C');

        $this->Cell(15, 5, '[Status]', 1, 0, 'C');

        $this->Cell(25, 5, '[Approved By]', 1, 0, 'C');

        $this->Ln(5);
        
    }

    // Page footer
    public function Footer()
    {
        // Position at 1 cm from bottom
        $this->SetY(-10);

        // Arial italic 8
        $this->SetFont('Arial','I',8);
        
        // Page number
        $this->Cell(0,10,'Created On: ',0,0,'L');

        $this->SetX($this->lMargin);
        $this->Cell(0,10,'Prepared By:',0,0,'C');
        
        $this->SetX($this->lMargin);
        $this->Cell(0,10,'Page: ',0,0,'R');
    
    }



    /**
     * setSignature
     * Set the instructor and the admin.
     */
    public function setSignature()
    {

         // Output the certificate into the browser.
        $this->Output('I', 'Registration-Form.pdf');

       
    }


}

$oPdf = new Pdf();
$oPdf->initializePage();
$oPdf->setRow();
$oPdf->Footer();
$oPdf->setSignature();
