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
        // Set PDF file title.
        $this->SetTitle('Training-Certificate');
        // Set auto page break to false
        $this->SetAutoPageBreak(false);
        // Add page border.
        $this->Rect(15, 13, 250, 190);
    }

    /**
     * Header
     * Overrides the Header() method of Fpdf to create custom page header.
     */
    public function Header()
    {
        // Set the header logo.
        $this->Image('C:\xampp\htdocs\Nexus\resource\img\fpdf\Nexus-logo.png', 120, 18, 40, 30);

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 26);

        // Line break.
        $this->Ln(42);

        // Move to the right.
        $this->Cell(120);

        // Set page header title.
        $this->Cell(20, 3, 'NEXUS IT TRAINING CENTER', 0, 0, 'C');

        // Set the font.
        $this->AddFont('AsiyahScript', '', 'AsiyahScript.php');
        $this->SetFont('AsiyahScript', '', 40);

        // Line break.
        $this->Ln(12);

        // Set page header title.
        $this->Cell(259, 15, 'Certificate of Attendance', 0, 0, 'C');
    }

    /**
     * initializePage()
     * Initializes the contents of the certificate.
     */
    public function initializePage()
    {
        // Set the font.
        $this->AddFont('MTCORSVA', '', 'MTCORSVA.php');
        $this->SetFont('MTCORSVA', '', 18);

        // Line break.
        $this->Ln(9);

        $this->Cell(259, 30, 'This certificate is presented to', 0, 0, 'C');

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 30);

        // Line break.
        $this->Ln(10);

        // Set page header title.
        $this->Cell(259, 35, 'Jhun P. Belza', 0, 0, 'C');

        // Line break.
        $this->Ln(1);

        $this->Cell(259, 35, '____________________________________', 0, 0, 'C');
    }

    /**
     * setCourseName
     * Set the certificate's course name.
     */
    public function setCourseName()
    {
        // Set the font.
        $this->AddFont('MTCORSVA', '', 'MTCORSVA.php');
        $this->SetFont('MTCORSVA', '', 18);

        // Line break.
        $this->Ln(12);

        $this->Cell(259, 35, 'for having attended the training entitled', 0, 0, 'C');

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 27);

        // Line break.
        $this->Ln(13);

        $this->Cell(259, 35, 'Cisco Certified Network Associate Version 4', 0, 0, 'C');

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 18);

        // Line break.
        $this->Ln(11);

        $this->Cell(259, 35, 'Implementing and Administering Cisco Solutions', 0, 0, 'C');
    }

    /**
     * setVenue
     * Set the training venue.
     */
    public function setVenue()
    {
        // Set the font.
        $this->AddFont('MTCORSVA', '', 'MTCORSVA.php');
        $this->SetFont('MTCORSVA', '', 18);

        // Line break.
        $this->Ln(11);

        $this->Cell(259, 35, 'Given this 22nd day of February, 2020 at', 0, 0, 'C');

        // Line break.
        $this->Ln(10);

        $this->Cell(259, 35, 'Unit 2417, 24th Floor Cityland 10 Tower 2, 154 H.V. Dela Costa St., Ayala North, Makati City', 0, 0, 'C');
    }

    /**
     * setInstructorAndAdminName
     * Set the instructor and the admin.
     */
    public function setInstructorAndAdminName()
    {
        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 18);

        $this->Image('C:\xampp\htdocs\Nexus\resource\img\fpdf\medal-stamp.png', 120, 162, 40, 40);

        // Line break.
        $this->Ln(26);

        $this->SetLeftMargin(17);

        $this->Cell(90, 30, 'Christoper I. Buenaventura', 0, 0, 'C');
        $this->Cell(224, 30, 'Angelika Aubrey A. Arbiol', 0, 0, 'C');

        // Line break.
        $this->Ln(1);

        $this->Cell(90, 30, '____________________________________', 0, 0, 'C');
        $this->Cell(223, 30, '____________________________________', 0, 0, 'C');

        $this->AddFont('Calibri', '', 'Calibri.php');
        $this->SetFont('Calibri', '', 12);

        // Line break.
        $this->Ln(23);
        
        // Set the font.
        $this->Cell(87, 0, 'Instructor', 0, 0, 'C');
        $this->Cell(232, 0, 'Administrator', 0, 0, 'C');

        // Output the certificate into the browser.
        $this->Output('I', 'Training-Certificate.pdf');
    }
}

$oPdf = new Pdf();
$oPdf->initializePage();
$oPdf->setCourseName();
$oPdf->setVenue();
$oPdf->setInstructorAndAdminName();
