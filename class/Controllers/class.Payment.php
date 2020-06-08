<?php

class Payment extends BaseController
{
    /**
     * @var RefundsModel $oRefundsModel
     * Class instance for Refunds model.
     */
    private $oRefundsModel;

    /**
     * @var CourseModel $oCourseModel
     * Class instance for Course model.
     */
    private $oCourseModel;

    /**
     * @var $aPaymentMethods
     * Holder of payment methods.
     */
    private $aPaymentMethods;

    /**
     * Admins constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        $this->aParams = $aPostVariables;
        $this->oRefundsModel = new RefundsModel();
        $this->oCourseModel = new CourseModel();

        parent::__construct();
        $this->aPaymentMethods = $this->oPaymentModel->fetchModeOfPayments();
    }

    /**
     * fetchModeOfPayments
     * Fetch method of payments from the database.
     */
    public function fetchModeOfPayments()
    {
        echo json_encode($this->oPaymentModel->fetchModeOfPayments());
    }

    /**
     * addPaymentMethod
     * Add a payment method to the database.
     */
    public function addPaymentMethod()
    {
        $aValidationResult = Validations::validatePaymentModeInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'paymentMode' => ':methodName'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);
            // Perform insert.
            $iQuery = $this->oPaymentModel->addPaymentMethod($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Payment method added!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * updatePaymentMethod
     * Updates the details of an admin from the database.
     */
    public function updatePaymentMethod()
    {
        $aValidationResult = Validations::validatePaymentModeInputs($this->aParams);
        if ($aValidationResult['bResult'] === true) {
            $aDatabaseColumns = array(
                'methodId'    => ':id',
                'paymentMode' => ':methodName'
            );

            Utils::renameKeys($this->aParams, $aDatabaseColumns);
            Utils::sanitizeData($this->aParams);
            // Perform update.
            $iQuery = $this->oPaymentModel->updatePaymentMethod($this->aParams);

            if ($iQuery > 0) {
                $aResult = array(
                    'bResult' => true,
                    'sMsg'    => 'Payment method updated!'
                );
            } else {
                $aResult = array(
                    'bResult' => false,
                    'sMsg'    => 'An error has occured.'
                );
            }
        } else {
            $aResult = $aValidationResult;
        }

        echo json_encode($aResult);
    }

    /**
     * enableDisablePaymentMethod
     * Mark a payment mode as active/inactive from the database.
     */
    public function enableDisablePaymentMethod()
    {
        $aData = array(
            'id' => $this->aParams['methodId'],
            'status' => ($this->aParams['methodAction'] === 'enable') ? 'Active' : 'Inactive'
        );

        // Perform enabling/disabling.
        $iQuery = $this->oPaymentModel->enableDisablePaymentMethod($aData);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Payment method ' . $this->aParams['methodAction'] . 'd!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    public function fetchPaymentDetails()
    {
        Utils::sanitizeData($this->aParams);
        $aPaymentDetails = $this->oPaymentModel->getPaymentDetails($this->aParams);

        if (empty($aPaymentDetails[0]['paymentId']) === true) {
            echo json_encode([]);
            exit();
        }

        $iTotalPayment = 0;
        foreach ($aPaymentDetails as $iKey => $aPaymentData) {
            $iTotalPayment += $aPaymentData['paymentAmount'];
        }

        foreach ($aPaymentDetails as $iKey => $aPaymentData) {
            if ($aPaymentData['paymentMethod'] === null) {
                $aResult[$iKey]['paymentMethod'] = 'N/A';
            } else {
                // Get payment method index.
                $iMopIndex = Utils::searchKeyByValueInMultiDimensionalArray($aPaymentData['paymentMethod'], $this->aPaymentMethods, 'id');
                $aResult[$iKey]['paymentMethod'] = $this->aPaymentMethods[$iMopIndex]['methodName'];
            }

            $aResult[$iKey]['trainingId']       = $aPaymentData['trainingId'];
            $aResult[$iKey]['paymentId']        = $aPaymentData['paymentId'];
            $aResult[$iKey]['rejectReason']     = $aPaymentData['rejectReason'];
            $aResult[$iKey]['paymentDate']      = Utils::formatDate($aPaymentData['paymentDate']);
            $aResult[$iKey]['coursePrice']      = Utils::toCurrencyFormat($aPaymentData['coursePrice']);
            $aResult[$iKey]['paymentAmount']    = Utils::toCurrencyFormat($aPaymentData['paymentAmount']);
            $aResult[$iKey]['remainingBalance'] = Utils::getRemainingBalance($aPaymentData);
            $aResult[$iKey]['paymentImage']     = '..' . DS . 'payments' . DS . $aPaymentData['paymentFile'];
            $aResult[$iKey]['paymentApproval']  = $this->aApprovalStatus[$aPaymentData['isApproved']];
            $aResult[$iKey]['paymentStatus']    = $this->aPaymentStatus[$aPaymentData['paymentStatus']];
            $aResult[$iKey]['totalBalance']     = Utils::toCurrencyFormat($aPaymentData['coursePrice'] - $iTotalPayment);
        }

        echo json_encode(array_values($aResult));
    }

    public function addPayment()
    {
        $aValidationResult = Validations::validateFileForPayment($this->aParams['paymentFile']);
        if ($aValidationResult['bResult'] === false) {
            echo json_encode($aValidationResult);
            exit();
        }

        $this->aParams['studentId'] = $this->aParams['studentId'] ?? $this->getUserId();

        $aPaymentFile = array_merge($this->aParams['paymentFile'], pathinfo($this->aParams['paymentFile']['name']));
        $aStudentDetails = $this->oStudentModel->getUserDetails(['userId' => $this->aParams['studentId']]);

        $sDateNow = date('Y-m-d H:i:s');
        $sFileName = str_replace(' ', '_', str_replace(':', '-', $sDateNow)) . '_' . $aStudentDetails['firstName'] . '-' . $aStudentDetails['lastName'] . '.' . $aPaymentFile['extension'];

        $aData = array(
            'trainingId'  => $this->aParams['trainingId'],
            'paymentDate' => $sDateNow,
            'paymentFile' => $sFileName,
        );

        $aSavePayment = $this->oPaymentModel->addPayment($aData);

        if ($aSavePayment === 0) {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred.'
            );
        } else {
            Utils::moveUploadedFile($aPaymentFile, $sFileName);
            $aTrainingData = $this->oTrainingModel->getTrainingDataByTrainingId($this->aParams['trainingId']);

            $aParams = array(
                'studentId'  => $this->getUserId(),
                'courseId'   => $aTrainingData['courseId'],
                'scheduleId' => $aTrainingData['scheduleId'],
                'type'       => 2,
                'receiver'   => 'admin',
                'date'       => dateNow()
            );
            $this->oNotificationModel->insertNotification($aParams);

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Payment added!'
            );
        }

        echo json_encode($aResult);
    }

