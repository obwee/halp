<?php

/**
 * Quotations
 * Class for quotation-related functionalities.
 */
class Quotations extends BaseController
{
    /**
     * @var QuotationsModel $oModel
     * Class instance for Student model.
     */
    private $oQuotationModel;

    /**
     * Quotations constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;
        // Instantiate the QuotationsModel class and store it inside $this->oQuotationModel.
        $this->oQuotationModel = new QuotationsModel();

        parent::__construct();
    }

    /**
     * fetchSenders
     * Fetch senders of each quotation.
     */
    public function fetchSenders()
    {
        $aIsQuotationSent = array(
            ':isQuotationSent' => $this->aParams['iIsQuotationSent']
        );

        $aSendersViaSenderId = $this->oQuotationModel->fetchSendersBySenderId($aIsQuotationSent);
        $aSendersViaUserId   = $this->oQuotationModel->fetchSendersByUserId($aIsQuotationSent);

        $aSenders = [...$aSendersViaSenderId, ...$aSendersViaUserId];

        if (empty($aSenders) === true) {
            $aResult = array(
                'bResult' => false,
                'aData'  => ''
            );
        } else {
            Utils::sortByDate($aSenders);
            $aResult = array(
                'bResult' => true,
                'aData'  => $aSenders
            );
        }

        echo json_encode($aResult);
    }

    /**
     * fetchRequests
     * Fetch quotation requests of a particular sender.
     */
    public function fetchRequests()
    {
        $aData = array(
            ':userId'          => $this->aParams['iUserId'],
            ':senderId'        => $this->aParams['iSenderId'],
            ':isQuotationSent' => $this->aParams['iIsQuotationSent']
        );

        $aDetails = $this->oQuotationModel->fetchRequests($aData);

        foreach ($aDetails as $iKey => $aDetail) {
            $aDetails[$iKey]['isCompanySponsored'] = ($aDetail['isCompanySponsored'] === 1) ? 'Yes' : 'No';
            $aDetails[$iKey]['fullDate'] = date('F j, Y', strtotime($aDetail['dateRequested']));
        }

        echo json_encode($aDetails);
    }

    /**
     * fetchDetails
     * Fetch quotation details of a particular quote request.
     */
    public function fetchDetails()
    {
        $aData = array(
            ':userId'         => $this->aParams['iUserId'],
            ':senderId'       => $this->aParams['iSenderId'],
            ':dateRequested'  => $this->aParams['sDateRequested'],
            ':isQuotationSent' => $this->aParams['iIsQuotationSent']
        );

        $aDetails = $this->oQuotationModel->fetchDetails($aData);

        foreach ($aDetails as $iKey => $aDetail) {
            if (empty($aDetail['fromDate'] === false) && empty($aDetail['toDate']) === false) {
                $aDetails[$iKey]['fromDate'] = date('F j, Y', strtotime($aDetail['fromDate']));
                $aDetails[$iKey]['toDate']   = date('F j, Y', strtotime($aDetail['toDate']));
            }
        }

        echo json_encode($aDetails);
    }

    /**
     * requestQuotation
     * Method for requesting quotation.
     */
    public function requestQuotation()
    {
        $aValidationResult = Validations::validateQuotationInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);

            $iUserId = $this->getUserIdOfQuoteRequester($this->aParams['quoteFname'], $this->aParams['quoteLname']);
            $iQuoteSenderId = $this->oQuotationModel->checkIfSenderExists($this->aParams['quoteFname'], $this->aParams['quoteLname']);

            Utils::prepareData($this->aParams, 'quotation');

            if (empty($iUserId) === true && empty($iQuoteSenderId) === true) {
                $aSenderDetails = array(
                    ':firstName'   => $this->aParams[':firstName'],
                    ':middleName'  => $this->aParams[':middleName'],
                    ':lastName'    => $this->aParams[':lastName'],
                    ':email'       => $this->aParams[':email'],
                    ':contactNum'  => $this->aParams[':contactNum']
                );
                $iQuoteSenderId = $this->oQuotationModel->insertQuotationSender($aSenderDetails);
            }

            $this->aParams[':senderId'] = $iQuoteSenderId;
            $sDateNow = date('Y-m-d H:i:s');

