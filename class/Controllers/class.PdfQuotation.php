<?php

use Fpdf\Fpdf;

/**
 * Pdf
 * Class for printing PDF quotation of students.
 */
class PdfQuotation extends Fpdf
{

    private $aSenderDetails;
    private $aCourseDetails;

    /**
     * Pdf constructor.
     */
    public function __construct($aSenderDetails, $aCourseDetails)
    {

        $this->aSenderDetails = $aSenderDetails;
        $this->aCourseDetails = $aCourseDetails;

        // Invoke FPDF's constructor.
        parent::__construct('P', 'mm', 'Letter');
        // Initialize page.
        $this->AddPage();
        // Set PDF file title.
        $this->SetTitle('Quotation');

        $this->initializePage();
        $this->setRow();
        $this->setTotalAmount();
    }

    /**
     * Header
     * Overrides the Header() method of Fpdf to create custom page header.
     */
    public function Header()
    {
        // Set the header logo.
        $this->Image('C:\xampp\htdocs\Nexus\resource\img\fpdf\Nexus-logo.png', 10, 10, 25, 25);

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 25);

        // Move to the right.
        $this->Cell(24);

        // Set page header title.
        $this->Cell(21, 14, 'NEXUS IT TRAINING CENTER');

        // Move to the right.
        $this->Cell(130);

        // Set page header title.	
        $this->Cell(21, 14, 'INVOICE', 0, 0, 'R');

        // Set the font.
        $this->AddFont('Calibri', '', 'Calibri.php');
        $this->SetFont('Calibri', '', 12);

        // Line break.
        $this->Ln(6);

        // Move to the right.
        $this->Cell(24);

        // Set page header title.
        $this->Cell(100, 14, 'Unit 2417 Cityland 10 Tower 2, 154 H.V. ');

        //Set the font	
        $this->SetFont('BebasNeue-Regular', '', 12);

        // Move to the right.
        $this->Cell(55);

        // // Set page header title.
        // $this->Cell(15, 14, 'Invoice No. ');

        // Line break.
        $this->Ln(5);

        // Move to the right.
        $this->Cell(24);

        $this->SetFont('Calibri', '', 12);

        $this->Cell(100, 14, 'Dela Costa St., Ayala North, Makati City');

        // Move to the right.
        $this->Cell(55);

        // //Invoice Number
        // $this->Cell(10, 12, '1', 0, 0, 'R');

        // Line break.
        $this->Ln(5);

        // Set page header title.
        $this->Cell(108, 14, '+63 2 8362-3755 | kdoz@live.com', 0, 0, 'C');

        $this->SetFont('BebasNeue-Regular', '', 12);

        // Move to the right.
        $this->Cell(70);

        // Set page header title.
        $this->Cell(10, 10, 'Date Issued ', 0, 1);

        $this->SetFont('Arial', '', 12);

        // Move to the right.
        $this->Cell(188);

        //Date Issued
        $this->Cell(8, 1, date('Y-m-d'), 0, 0, 'R');