    public function fetchStudentsThatHasPaid()
    {
        $aPaymentDetails = $this->oPaymentModel->fetchStudentsThatHasPaid();

        if (count($aPaymentDetails) > 0) {
            foreach ($aPaymentDetails as $iKey => $aData) {
                $aTrainingIds[$iKey] = $aData['trainingId'];
            }

            $aRefundDetails = $this->oRefundsModel->getRefundsByTrainingId($aTrainingIds);
            if (count($aRefundDetails) > 0) {
                foreach ($aRefundDetails as $iKey => $aData) {
                    $iIndex = Utils::searchKeyByValueInMultiDimensionalArray($aData['trainingId'], $aPaymentDetails, 'trainingId');
                    unset($aPaymentDetails[$iIndex]);
                }
            }
        }


        // Remove duplicate students.
        $aReturnData = array();
        foreach ($aPaymentDetails as $iKey => $aData) {
            $aReturnData[$aData['studentId']]['studentId'] = $aData['studentId'];
            $aReturnData[$aData['studentId']]['studentName'] = $aData['studentName'];
            $aReturnData[$aData['studentId']]['contactNum'] = $aData['contactNum'];
            $aReturnData[$aData['studentId']]['email'] = $aData['email'];
        }

        echo json_encode(array_values($aReturnData));
    }

