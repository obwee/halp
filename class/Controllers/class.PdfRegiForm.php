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
        parent::__construct('P', 'mm', 'Letter');
        // Initialize page.
        $this->AddPage();
        // Set auto page break to false
        $this->SetAutoPageBreak(false);
        // Set PDF file title.
        $this->SetTitle('Registration Form');
    }

    /**
     * Header
     * Overrides the Header() method of Fpdf to create custom page header.
     */
    public function Header()
    {
        // Set the header logo.
        $this->Image('C:\xampp\htdocs\Nexus\resource\img\fpdf\Nexus-logo.png', 97, 10, 25, 25);

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 25);

        $this->Ln(24);
        // Move to the right.
        $this->Cell(65);

        // Set page header title.
        $this->Cell(21, 10, 'NEXUS IT TRAINING CENTER', 0, 1, '');

        // Set the font.
        $this->AddFont('Calibri', '', 'Calibri.php');
        $this->SetFont('Calibri', '', 12);

        // Move to the right.
        $this->Cell(75);

        // Set page header title.
        $this->Cell(50, 2, 'MAKATI: Unit 2417 Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City', 0, 1, 'C');

        // Move to the right.
        $this->Cell(75);

        // Set page header title.
        $this->Cell(50, 6, 'MANILA: Room 401 Dona Amparo Building, Espana Boulevard, Manila', 0, 1, 'C');

        // Move to the right.
        $this->Cell(85);

        $this->Cell(30, 2,'+63 2 8362-3755 | +63 2 8355-7759 | kdoz@live.com', 0, 0, 'C');

    
        $this->SetFont('BebasNeue-Regular', '', 20);

        // Line break.
        $this->Ln(3);

        // Move to the right.
        $this->Cell(98);

        // Set page header title.
        $this->Cell(10, 10, 'Registration Form ', 0, 1, 'C');

        // Line break.
        $this->Ln(5);
    }

    /**
     * initializePage()
     * Initializes the contents of the quotation.
     */
    public function initializePage()
    {
        $this->SetFont('BebasNeue-Regular', '', 12);

        //Name of Student
        $this->Cell(25, 5, 'Student Name:', 1, 0, 'L');

        $this->SetFont('Arial', '', 10);

        $this->Cell(75, 5, '[Student Name]', 1, 0, 'L');

        $this->SetFont('BebasNeue-Regular', '', 12);

        //E-mail Address
        $this->Cell(25, 5, 'E-mail Address:', 1, 0, 'L');

        $this->SetFont('Arial', '', 10);

        $this->Cell(70, 5, '[Student E-mal]', 1, 0, 'L');

        $this->Ln(5);

        $this->SetFont('BebasNeue-Regular', '', 12);

        //Company Name
        $this->Cell(25, 5, 'Company Name:', 1, 0, 'L');

        $this->SetFont('Arial', '', 10);

        $this->Cell(75, 5, '[Company Name]', 1, 0, 'L');

        $this->SetFont('BebasNeue-Regular', '', 12);

        //Phone Number
        $this->Cell(25, 5, 'Phone Number', 1, 0, 'L');

        $this->SetFont('Arial', '', 10);

        $this->Cell(70, 5, '[Phone Number]', 1, 0, 'L');

        $this->Ln(15);    
        
        // Set the font.
        $this->SetFont('BebasNeue-Regular');

        //Table Header
        $this->Cell(25, 5, 'COURSE CODE');

        $this->Cell(90, 5, 'COURSE DESCRIPTION');

        $this->Cell(40, 5, 'SCHEDULE');

        $this->Cell(15, 5, 'VENUE');

        $this->Cell(25, 5, 'TIME');

        $this->Ln(5);
    }

    /**
     * setRow
     * Set the quotation's content.
     */
    public function setRow()
    {
        $this->SetFont('Arial', '', 9);

        $this->Cell(25, 5, '20410');

        $this->Cell(90, 5, 'Installing and Configuring Windows Server 2012');

        $this->Cell(40, 5, 'Mar 9 - Mar 11, 2020');

        $this->Cell(15, 5, 'Makati');

        $this->Cell(25, 5, '09:00A - 05:00P');

        $this->Ln(5);
        
    }

    /**
     * setTotalAmount
     * Set the training venue.
     */
    public function setTotalAmount()
    {
        $this->Ln(20);

        $this->Cell(50);

        $this->SetFont('BebasNeue-Regular', '', 12);

        $this->Cell(50, 5, 'COURSE CODE');

        $this->Cell(30, 5, 'AMOUNT');

        $this->Ln(5);

        $this->Cell(50);

        $this->SetFont('Arial', '', 10);

        $this->Cell(50, 5, '20410');

        $this->Cell(30, 5, '8,000');

        $this->Ln(10);

        $this->SetFont('BebasNeue-Regular', '', 12);

        $this->Cell(70);

        $this->Cell(30, 5, 'TOTAL:');

        $this->Cell(30, 5, '8,000', 0, 1);
    }

    public function terms()
    {

        $this->Ln(5);
        $this->SetFont('BebasNeue-Regular', '', 10);

        // Move to the right.
        $this->Cell(7);

        $this->Cell(10, 5, 'BDO BANK DETAILS', 0, 0, 'C');

        $this->Ln(5);

        $this->SetFont('Arial', '', 9);

        $this->Cell(30, 5, 'Account Name:');

        $this->Cell(10, 5, 'Nexus I.T. Training Center', 0, 1);

        $this->Cell(30, 3, 'Account Number:');

        $this->Cell(30, 3, '002810078994', 0, 1);

        $this->SetFont('BebasNeue-Regular', '', 10);

        $this->Ln(5);

        // Move to the right.
        $this->Cell(10);

        $this->Cell(10, 5, 'TERMS AND CONDITIONS', 0, 0, 'C');

        $this->Ln(5);

        $this->SetFont('Arial', '', 8);

        $this->Cell(100, 5, '1. All cheques must be payable to NEXUS IT TRAINING CENTER.', 0, 1);

        $this->Cell(100, 5, '2. Cheque payments must be 100% good before the training starts.', 0, 1);

        $this->Cell(100, 5, '3. NO REFUND if the student decides to backout on the first day of class.', 0, 1);

        $this->Cell(100, 5, '4. For INSTALLMENTS, 50% downpayment as reservation. Balance must be paid on or before the first day of training.', 0, 1);

        $this->Cell(100, 5, '5. Please bring a copy of your BDO deposit slip on the first day of class.', 0, 1);

        $this->Cell(100, 5, '6. NEXUS ITTC reserves the rights to change schedule, venue, instuctor or cancel a class if the need arises.', 0, 1);

        $this->Cell(100, 5, '7. Minimum of five (5) students to commence a class.', 0, 1);

        $this->Cell(100, 5, '8. Upload a proof of payment on your account and wait for the confirmation in your email.', 0, 1);

        $this->Ln(10);
    }

    /**
     * setSignature
     * Set the instructor and the admin.
     */
    public function setSignature()
    {

        // Move to the right.
        
        $this->Cell(250, 4, 'I have agreed to all the terms and conditions stated above. I understand that this enrollment comes on a first come first serve basis and by not being able to', 0, 1);
        $this->Cell(250, 4, ' pay for my reservation fee forfeits me of my slot.');

        $this->Ln(10);
        // Move to the right.
        $this->Cell(140);
        $this->Cell(10, 10, '______________________________', 0, 1);
        
        // Move to the right.
        $this->Cell(155);
        $this->Cell(20, 1, '[Student Name]');
 

        // Output the certificate into the browser.
        $this->Output('I', 'Registration-Form.pdf');
    }


}

$oPdf = new Pdf();
$oPdf->initializePage();
$oPdf->setRow();
$oPdf->setTotalAmount();
$oPdf->terms();
$oPdf->setSignature();