            foreach ($this->aParams[':quoteCourses'] as $iKey => $mValue) {
                $aQuotationDetails = array(
                    ':userId'             => $iUserId,
                    ':senderId'           => $iQuoteSenderId,
                    ':courseId'           => $this->aParams[':quoteCourses'][$iKey],
                    ':scheduleId'         => $this->aParams[':quoteSchedules'][$iKey],
                    ':numPax'             => $this->aParams[':quoteNumPax'][$iKey],
                    ':companyName'        => $this->aParams[':companyName'],
                    ':dateRequested'      => $sDateNow,
                    ':isCompanySponsored' => ($this->aParams[':quoteBillToCompany'] == 1) ? 1 : 0
                );
                $this->oQuotationModel->insertQuotationDetails($aQuotationDetails);
            }

            $aParams = array(
                'studentId'  => (empty($iUserId) === false) ? $iUserId : $iQuoteSenderId,
                'courseId'   => 0,
                'scheduleId' => 0,
                'type'       => 8,
                'hasAccount' => (empty($iUserId) === false) ? 1 : 0,
                'receiver'   => 'admin',
                'date'       => dateNow()
            );

            $this->oNotificationModel->insertNotification($aParams);

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Quotation requested!'
            );
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * addNewQuotation
     * Add a new quotation request for a specific user.
     */
    public function addNewQuotation()
    {
        $aValidationResult = Validations::validateQuotationInputs($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);

            $iUserId = $this->getUserIdOfQuoteRequester($this->aParams['quoteFname'], $this->aParams['quoteLname']);
            $iQuoteSenderId = $this->oQuotationModel->checkIfSenderExists($this->aParams['quoteFname'], $this->aParams['quoteLname']);

            Utils::prepareData($this->aParams, 'quotation');

            if (empty($iUserId) === true && empty($iQuoteSenderId) === true) {
                $aSenderDetails = array(
                    ':firstName'   => $this->aParams[':firstName'],
                    ':middleName'  => $this->aParams[':middleName'],
                    ':lastName'    => $this->aParams[':lastName'],
                    ':email'       => $this->aParams[':email'],
                    ':contactNum'  => $this->aParams[':contactNum']
                );
                $iQuoteSenderId = $this->oQuotationModel->insertQuotationSender($aSenderDetails);
            }

            $this->aParams[':senderId'] = $iQuoteSenderId;
            $sDateNow = date('Y-m-d H:i:s');

            foreach ($this->aParams[':quoteCourses'] as $iKey => $mValue) {
                $aQuotationDetails = array(
                    ':userId'             => $iUserId,
                    ':senderId'           => $iQuoteSenderId,
                    ':courseId'           => $this->aParams[':quoteCourses'][$iKey],
                    ':scheduleId'         => $this->aParams[':quoteSchedules'][$iKey],
                    ':numPax'             => $this->aParams[':quoteNumPax'][$iKey],
                    ':companyName'        => $this->aParams[':companyName'],
                    ':dateRequested'      => $sDateNow,
                    ':isCompanySponsored' => $this->aParams[':quoteBillToCompany']
                );
                $this->oQuotationModel->insertQuotationDetails($aQuotationDetails);
            }

            $aParams = array(
                'studentId'  => (empty($iUserId) === false) ? $iUserId : $iQuoteSenderId,
                'courseId'   => 0,
                'scheduleId' => 0,
                'type'       => 8,
                'hasAccount' => 1,
                'receiver'   => 'admin',
                'date'       => dateNow()
            );

            $this->oNotificationModel->insertNotification($aParams);

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Quotation requested!'
            );
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * editQuotation
     * Edit the quotation details sent by a particular user.
     */
    public function editQuotation()
    {
        $aSenderDetails = array(
            ':userId'         => $this->aParams['iUserId'],
            ':senderId'       => $this->aParams['iSenderId'],
            ':dateRequested'  => $this->aParams['sDateRequested'],
            ':isQuotationSent' => 0
        );

        $aDetails = $this->oQuotationModel->fetchDetails($aSenderDetails);

        foreach ($aDetails as $iKey => $aDetail) {
            $iFromDate = strtotime($aDetail['fromDate']);
            $iToDate = strtotime($aDetail['toDate']);
            $iInterval = (($iToDate - $iFromDate) / 86400) + 1;

            $aResult['courseId'] = $aDetail['courseId'];
            $aResult['quoteCompanyName'] = $aDetail['companyName'];
            $aResult['isCompanySponsored'] = $aDetail['isCompanySponsored'];
            $aResult['numPax'][$iKey] = $aDetail['numPax'];
            $aResult['aCourses'][$iKey] = $aDetail['courseName'];
            $aResult['aSchedules'][$iKey] = $aDetail['fromDate'] . ' - ' . $aDetail['toDate'] . ' (' . $iInterval . ' days)';
        }

        echo json_encode($aResult);
    }

    public function updateQuotation()
    {
        $aValidationResult = Validations::validateQuotationInputsForEdit($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            Utils::prepareData($this->aParams, 'updateQuotation');

            $aIds = array(
                ':userId'        => $this->aParams[':userId']   ?? 0,
                ':senderId'      => $this->aParams[':senderId'] ?? 0,
                ':dateRequested' => $this->aParams[':dateRequested']
            );

            $mParams = array_merge($aIds, $this->aParams);

            $this->oQuotationModel->deleteQuotation($aIds);

            foreach ($mParams[':quoteCourses'] as $iKey => $mValue) {
                $aQuotationDetails = array(
                    ':userId'             => $mParams[':userId'],
                    ':senderId'           => $mParams[':senderId'],
                    ':courseId'           => $mParams[':quoteCourses'][$iKey],
                    ':scheduleId'         => $mParams[':quoteSchedules'][$iKey],
                    ':numPax'             => $mParams[':quoteNumPax'][$iKey],
                    ':companyName'        => $mParams[':companyName'],
                    ':isCompanySponsored' => $mParams[':quoteBillToCompany'],
                    ':dateRequested'      => $mParams[':dateRequested']
                );
                $this->oQuotationModel->insertQuotationDetails($aQuotationDetails);
            }

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Quotation updated!'
            );
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    public function deleteQuotation()
    {
        $aIds = array(
            ':userId'        => $this->aParams['iUserId']   ?? 0,
            ':senderId'      => $this->aParams['iSenderId'] ?? 0,
            ':dateRequested' => $this->aParams['sDateRequested']
        );

        $this->oQuotationModel->deleteQuotation($aIds);

        echo json_encode(
            array(
                'bResult' => true,
                'sMsg'    => 'Quotation deleted!'
            )
        );
    }

    public function deleteSender()
    {
        $aIds = array(
            ':userId'        => $this->aParams['iUserId']   ?? 0,
            ':senderId'      => $this->aParams['iSenderId'] ?? 0
        );

        $this->oQuotationModel->deleteSenderAndQuotations($aIds);

        echo json_encode(
            array(
                'bResult' => true,
                'sMsg'    => 'Sender and quotations deleted!'
            )
        );
    }

    public function approveQuotation()
    {
        $aIds = array(
            ':userId'          => $this->aParams['iUserId']   ?? 0,
            ':senderId'        => $this->aParams['iSenderId'] ?? 0,
            ':dateRequested'   => $this->aParams['sDateRequested'],
            ':isQuotationSent' => 0,
        );

        $aCourseDetails = $this->oQuotationModel->fetchDetails($aIds);
        $aCourseIds = array();

        foreach ($aCourseDetails as $aCourse) {
            if (empty($aCourse['fromDate']) || empty($aCourse['fromDate'])) {
                $aCourseIds[] = $aCourse['courseId'];
            }
        }

        if (empty($aCourseIds) === false) {
            $aCourseDetails = $this->addAdditionalCoursesWithoutSchedule($aCourseDetails, $aCourseIds);
        }

        $aSenderDetails = array_splice($this->aParams, 3, 3);
        $aSenderDetails['sCompanyName'] = ($aCourseDetails[0]['isCompanySponsored'] == 0) ? 'N/A' : $aCourseDetails[0]['companyName'];

        $this->oQuotationModel->approveQuotation(array_splice($aIds, 0, -1));

        $this->processSendingEmail($aSenderDetails, $aCourseDetails);

        $aParams = array(
            'studentId'  => (empty($this->aParams['iUserId']) === false) ? $this->aParams['iUserId'] : $this->aParams['iSenderId'],
            'courseId'   => 0,
            'scheduleId' => 0,
            'type'       => 9,
            'hasAccount' => 1,
            'receiver'   => 'student',
            'date'       => dateNow()
        );

        $this->oNotificationModel->insertNotification($aParams);

        echo json_encode(
            array(
                'bResult' => true,
                'sMsg'    => 'Quotation approved!'
            )
        );
    }

    private function addAdditionalCoursesWithoutSchedule($aOriginalCourseDetailsSelected, $aCourseIds)
    {
        $aAdditionalCourseDetails = $this->oQuotationModel->fetchDetailsForEachCourse($aCourseIds);

        foreach ($aOriginalCourseDetailsSelected as $mKey => $aCourse) {
            foreach ($aAdditionalCourseDetails as $mAdditionalKey => $aAdditionalCourse) {
                if ($aCourse['courseId'] == $aAdditionalCourse['courseId']) {
                    $aAdditionalCourseDetails[$mAdditionalKey]['numPax'] = $aCourse['numPax'];
                    $aAdditionalCourseDetails[$mAdditionalKey]['companyName'] = $aCourse['companyName'];
                    $aAdditionalCourseDetails[$mAdditionalKey]['isCompanySponsored'] = $aCourse['isCompanySponsored'];
                    unset($aOriginalCourseDetailsSelected[$mKey]);
                }
            }
        }
        return [...$aOriginalCourseDetailsSelected, ...$aAdditionalCourseDetails];
    }

    private function processSendingEmail($aSenderDetails, $aCourseDetails)
    {
        $oPdf = new PdfQuotation($aSenderDetails, $aCourseDetails);
        $sOutput = $oPdf->Output('Quotation.pdf', 'S');

        $oMail = new Email();
        // $oMail->addSingleRecipient($aSenderDetails['sEmail'], $aSenderDetails['sFullName']);
        $oMail->addSingleRecipient('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
        $oMail->setEmailSender('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
        $oMail->setTitle('Quotation Request');
        $oMail->addFpdfAttachment($sOutput);
        // $oMail->setBody('');
        $oMail->send();
    }

    public function fetchStudentRequests()
    {
        // Re-initialize the $aParams variable.
        $this->aParams = array(
            'iUserId'          => $this->getUserId(),
            'iSenderId'        => 0,
            'iIsQuotationSent' => 0
        );

        // Invoke the existing fetchRequests method and return its result.
        $this->fetchRequests();
    }

    public function requestQuotationForStudent()
    {
        $aValidationResult = Validations::validateQuotationInputsForEdit($this->aParams);

        if ($aValidationResult['bResult'] === true) {
            Utils::sanitizeData($this->aParams);
            Utils::prepareData($this->aParams, 'updateQuotation');

            $sDateNow = date('Y-m-d H:i:s');

            foreach ($this->aParams[':quoteCourses'] as $iKey => $mValue) {
                $aQuotationDetails = array(
                    ':userId'             => $this->getUserId(),
                    ':senderId'           => 0,
                    ':courseId'           => $this->aParams[':quoteCourses'][$iKey],
                    ':scheduleId'         => $this->aParams[':quoteSchedules'][$iKey],
                    ':numPax'             => $this->aParams[':quoteNumPax'][$iKey],
                    ':companyName'        => $this->aParams[':companyName'],
                    ':dateRequested'      => $sDateNow,
                    ':isCompanySponsored' => ($this->aParams[':quoteBillToCompany'] == 1) ? 1 : 0
                );
                $this->oQuotationModel->insertQuotationDetails($aQuotationDetails);
            }

            $aParams = array(
                'studentId'  => $this->getUserId(),
                'courseId'   => 0,
                'scheduleId' => 0,
                'type'       => 8,
                'hasAccount' => 1,
                'receiver'   => 'admin',
                'date'       => dateNow()
            );

            $this->oNotificationModel->insertNotification($aParams);

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Quotation requested!'
            );
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }
}