    public function approvePayment()
    {
        $aValidationResult = Validations::validateApprovePaymentInputs($this->aParams);
        if ($aValidationResult['bResult'] === false) {
            echo json_encode($aValidationResult);
            exit();
        }

        Utils::renameKeys($this->aParams, ['paymentId' => 'id', 'modeOfPayment' => 'paymentMethod']);

        // Get the training ID associated with the payment ID.
        $aTrainingData = $this->oPaymentModel->fetchTrainingDataByPaymentId($this->aParams['id']);
        $aPaymentDetails = $this->oPaymentModel->fetchPaymentsByTrainingId([$aTrainingData['trainingId']])[0];

        $iOverallPayment = $this->aParams['paymentAmount'] + $aPaymentDetails['paymentAmount'];

        if ($iOverallPayment > $aTrainingData['coursePrice']) {
            echo json_encode(array(
                'bResult'  => false,
                'sElement' => '.paymentAmount',
                'sMsg'     => 'Invalid payment amount.'
            ));
        }

        if (($iOverallPayment - $aTrainingData['coursePrice']) == 0) {
            $this->aParams['isPaid'] = 2;
            $this->aParams['isApproved'] = 1;
            $iApproveQuery = $this->oPaymentModel->approvePayment($this->aParams);
            $this->oPaymentModel->updatePaymentStatuses($aTrainingData['trainingId']);
            $this->oPaymentModel->cancelRemainingPayments($aTrainingData['trainingId']);
        } else {
            $this->aParams['isPaid'] = 1;
            $this->aParams['isApproved'] = 1;
            $iApproveQuery = $this->oPaymentModel->approvePayment($this->aParams);
        }

        if ($aTrainingData['isReserved'] === 0) {
            $this->oTrainingModel->markAsReserved($aTrainingData['trainingId'], $aTrainingData['scheduleId']);
        }

        if ($iApproveQuery > 0) {
            $this->sendEmailToStudent($aTrainingData, $iOverallPayment, $this->aParams['isPaid'], 'approved');

            $aParams = array(
                'studentId'  => $aTrainingData['studentId'],
                'courseId'   => $aTrainingData['courseId'],
                'scheduleId' => $aTrainingData['scheduleId'],
                'type'       => 3,
                'receiver'   => 'student',
                'date'       => dateNow()
            );
            $this->oNotificationModel->insertNotification($aParams);

            echo json_encode(array(
                'bResult'  => true,
                'sMsg'     => 'Payment approved!'
            ));
        } else {
            echo json_encode(array(
                'bResult'  => false,
                'sMsg'     => 'An error has occurred.'
            ));
        }
    }

    public function fetchStudentsWithRejectedPayments()
    {
        $aPaymentDetails = $this->oPaymentModel->fetchStudentsWithRejectedPayments();
        echo json_encode($aPaymentDetails);
    }

