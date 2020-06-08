<?php

use Fpdf\Fpdf;

/**
 * PdfCertificate
 * Class for printing PDF certificate of students.
 */
class PdfCertificate extends Fpdf
{

    /**
     * @var array $aScheduleDetails
     */
    private $aScheduleDetails;

    /**
     * @var array $aAdminDetails
     */
    private $aAdminDetails;

    /**
     * PdfCertificate constructor.
     */
    public function __construct($aScheduleDetails, $aAdminDetails)
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

        $this->aScheduleDetails = $aScheduleDetails;
        $this->aAdminDetails = $aAdminDetails;

        $this->prepareCertificate();
    }

    private function prepareCertificate()
    {
        $this->initializePage();
        $this->setCourseName();
        $this->setVenue();
        $this->setInstructorAndAdminName();
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
        $this->Cell(259, 35, $this->aScheduleDetails['studentName'], 0, 0, 'C');

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

        $this->Cell(259, 35, $this->aScheduleDetails['courseName'], 0, 0, 'C');

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 18);

        // Line break.
        $this->Ln(11);

        if (empty($this->aScheduleDetails['courseDescription']) === false) {
            $this->Cell(259, 35, $this->aScheduleDetails['courseDescription'], 0, 0, 'C');
        }
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

        $this->Cell(259, 35, 'Given this ' . date('jS \d\a\y \of F, Y', strtotime($this->aScheduleDetails['toDate'])) . ' at', 0, 0, 'C');

        // Line break.
        $this->Ln(10);

        $this->Cell(259, 35, $this->aScheduleDetails['address'], 0, 0, 'C');
    }

    /**
     * setInstructorAndAdminName
     * Set the instructor and the admin.
     */
    public function setInstructorAndAdminName()
    {
        // Add medal stamp image.
        $this->Image('C:\xampp\htdocs\Nexus\resource\img\fpdf\medal-stamp.png', 121, 162, 40, 40);

        // Set the font.
        $this->AddFont('BebasNeue-Regular', '', 'BebasNeue-Regular.php');
        $this->SetFont('BebasNeue-Regular', '', 18);

        // Line break.
        $this->Ln(26);

        $this->SetLeftMargin(17);

        $this->Cell(90, 30, $this->aAdminDetails['instructorName'], 0, 0, 'C');
        $this->Cell(224, 30, $this->aAdminDetails['adminName'], 0, 0, 'C');

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
    }
}
