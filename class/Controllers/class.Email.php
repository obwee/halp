<?php

/**
 * Email
 * Class for sending emails using Swift Mailer.
 */
class Email
{
    /**
     * @var string $sHost
     * SMTP server name.
     */
    private $sHost = 'smtp.googlemail.com';

    /**
     * @var string $sPort
     * Port number for the SMTP server.
     */
    private $sPort = 465;

    /**
     * @var string $sEncryption
     * SMTP server encryption type.
     */
    private $sEncryption = 'ssl';

    /**
     * @var string $sEmailUsername
     * Email username to access SMTP server.
     */
    private $sEmailUsername = 'nexusinfotechtrainingcenter@gmail.com';

    /**
     * @var string $sEmailPassword
     * Email password to access SMTP server.
     */
    private $sEmailPassword = 'P@$$w0rd!';

    /**
     * @var Swift_SmtpTransport $oTransport
     * Swift_SmtpTransport instance.
     */
    private $oTransport;

    /**
     * @var Swift_Mailer $oMailer
     * Swift_Mailer instance.
     */
    private $oMailer;

    /**
     * @var Swift_Message $oMessage
     * Swift_Message instance.
     */
    private $oMessage;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        // Create the SMTP Transport
        $this->oTransport = new Swift_SmtpTransport($this->sHost, $this->sPort, $this->sEncryption);

        // Set the credentials for your email account to be used in sending the email.
        $this->oTransport->setUsername($this->sEmailUsername);
        $this->oTransport->setPassword($this->sEmailPassword);

        // Create the Mailer using your created Transport
        $this->oMailer = new Swift_Mailer($this->oTransport);

        // Create a message
        $this->oMessage = new Swift_Message();

        // Set the "From address"
    }

    /**
     * setEmailSender
     * Set the sender of the email.
     * @param array $aSenderDetails
     */
    public function setEmailSender($aSenderDetails)
    {
        $this->oMessage->setFrom($aSenderDetails);
    }

    /**
     * setTitle
     * Method for setting the email title.
     * @param string $sTitle
     */
    public function setTitle($sTitle)
    {
        $this->oMessage->setSubject($sTitle);
    }

    /**
     * addSingleRecipient
     * Method for adding a single recipient for the email to be sent.
     * @param string $sRecipientEmail
     * @param string $sRecipientName
     */
    public function addSingleRecipient($sRecipientEmail, $sRecipientName)
    {
        $this->oMessage->addTo($sRecipientEmail, $sRecipientName);
    }

    /**
     * addMultipleRecipients
     * Method for adding multiple recipients for the email to be sent.
     * @param array $aRecipientDetails
     */
    public function addMultipleRecipients($aRecipientDetails)
    {
        $this->oMessage->setTo($aRecipientDetails);
    }

    /**
     * addSingleCcRecipient
     * Method for adding a single CC recipient for the email to be sent.
     * @param string $sRecipientEmail
     * @param string $sRecipientName
     */
    public function addSingleCcRecipient($sRecipientEmail, $sRecipientName)
    {
        $this->oMessage->addCc($sRecipientEmail, $sRecipientName);
    }

    /**
     * addMultipleCcRecipients
     * Add multiple recipients for the email to be sent.
     * @param array $aRecipientDetails
     */
    public function addMultipleCcRecipients($aRecipientDetails)
    {
        $this->oMessage->setCc($aRecipientDetails);
    }

    /**
     * addFpdfAttachment
     * Method for adding an attachment for the email to be sent.
     * @param string $sOutput
     * @param string $sFileName
     */
    public function addFpdfAttachment($sOutput, $sFileName = 'Quotation')
    {
        $oAttachment = new Swift_Attachment($sOutput, $sFileName . '.pdf', 'application/pdf');
        $this->oMessage->attach($oAttachment);
        // $oAttachment = Swift_Attachment::fromPath($sFilePath);
        // $oAttachment->setFilename($sFileName);
        // $this->oMessage->attach($oAttachment);
    }

    /**
     * addFileUploadAttachment
     * Method for adding an attachment for the email to be sent.
     * @param array $aFile
     */
    public function addFileUploadAttachment($aFile)
    {
        $oAttachment = Swift_Attachment::fromPath($aFile['tmp_name'])->setFilename($aFile['name']);
        $this->oMessage->attach($oAttachment);
    }

    /**
     * addImage
     * Method for adding an image for the email to be sent.
     * @param string $sImagePath
     */
    public function addImage($sImagePath)
    {
        $this->oMessage->embed(Swift_Image::fromPath($sImagePath));
    }

    /**
     * setBody
     * Method for setting the email body.
     * @param string $sTitle
     */
    public function setBody($sEmailBody)
    {
        $this->oMessage->setBody($this->convertLineBreaks($sEmailBody));
    }

    /**
     * convertLineBreaks
     * Method for converting html breaks into new line.
     */
    private function convertLineBreaks($sString)
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $sString);
    }

    /**
     * send
     * Method for sending the email.
     * @return bool|array
     */
    public function send()
    {
        try {
            $oResult = $this->oMailer->send($this->oMessage);
        } catch (Exception $oException) {
            $oResult = $oException->getMessage();
        }
        return $oResult;
    }
}

new Email();