    public function rejectPayment()
    {
        $aDatabaseColumns = array(
            'iPaymentId'    => 'id',
            'sRejectReason' => 'rejectReason'
        );

        Utils::renameKeys($this->aParams, $aDatabaseColumns);
        Utils::sanitizeData($this->aParams);

        // Get the training ID associated with the payment ID.
        $aTrainingData = $this->oPaymentModel->fetchTrainingDataByPaymentId($this->aParams['id']);
        $aPaymentDetails = $this->oPaymentModel->fetchPaymentsByTrainingId([$aTrainingData['trainingId']])[0];

        $iBalance = $aTrainingData['coursePrice'] - $aPaymentDetails['paymentAmount'];

        // Perform update.
        $iQuery = $this->oPaymentModel->rejectPayment($this->aParams);

        if ($iQuery > 0) {
            $this->sendEmailToStudent($aTrainingData, $iBalance, $aPaymentDetails['paymentStatus'], 'rejected');
            $aParams = array(
                'studentId'  => $aTrainingData['studentId'],
                'courseId'   => $aTrainingData['courseId'],
                'scheduleId' => $aTrainingData['scheduleId'],
                'type'       => 4,
                'receiver'   => 'student',
                'date'       => dateNow()
            );
            $this->oNotificationModel->insertNotification($aParams);

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Payment rejected!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    /**
     * clearChange
     * Clears the change of an enrollee.
     */
    public function clearChange()
    {
        $iChange = $this->oPaymentModel->getChange($this->aParams) * -1;
        $this->aParams['paymentDate'] = dateNow();
        $this->aParams['paymentMethod'] = 1;
        $this->aParams['paymentAmount'] = $iChange;
        $this->aParams['paymentFile'] = 'N/A';
        $this->aParams['remarks'] = 'Change';
        $this->aParams['isApproved'] = 3;
        $this->aParams['isPaid'] = 2;

        $this->oPaymentModel->clearChange($this->aParams);

        echo json_encode(array(
            'bResult'  => true,
            'sMsg'     => 'Change cleared!'
        ));
    }

    /**
     * clearBalance
     * Clears the balance of an enrollee.
     */
    public function clearBalance()
    {
        $aValidationResult = Validations::validateClearBalanceInputs($this->aParams);
        if ($aValidationResult['bResult'] === false) {
            echo json_encode($aValidationResult);
            exit();
        }

        $aPaymentFile = array_merge($this->aParams['paymentFile'], pathinfo($this->aParams['paymentFile']['name']));
        $aStudentDetails = $this->getUserDetails($this->aParams['studentId']);

        $sDateNow = dateNow();
        $sFileName = str_replace(' ', '_', str_replace(':', '-', $sDateNow)) . '_' . $aStudentDetails['firstName'] . '-' . $aStudentDetails['lastName'] . '.' . $aPaymentFile['extension'];

        $aData = array(
            'trainingId'    => $this->aParams['trainingId'],
            'paymentDate'   => $sDateNow,
            'paymentMethod' => $this->aParams['modeOfPayment'],
            'paymentAmount' => $this->aParams['paymentAmount'],
            'paymentFile'   => $sFileName,
            'isApproved'    => 1,
            'isPaid'        => 2
        );

        $aSavePayment = $this->oPaymentModel->clearBalance($aData);

        if ($aSavePayment === 0) {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occurred.'
            );
        } else {
            Utils::moveUploadedFile($aPaymentFile, $sFileName);

            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Balance cleared!'
            );
        }

        echo json_encode($aResult);
    }

    private function sendEmailToStudent($aTrainingData, $iTotalPayment, $iPaymentStatus, $sAction)
    {
        $aStudentDetails = $this->getUserDetails($aTrainingData['studentId']);
        $aStudentDetails['fullName'] = $aStudentDetails['firstName'] . ' ' . $aStudentDetails['lastName'];
        $aEnrollmentDetails = $this->oCourseModel->getCourseAndScheduleDetails($aTrainingData['scheduleId']);
        $aEnrollmentDetails['schedule'] = Utils::formatDate($aEnrollmentDetails['fromDate']) . ' - ' . Utils::formatDate($aEnrollmentDetails['toDate']) . ' (' . $this->getInterval($aEnrollmentDetails) . ')';

        $sMsg = 'Hello, ' . $aStudentDetails['fullName'] . '. Your payment has been ' . $sAction . ' for: ';
        $sMsg .= "\r\n\r\n";
        $sMsg .= 'Course Code: ' . $aEnrollmentDetails['courseCode'];
        $sMsg .= "\r\n";
        $sMsg .= 'Course Price: ' . Utils::toCurrencyFormat($aEnrollmentDetails['coursePrice']);
        $sMsg .= "\r\n";
        $sMsg .= 'Schedule: ' . $aEnrollmentDetails['schedule'];
        $sMsg .= "\r\n\r\n";
        $sMsg .= 'Payment Status: ' . $this->aPaymentStatus[$iPaymentStatus];
        $sMsg .= "\r\n";
        $sMsg .= 'Remaining Balance: ' . Utils::toCurrencyFormat($aEnrollmentDetails['coursePrice'] - $iTotalPayment);

        $oMail = new Email();
        $oMail->setEmailSender('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
        $oMail->addSingleRecipient('nexusinfotechtrainingcenter@gmail.com', 'Nexus Info Tech Training Center');
        // $oMail->addSingleRecipient($aStudentDetails['email'], $aStudentDetails['fullName']);
        $oMail->setTitle('Payment ' . ucfirst($sAction));
        $oMail->setBody($sMsg);
        return $oMail->send();
    }
}
