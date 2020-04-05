<?php

use Fpdf\Fpdf;

/**
 * PdfRegiForm
 * Class for printing PDF regi form of students.
 */
class PdfRegiForm extends Fpdf
{
    /**
     * PdfRegiForm constructor.
     */
    public function __construct($aStudentDetails, $aCourseDetails)
    {
        // Invoke FPDF's constructor.
        parent::__construct('P', 'mm', 'Letter');
        // Initialize page.
        $this->AddPage();
        // Set auto page break to false
        $this->SetAutoPageBreak(false);
        // Set PDF file title.
        $this->SetTitle('Registration Form');

        $this->insertStudentDetails($aStudentDetails);
        $this->insertCourseDetails($aCourseDetails);
        $this->setTotalAmount($aCourseDetails);
        $this->terms();
        $this->setSignature($aStudentDetails);
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

        $this->Cell(30, 2, '+63 2 8362-3755 | +63 2 8355-7759 | kdoz@live.com', 0, 0, 'C');


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
     * insertStudentDetails()
     * Initializes the contents of the quotation.
     */
    public function insertStudentDetails($aStudentDetails)
    {

        //Name of Student
        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(25, 5, 'Student Name:', 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(75, 5, $aStudentDetails['fullName'], 1, 0, 'L');

        //E-mail Address
        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(25, 5, 'E-mail Address:', 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(70, 5, $aStudentDetails['email'], 1, 0, 'L');

        $this->Ln(5);

        //Company Name
        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(25, 5, 'Company Name:', 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(75, 5, ($aStudentDetails['email'] === false) ? $aStudentDetails['email'] : 'N/A', 1, 0, 'L');

        //Phone Number
        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(25, 5, 'Phone Number', 1, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(70, 5, $aStudentDetails['contactNum'], 1, 0, 'L');

        $this->Ln(15);
    }

    /**
     * insertCourseDetails
     * Set the quotation's content.
     */
    public function insertCourseDetails($aCourseDetails)
    {
        // Set the font.
        $this->SetFont('BebasNeue-Regular');

        //Table Header
        $this->Cell(25, 5, 'COURSE CODE');
        $this->Cell(65, 5, 'COURSE DESCRIPTION');
        $this->Cell(60, 5, 'SCHEDULE');
        $this->Cell(20, 5, 'VENUE');
        $this->Cell(0, 5, 'TIME');

        $this->Ln(5);

        $this->SetFont('Arial', '', 9);

        $this->Cell(25, 5, $aCourseDetails['courseCode']);
        $this->Cell(65, 5, $aCourseDetails['courseName']);
        $this->Cell(60, 5, $aCourseDetails['schedule']);
        $this->Cell(20, 5, $aCourseDetails['venue']);
        $this->Cell(0, 5, '9:00A - 5:00P');

        $this->Ln(5);
    }

    /**
     * setTotalAmount
     * Set the training venue.
     */
    public function setTotalAmount($aCourseDetails)
    {
        $this->Ln(20);

        $this->Cell(50);
        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(50, 5, 'COURSE CODE');
        $this->Cell(30, 5, 'AMOUNT');

        $this->Ln(5);

        $this->Cell(50);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 5, $aCourseDetails['courseCode']);
        $this->Cell(30, 5, 'P' . number_format($aCourseDetails['coursePrice']));

        $this->Ln(10);

        $this->SetFont('BebasNeue-Regular', '', 12);
        $this->Cell(70);
        $this->Cell(30, 5, 'TOTAL:');
        $this->Cell(30, 5, 'P' . number_format($aCourseDetails['coursePrice']));

        $this->Ln(10);
    }

    public function terms()
    {
        $this->Ln(5);

        $this->SetFont('BebasNeue-Regular', '', 10);
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
    public function setSignature($aStudentDetails)
    {
        // Move to the right.
        $this->Cell(95);
        $this->Cell(100, 5, 'I have agreed to all the terms and conditions stated above.', 0, 1, 'R');

        // Move to the right.
        $this->Cell(140);
        $this->Cell(10, 10, '______________________________', 0, 1);

        // Move to the right.
        $this->Cell(155);
        $this->Cell(20, 1, $aStudentDetails['fullName']);
    }
}