        // Line break.
        $this->Ln(5);
    }

    /**
     * initializePage()
     * Initializes the contents of the quotation.
     */
    public function initializePage()
    {
        // Set the font.
        $this->SetFont('BebasNeue-Regular', '', 15);

        $this->Cell(10, 10, 'BILL TO');

        $this->Ln(5);

        $this->SetFont('Calibri', '', 12);

        //Company Name
        $this->Cell(60, 10, '[Company Name]: ' . $this->aSenderDetails['sCompanyName']);

        $this->Ln(5);

        //Name of Student
        $this->Cell(60, 10, '[Name of Student]: ' . $this->aSenderDetails['sFullName']);

        $this->Ln(5);

        //Email Address
        $this->Cell(60, 10, '[E-mail Address]: ' . $this->aSenderDetails['sEmail']);

        $this->Ln(5);

        //Phone Number
        $this->Cell(60, 10, '[Phone Number]: ' . $this->aSenderDetails['iContactNum']);

        $this->Ln(10);

        // Set the font.
        $this->SetFont('BebasNeue-Regular', '', 12);

        //Table Header
        $this->Cell(25, 5, 'COURSE CODE', 1, 0, 'C');

        $this->Cell(80, 5, 'COURSE DESCRIPTION', 1, 0, 'C');

        $this->Cell(40, 5, 'SCHEDULE', 1, 0, 'C');

        $this->Cell(20, 5, 'VENUE', 1, 0, 'C');

        $this->Cell(8, 5, 'PAX', 1, 0, 'C');

        $this->Cell(25, 5, 'AMOUNT', 1, 0, 'C');

        $this->Ln(5);
    }

    /**
     * setRow
     * Set the quotation's content.
     */
    public function setRow()
    {
        $this->SetFont('Arial', '', 9);

        foreach ($this->aCourseDetails as $aCourse) {
            $sCourseName = $aCourse['courseName'];
            $sCourseDescription = ($aCourse['courseDescription'] !== '') ? ' - ' . $aCourse['courseDescription'] : '';

            $this->Cell(25, 5, ($aCourse['courseCode'] !== '') ? $aCourse['courseCode'] : '-', 1, 0, 'C');
            $this->Cell(80, 5, $sCourseName . $sCourseDescription, 1, 0, 'C');
            $this->Cell(40, 5, $aCourse['fromDate'] . ' - ' . $aCourse['toDate'], 1, 0, 'C');
            $this->Cell(20, 5, ($aCourse['venue'] !== '') ? $aCourse['venue'] : '-', 1, 0, 'C');
            $this->Cell(8, 5, $aCourse['numPax'], 1, 0, 'C');
            $this->Cell(25, 5, $aCourse['numPax'] * $aCourse['coursePrice'], 1, 0, 'C');
            $this->Ln(5);
        }
    }

    /**
     * setTotalAmount
     * Set the training venue.
     */
    public function setTotalAmount()
    {
        $this->SetFont('BebasNeue-Regular', '', 12);

        // Move to the right.
        $this->Cell(145);

        $this->Cell(28, 5, 'TOTAL', 1, 0, 'C');

        $iTotalAmount = 0;
        foreach ($this->aCourseDetails as $aCourse) {
            $iTotalAmount += ($aCourse['numPax'] * $aCourse['coursePrice']);
        }

        $this->Cell(25, 5, $iTotalAmount, 1, 0, 'C');

        $this->Ln(10);
    }

    public function Footer()
    {
        // Position at 1 cm from bottom
        $this->SetY(-100);
        $this->SetFont('BebasNeue-Regular', '', 12);

        // Move to the right.
        $this->Cell(7);

        $this->Cell(10, 5, 'BDO BANK DETAILS', 0, 0, 'C');

        $this->Ln(5);

        $this->SetFont('Arial', '', 9);

        $this->Cell(30, 5, 'Account Name:');

        $this->Cell(10, 5, 'Nexus I.T. Training Center', 0, 1);

        $this->Cell(30, 5, 'Account Number:');

        $this->Cell(30, 5, '002810078994', 0, 1);

        $this->SetFont('BebasNeue-Regular', '', 12);

        $this->Ln(5);

        // Move to the right.
        $this->Cell(10);

        $this->Cell(10, 5, 'TERMS AND CONDITIONS', 0, 0, 'C');

        $this->Ln(5);

        $this->SetFont('Arial', '', 9);

        $this->Cell(100, 5, '1. All cheques must be payable to NEXUS IT TRAINING CENTER.', 0, 1);

        $this->Cell(100, 5, '2. Cheque payments must be 100% good before the training starts.', 0, 1);

        $this->Cell(100, 5, '3. NO REFUND if the student decides to backout on the first day of class.', 0, 1);

        $this->Cell(100, 5, '4. For INSTALLMENTS, 50% downpayment as reservation. Balance must be paid on or before the first day of training.', 0, 1);

        $this->Cell(100, 5, '5. Please bring a copy of your BDO deposit slip on the first day of class.', 0, 1);

        $this->Cell(100, 5, '6. NEXUS ITTC reserves the rights to change schedule, venue, instuctor or cancel a class if the need arises.', 0, 1);

        $this->Cell(100, 5, '7. Minimum of five (5) students to commence a class.', 0, 1);

        $this->Ln(10);

        $this->setSignature();
    }

    /**
     * setSignature
     * Set the instructor and the admin.
     */
    public function setSignature()
    {
        // Move to the right.
        $this->Cell(95);
        $this->Cell(100, 5, 'I have agreed to all the terms and conditions stated above.', 0, 1, 'R');

        // Move to the right.
        $this->Cell(140);
        $this->Cell(10, 10, '______________________________', 0, 1);

        // Move to the right.
        $this->Cell(155);
        $this->Cell(20, 1, $this->aSenderDetails['sFullName']);

        // Output the certificate into the browser.
        // $this->Output('I', 'Quotation.pdf');
    }
}

// $aSenderDetails = array(
//     'sFullName' => 'Andrei Macandili',
//     'sEmail' => 'itsmeandrei@gmail.com',
//     'iContactNum' => '09171336096',
//     'sCompanyName' => 'N/A',
// );

// $aCourseDetails = array (
//     0 => 
//     array (
//       'courseId' => '3',
//       'courseDescription' => 'Windows 2012 R2',
//       'courseName' => 'MCP',
//       'courseCode' => '20410',
//       'coursePrice' => '8000',
//       'numPax' => 10,
//       'companyName' => '',
//       'isCompanySponsored' => 0,
//       'fromDate' => '2020-03-28',
//       'toDate' => '2020-03-29',
//       'venue' => 'Makati',
//     ),
//     1 => 
//     array (
//       'courseId' => '4',
//       'courseDescription' => '',
//       'courseName' => 'Ethical Hacking with Penetration Testing',
//       'courseCode' => '',
//       'coursePrice' => '3000',
//       'numPax' => 2,
//       'companyName' => '',
//       'isCompanySponsored' => 0,
//       'fromDate' => '2020-03-29',
//       'toDate' => '2020-03-29',
//       'venue' => 'Manila',
//     ),
// );

// $oPdf = new PdfQuotation($aSenderDetails, $aCourseDetails);
// $oPdf->initializePage();
// $oPdf->setRow();
// $oPdf->setTotalAmount();
// $oPdf->Output('I');
