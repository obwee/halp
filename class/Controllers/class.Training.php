<?php

class Training extends BaseController
{
    /**
     * @var TrainingModel $oTrainingModel
     * Class instance for Training model.
     */
    private $oTrainingModel;

    /**
     * @var AdminsModel $oAdminsModel
     * Class instance for Admin model.
     */
    private $oAdminsModel;

    /**
     * @var PaymentModel $oPaymentModel
     * Class instance for Payment model.
     */
    private $oPaymentModel;

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
     * @var InstructorsModel $oInstructorsModel
     * Class instance for admin model.
     */
    private $oInstructorsModel;

    /**
     * Training constructor.
     * @param array $aPostVariables
     */
    public function __construct($aPostVariables)
    {
        // Store the $_POST variables inside $this->aParams variable.
        $this->aParams = $aPostVariables;

        // Instantiate the TrainingModel class and store it inside $this->oVenueModel.
        $this->oTrainingModel = new TrainingModel();

        // Instantiate the AdminsModel class and store it inside $this->oAdminsModel.
        $this->oAdminsModel = new AdminsModel();

        // Instantiate the PaymentModel class and store it inside $this->oPaymentModel.
        $this->oPaymentModel = new PaymentModel();

        // Instantiate the RefundsModel class and store it inside $this->oRefundsModel.
        $this->oRefundsModel = new RefundsModel();

        // Instantiate the RefundsModel class and store it inside $this->oCourseModel.
        $this->oCourseModel = new CourseModel();

        // Instantiate the RefundsModel class and store it inside $this->oInstructorsModel.
        $this->oInstructorsModel = new InstructorsModel();

        parent::__construct();
    }

    public function fetchTrainingDataOfSelectedStudent()
    {
        $aTrainingData = $this->oTrainingModel->fetchTrainingDataOfSelectedStudent($this->aParams['iStudentId']);
        // print_r($aTrainingData);

        foreach ($aTrainingData as $iKey => $aData) {
            $aTrainingData[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aInstructorIds[$iKey] = $aData['instructorId'];
            $aTrainingIds[$iKey] = $aData['trainingId'];
        }

        if (count($aTrainingIds) > 0) {
            // Get other payments, if any.
            $aOtherPaymentData = $this->oPaymentModel->fetchPaymentsByTrainingId($aTrainingIds);

            $aTotalAmountAndStatus = array();
            foreach ($aOtherPaymentData as $iKey => $aPaymentData) {
                if (array_key_exists($aPaymentData['trainingId'], $aTotalAmountAndStatus) === true) {
                    $aTotalAmountAndStatus[$aPaymentData['trainingId']]['paymentAmount'] += $aPaymentData['paymentAmount'];
                    if ($aPaymentData['paymentStatus'] > $aTotalAmountAndStatus[$aPaymentData['trainingId']]['paymentStatus']) {
                        $aTotalAmountAndStatus[$aPaymentData['trainingId']]['paymentStatus'] = $aPaymentData['paymentStatus'];
                    }
                    continue;
                }
                $aTotalAmountAndStatus[$aPaymentData['trainingId']]['paymentStatus'] = $aPaymentData['paymentStatus'];
                $aTotalAmountAndStatus[$aPaymentData['trainingId']]['paymentAmount'] = $aPaymentData['paymentAmount'];
            }

            // Change the payment amount.
            foreach ($aTotalAmountAndStatus as $iKey => $aPaymentData) {
                $iTrainingIdKey = Utils::searchKeyByValueInMultiDimensionalArray($iKey, $aTrainingData, 'trainingId');
                $aTrainingData[$iTrainingIdKey]['paymentAmount'] = $aPaymentData['paymentAmount'];
                $aTrainingData[$iTrainingIdKey]['paymentStatus'] = $aPaymentData['paymentStatus'];
            }
        }

        // Get instructor names.
        if (count($aInstructorIds) > 0) {
            $aInstructors = $this->oAdminsModel->fetchAdminsByInstructorIds($aInstructorIds);

            // Append instructor name and other detaisl to the data to be returned.
            foreach ($aTrainingData as $iKey => $aData) {
                $iInstructorKey = Utils::searchKeyByValueInMultiDimensionalArray($aData['instructorId'], $aInstructors, 'instructorId');
                $aTrainingData[$iKey]['instructor']       = $aInstructors[$iInstructorKey]['instructorName'];
                $aTrainingData[$iKey]['paymentStatus']    = $this->aPaymentStatus[$aData['paymentStatus'] ?? 0];
                $aTrainingData[$iKey]['remainingBalance'] = Utils::getRemainingBalance($aData);
                $aTrainingData[$iKey]['coursePrice']      = Utils::toCurrencyFormat($aData['coursePrice']);
                $aTrainingData[$iKey]['paymentAmount']    = Utils::toCurrencyFormat($aData['paymentAmount']);
                $aTrainingData[$iKey]['paymentDate']      = Utils::formatDate($aData['paymentDate']);
            }
        }

        // Unset if refund approved.
        $aRefundDetails = $this->oRefundsModel->getRefundsByTrainingId($aTrainingIds);

        if (count($aTrainingIds) > 0) {
            $aRefundDetails = $this->oRefundsModel->getRefundsByTrainingId($aTrainingIds);

            if (count($aRefundDetails) > 0) {
                foreach ($aRefundDetails as $iKey => $aData) {
                    $iIndex = Utils::searchKeyByValueInMultiDimensionalArray($aData['trainingId'], $aTrainingData, 'trainingId');
                    unset($aTrainingData[$iIndex]);
                }
            }
        }

        $aUnnecessaryKeys = array(
            'fromDate',
            'toDate',
            'recurrence',
            'numRepetitions',
            'instructorId'
        );

        Utils::unsetUnnecessaryData($aTrainingData, $aUnnecessaryKeys);

        echo json_encode($aTrainingData);
    }

    public function fetchPaidReservations()
    {
        $aPaidReservations = $this->oTrainingModel->fetchPaidReservations($this->getUserId());

        foreach ($aPaidReservations as $iKey => $aData) {
            $aPaidReservations[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
        }

        $aUnnecessaryKeys = ['fromDate', 'toDate', 'recurrence', 'numRepetitions'];
        Utils::unsetUnnecessaryData($aPaidReservations, $aUnnecessaryKeys);

        echo json_encode($aPaidReservations);
    }

    public function fetchTrainingDataOfSelectedStudentWithRejectedPayment()
    {
        $aTrainingData = $this->oTrainingModel->fetchTrainingDataOfSelectedStudentWithRejectedPayment($this->aParams['iStudentId']);

        foreach ($aTrainingData as $iKey => $aData) {
            $aTrainingData[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aInstructorIds[$iKey] = $aData['instructorId'];
            $aTrainingIds[$iKey] = $aData['trainingId'];
        }

        if (count($aTrainingIds) > 0) {
            // Get other payments, if any.
            $aTotalPaymentAmount = $this->oPaymentModel->fetchPaymentsByTrainingId($aTrainingIds);
        }

        // Change the payment amount.
        foreach ($aTotalPaymentAmount as $iKey => $aPaymentData) {
            $iTrainingKey = Utils::searchKeyByValueInMultiDimensionalArray($aPaymentData['trainingId'], $aTrainingData, 'trainingId');
            $aTrainingData[$iTrainingKey]['paymentAmount'] = $aPaymentData['paymentAmount'];
        }

        // Get instructor names.
        if (count($aInstructorIds) > 0) {
            $aInstructors = $this->oAdminsModel->fetchAdminsByInstructorIds($aInstructorIds);
        }

        // Append instructor name to the data to be returned.
        foreach ($aTrainingData as $iKey => $aData) {
            $iInstructorKey = Utils::searchKeyByValueInMultiDimensionalArray($aData['instructorId'], $aInstructors, 'instructorId');
            $aTrainingData[$iKey]['instructor']       = $aInstructors[$iInstructorKey]['instructorName'];
            $aTrainingData[$iKey]['paymentStatus']    = $this->aPaymentStatus[$aData['paymentStatus'] ?? 0];
            $aTrainingData[$iKey]['remainingBalance'] = Utils::getRemainingBalance($aData);
            $aTrainingData[$iKey]['coursePrice']      = Utils::toCurrencyFormat($aData['coursePrice']);
            $aTrainingData[$iKey]['paymentAmount']    = Utils::toCurrencyFormat($aData['paymentAmount']);
            $aTrainingData[$iKey]['paymentDate']      = Utils::formatDate($aData['paymentDate']);
        }

        $aUnnecessaryKeys = array(
            'fromDate',
            'toDate',
            'recurrence',
            'numRepetitions',
            'instructorId'
        );

        Utils::unsetUnnecessaryData($aTrainingData, $aUnnecessaryKeys);

        echo json_encode($aTrainingData);
    }

    public function fetchRejectedPayments()
    {
        $aPaidReservations = $this->oTrainingModel->fetchRejectedReservations($this->getUserId());

        foreach ($aPaidReservations as $iKey => $aData) {
            $aPaidReservations[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
        }

        $aUnnecessaryKeys = ['fromDate', 'toDate', 'recurrence', 'numRepetitions'];
        Utils::unsetUnnecessaryData($aPaidReservations, $aUnnecessaryKeys);

        echo json_encode($aPaidReservations);
    }

    public function cancelReservation()
    {
        $aDatabaseColumns = array(
            'iTrainingId'         => ':id',
            'sCancellationReason' => ':cancellationReason'
        );

        Utils::renameKeys($this->aParams, $aDatabaseColumns);
        Utils::sanitizeData($this->aParams);

        // Perform update.
        $iQuery = $this->oTrainingModel->cancelReservation($this->aParams);

        if ($iQuery > 0) {
            $aResult = array(
                'bResult' => true,
                'sMsg'    => 'Reservation cancelled!'
            );
        } else {
            $aResult = array(
                'bResult' => false,
                'sMsg'    => 'An error has occured.'
            );
        }

        echo json_encode($aResult);
    }

    public function fetchCancelledReservations()
    {
        $aCancelledReservations = $this->oTrainingModel->fetchCancelledReservations($this->getUserId());

        foreach ($aCancelledReservations as $iKey => $aData) {
            $aCancelledReservations[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aCancelledReservations[$iKey]['coursePrice'] = Utils::toCurrencyFormat($aData['coursePrice']);
        }

        $aUnnecessaryKeys = ['fromDate', 'toDate', 'recurrence', 'numRepetitions'];
        Utils::unsetUnnecessaryData($aCancelledReservations, $aUnnecessaryKeys);

        echo json_encode($aCancelledReservations);
    }

    public function fetchTrainingDataOfSelectedStudentWithRefunds()
    {
        $aTrainingData = $this->oTrainingModel->fetchTrainingDataOfSelectedStudentWithRefunds($this->aParams['iStudentId']);

        foreach ($aTrainingData as $iKey => $aData) {
            $aTrainingData[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aInstructorIds[$iKey] = $aData['instructorId'];
            $aTrainingIds[$iKey] = $aData['trainingId'];
        }

        // Get instructor names.
        if (count($aInstructorIds) > 0) {
            $aInstructors = $this->oAdminsModel->fetchAdminsByInstructorIds($aInstructorIds);
        }

        // Append instructor name and other details to the data to be returned.
        foreach ($aTrainingData as $iKey => $aData) {
            $iInstructorKey = Utils::searchKeyByValueInMultiDimensionalArray($aData['instructorId'], $aInstructors, 'instructorId');
            $aTrainingData[$iKey]['instructor']   = $aInstructors[$iInstructorKey]['instructorName'];
            $aTrainingData[$iKey]['refundStatus'] = $this->aApprovalStatus[$aData['refundStatus']];
            $aTrainingData[$iKey]['coursePrice']  = Utils::toCurrencyFormat($aData['coursePrice']);
        }

        $aUnnecessaryKeys = array(
            'fromDate',
            'toDate',
            'recurrence',
            'numRepetitions',
            'instructorId'
        );

        Utils::unsetUnnecessaryData($aTrainingData, $aUnnecessaryKeys);

        echo json_encode($aTrainingData);
    }

    public function fetchTrainingRequests()
    {
        // Get enrolled trainings.
        $aEnrolledTrainings = $this->oTrainingModel->fetchTrainingRequests($this->getUserId());
        $aCoursesAvailable = $this->oCourseModel->fetchAvailableCoursesAndSchedules();
        
        if (count($aEnrolledTrainings) === 0) {
            echo json_encode(array(
                'aTrainingRequests'   => [],
                'aTrainingsAvailable' => array_values($this->prepareTrainingsAvailable($aCoursesAvailable)),
                'aInstructors'        => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
            ));
            exit;
        }

        // Get training IDs for fetching payment and refund data.
        foreach ($aEnrolledTrainings as $iKey => $aTraining) {

            // Unset rejected payments.
            if ($aTraining['paymentApproval'] === '2') {
                unset($aEnrolledTrainings[$iKey]);
                continue;
            }

            $aTrainingIds[] = $aTraining['trainingId'];
            $aCourseIds[] = $aTraining['courseId'];

            $aPaymentStatus[$aTraining['trainingId']][] = $aTraining['paymentStatus'];
            $aPaymentApproval[$aTraining['trainingId']][] = $aTraining['paymentApproval'];
            $aEnrollmentData[$aTraining['trainingId']] = $aTraining;

            $aTotalPaymentAmount[$aTraining['trainingId']][] = $aTraining['paymentAmount'];
        }

        // Get the highest payment status value and total amount paid, together if there are pending payments.
        foreach ($aPaymentStatus as $iKey => $aStatus) {
            $aEnrollmentData[$iKey]['paymentStatus'] = max($aStatus);
            $aEnrollmentData[$iKey]['paymentAmount'] = array_sum($aTotalPaymentAmount[$iKey]);

            $bHasPendingPayments = array_filter($aStatus, fn ($iStatus) => in_array($iStatus, [0, '0']) === true);
            $aEnrollmentData[$iKey]['hasPendingPayments'] = (count($bHasPendingPayments) > 0 && empty($aEnrollmentData[$iKey]['paymentId']) === false) ? true : false;
        }

        // Unset already enrolled courses.
        foreach ($aCourseIds as $iKey => $iCourseId) {
            foreach ($aCoursesAvailable as $mKey => $aCourse) {
                if ($iCourseId === $aCourse['courseId']) {
                    unset($aCoursesAvailable[$mKey]);
                }
            }
        }

        $aTrainingsAvailable = [];
        if (count($aCoursesAvailable) > 0) {
            $aTrainingsAvailable = $this->prepareTrainingsAvailable($aCoursesAvailable);
        }

        $aRefundDetails = $this->oRefundsModel->getRefundsByTrainingId($aTrainingIds);

        foreach ($aEnrollmentData as $iKey => $aTraining) {
            $iRefundIndex = Utils::searchKeyByValueInMultiDimensionalArray($aTraining['trainingId'], $aRefundDetails, 'trainingId');

            $aEnrollmentData[$iKey]['schedule'] = Utils::formatDate($aTraining['fromDate']) . ' - ' .  Utils::formatDate($aTraining['toDate']) . ' (' . $this->getInterval($aTraining) . ')';
            $aEnrollmentData[$iKey]['coursePrice'] = Utils::toCurrencyFormat($aTraining['coursePrice']);
            $aEnrollmentData[$iKey]['paymentBalance'] = Utils::toCurrencyFormat($aTraining['coursePrice'] - $aTraining['paymentAmount']);
            $aEnrollmentData[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aTraining['paymentStatus'] ?? 0];

            if ($aEnrollmentData[$iKey]['hasPendingPayments'] === true) {
                $aEnrollmentData[$iKey]['paymentStatus'] = 'Payment Submitted';
            }
            if ($aEnrollmentData[$iKey]['coursePrice'] < array_sum($aTotalPaymentAmount[$iKey])) {
                $aEnrollmentData[$iKey]['paymentStatus'] = 'Has Credits';
            }

            if (empty($iRefundIndex) === false && $aRefundDetails[$iRefundIndex] !== 0) {
                unset($aEnrollmentData[$iKey]);
                continue;
            }
        }

        $aUnnecessaryKeys = [
            'recurrence', 'numRepetitions', 'fromDate', 'toDate', 'paymentMethod',
            'paymentDate', 'paymentFile', 'paymentApproval', 'paymentAmount'
        ];
        Utils::unsetUnnecessaryData($aEnrollmentData, $aUnnecessaryKeys);

        echo json_encode(array(
            'aTrainingRequests'   => array_values($aEnrollmentData),
            'aTrainingsAvailable' => array_values($aTrainingsAvailable),
            'aInstructors'        => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
        ));
    }

    private function prepareTrainingsAvailable($aTrainingDetails)
    {
        // Get schedules, venues, instructors, and slots for each courses available and remove duplicates.
        foreach ($aTrainingDetails as $aData) {
            $aSchedules[$aData['courseId']][$aData['scheduleId']]   = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aCoursePrice[$aData['courseId']][$aData['scheduleId']] = $aData['coursePrice'];
            $aVenues[$aData['courseId']][$aData['scheduleId']]      = $aData['venue'];
            $aInstructors[$aData['courseId']][$aData['scheduleId']] = $aData['instructorId'];
            $aSlots[$aData['courseId']][$aData['scheduleId']]       = $aData['remainingSlots'];

            $aAvailableTrainings[$aData['courseId']]                = $aData;
        }

        // Add the schedules, venues, instructors, and slots to its respective course.
        foreach ($aAvailableTrainings as $aData) {
            $aAvailableTrainings[$aData['courseId']]['schedules']   = $aSchedules[$aData['courseId']];
            $aAvailableTrainings[$aData['courseId']]['prices']      = $aCoursePrice[$aData['courseId']];
            $aAvailableTrainings[$aData['courseId']]['venues']      = $aVenues[$aData['courseId']];
            $aAvailableTrainings[$aData['courseId']]['instructors'] = $aInstructors[$aData['courseId']];
            $aAvailableTrainings[$aData['courseId']]['slots']       = $aSlots[$aData['courseId']];
        }

        // Remove unnecessary keys from the multidimensional array.
        $aUnnecessaryKeys = array(
            'courseDescription', 'coursePrice', 'fromDate',
            'toDate', 'venue', 'remainingSlots', 'instructorId',
            'recurrence', 'numRepetitions', 'instructorName'
        );
        Utils::unsetUnnecessaryData($aAvailableTrainings, $aUnnecessaryKeys);

        // Return the trainings available.
        return $aAvailableTrainings;
    }

    public function fetchEnrollmentData()
    {
        $aEnrollees = $this->oStudentModel->fetchEnrollees();
        $aInstructorIds = array();

        if (count($aEnrollees) === 0) {
            echo json_encode([]);
            exit;
        }

        $aEnrollmentData = [];
        $iTotalPaymentAmount = 0;

        // Get instructor IDs, training IDs and payment statuses. Also, remove duplicates.
        foreach ($aEnrollees as $iKey => $aData) {

            // Unset rejected payments.
            if ($aData['paymentApproval'] === '2') {
                unset($aEnrollees[$iKey]);
                continue;
            }

            $iTotalPaymentAmount += $aData['paymentAmount'];
            $aTrainingIds[$iKey] = $aData['trainingId'];
            $aInstructorIds[$iKey] = $aData['instructorId'];
            $aPaymentStatus[$aData['trainingId']][] = $aData['paymentStatus'];
            $aPaymentApproval[$aData['trainingId']][] = $aData['paymentApproval'];

            $aEnrollmentData[$aData['trainingId']] = $aData;
        }

        // Get the highest payment status value, together if there are pending payments.
        foreach ($aPaymentStatus as $iKey => $aStatus) {
            $aEnrollmentData[$iKey]['paymentStatus'] = max($aStatus);

            $bHasPendingPayments = array_filter($aStatus, fn ($iStatus) => in_array($iStatus, [0, '0']) === true);
            $aEnrollmentData[$iKey]['hasPendingPayments'] = (count($bHasPendingPayments) > 0 && empty($aEnrollmentData[$iKey]['paymentId']) === false) ? true : false;
        }

        // Get instructor names.
        if (count($aInstructorIds) > 0) {
            $aInstructors = $this->oAdminsModel->fetchAdminsByInstructorIds(array_values($aInstructorIds));
        }

        // Append instructor name to the data to be returned.
        foreach ($aEnrollmentData as $iKey => $aData) {
            $iInstructorKey = Utils::searchKeyByValueInMultiDimensionalArray($aData['instructorId'], $aInstructors, 'instructorId');

            $aEnrollmentData[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aEnrollmentData[$iKey]['instructor'] = $aInstructors[$iInstructorKey]['instructorName'];
            $aEnrollmentData[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aData['paymentStatus'] ?? 0];
            if ($aEnrollmentData[$iKey]['hasPendingPayments'] === true) {
                $aEnrollmentData[$iKey]['paymentStatus'] = 'Payment Submitted';
            }
            if ($aEnrollmentData[$iKey]['coursePrice'] < $iTotalPaymentAmount) {
                $aEnrollmentData[$iKey]['paymentStatus'] = 'Has Credits';
            }
        }

        $aUnnecessaryData = ['paymentId', 'paymentMethod', 'paymentDate', 'paymentAmount', 'paymentFile'];
        Utils::unsetUnnecessaryData($aEnrollmentData, $aUnnecessaryData);
        echo json_encode(array_values($aEnrollmentData));
    }

    public function fetchStudentEnrollmentData()
    {
        // Get enrolled trainings.
        $aEnrolledTrainings = $this->oTrainingModel->fetchTrainingRequests($this->aParams['iStudentId']);
        $aCoursesAvailable = $this->oCourseModel->fetchAvailableCoursesAndSchedules();

        if (count($aEnrolledTrainings) === 0) {
            echo json_encode(array(
                'aTrainingsAvailable' => array_values($this->prepareTrainingsAvailable($aCoursesAvailable)),
                'aInstructors'        => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
            ));
            exit;
        }

        foreach ($aEnrolledTrainings as $iKey => $aEnrolledTraining) {
            // Unset rejected payments.
            if ($aEnrolledTraining['paymentApproval'] === '2') {
                unset($aEnrolledTrainings[$iKey]);
                continue;
            }
            // Unset already enrolled courses.
            foreach ($aCoursesAvailable as $mKey => $aCourseAvailable) {
                if ($aEnrolledTraining['courseId'] === $aCourseAvailable['courseId']) {
                    unset($aCoursesAvailable[$mKey]);
                }
            }
        }

        $aTrainingsAvailable = [];
        if (count($aCoursesAvailable) > 0) {
            $aTrainingsAvailable = $this->prepareTrainingsAvailable($aCoursesAvailable);
        }

        echo json_encode(array(
            'aTrainingsAvailable' => array_values($aTrainingsAvailable),
            'aInstructors'        => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
        ));
    }

    public function fetchFilteredEnrollmentData()
    {
        if (empty($this->aParams) === true) {
            echo json_encode(array(
                'bResult'         => false,
                'sMsg' => 'Please indicate filters to search.',
            ));
            exit;
        }

        $aNewKeys = array(
            'venue'            => 'venueId',
            'courseDropdown'   => 'courseId',
            'scheduleDropdown' => 'scheduleId'
        );
        Utils::renameKeys($this->aParams, $aNewKeys);
        Utils::sanitizeData($this->aParams);

        $aValidateParams = Validations::validateIdParams($this->aParams);
        if ($aValidateParams['bResult'] === false) {
            echo json_encode($aValidateParams);
            exit;
        }

        $aEnrollees = $this->oStudentModel->fetchFilteredEnrollees($this->aParams);
        $aInstructorIds = array();

        if (count($aEnrollees) === 0) {
            echo json_encode(array(
                'bResult'         => true,
                'aEnrollmentData' => [],
            ));
            exit;
        }

        $aEnrollmentData = [];

        // Get instructor IDs, training IDs and payment statuses. Also, remove duplicates.
        foreach ($aEnrollees as $iKey => $aData) {

            // Unset rejected payments.
            if ($aData['paymentApproval'] === '2') {
                unset($aEnrollees[$iKey]);
                continue;
            }

            $aTrainingIds[$iKey] = $aData['trainingId'];
            $aInstructorIds[$iKey] = $aData['instructorId'];
            $aPaymentStatus[$aData['trainingId']][] = $aData['paymentStatus'];
            $aPaymentApproval[$aData['trainingId']][] = $aData['paymentApproval'];

            $aEnrollmentData[$aData['trainingId']] = $aData;
        }

        // Get the highest payment status value, together if there are pending payments.
        foreach ($aPaymentStatus as $iKey => $aStatus) {
            $aEnrollmentData[$iKey]['paymentStatus'] = max($aStatus);

            $bHasPendingPayments = array_filter($aStatus, fn ($iStatus) => in_array($iStatus, [0, '0']) === true);
            $aEnrollmentData[$iKey]['hasPendingPayments'] = (count($bHasPendingPayments) > 0 && empty($aEnrollmentData[$iKey]['paymentId']) === false) ? true : false;
        }

        // Get instructor names.
        if (count($aInstructorIds) > 0) {
            $aInstructors = $this->oAdminsModel->fetchAdminsByInstructorIds(array_values($aInstructorIds));
        }

        // Append instructor name to the data to be returned.
        foreach ($aEnrollmentData as $iKey => $aData) {
            // print_r($aData['trainingId'] . '-' . $aData['paymentStatus']);
            $iInstructorKey = Utils::searchKeyByValueInMultiDimensionalArray($aData['instructorId'], $aInstructors, 'instructorId');

            $aEnrollmentData[$iKey]['schedule'] = Utils::formatDate($aData['fromDate']) . ' - ' . Utils::formatDate($aData['toDate']) . ' (' . $this->getInterval($aData) . ')';
            $aEnrollmentData[$iKey]['instructor'] = $aInstructors[$iInstructorKey]['instructorName'];
            $aEnrollmentData[$iKey]['paymentStatus'] = $this->aPaymentStatus[$aData['paymentStatus'] ?? 0];
            if ($aEnrollmentData[$iKey]['hasPendingPayments'] === true) {
                $aEnrollmentData[$iKey]['paymentStatus'] = 'Payment Submitted';
            }
        }

        $aUnnecessaryData = ['paymentId', 'paymentMethod', 'paymentDate', 'paymentAmount', 'paymentFile'];
        Utils::unsetUnnecessaryData($aEnrollmentData, $aUnnecessaryData);
        echo json_encode(array(
            'bResult'         => true,
            'aEnrollmentData' => array_values($aEnrollmentData),
        ));
    }

    public function fetchAvailableTrainingsForReschedule()
    {
        Utils::sanitizeData($this->aParams);

        // Get enrolled trainings.
        $aEnrolledTrainings = $this->oTrainingModel->fetchTrainingRequests($this->aParams['iStudentId']);
        $aCoursesAvailable = $this->oCourseModel->fetchAvailableCoursesAndSchedules();

        foreach ($aEnrolledTrainings as $iKey => $aEnrolledTraining) {
            // Unset rejected payments.
            if ($aEnrolledTraining['paymentApproval'] === '2') {
                unset($aEnrolledTrainings[$iKey]);
                continue;
            }
            // Unset already enrolled schedules.
                foreach ($aCoursesAvailable as $mKey => $aCourseAvailable) {
                    if ($aEnrolledTraining['scheduleId'] === $aCourseAvailable['scheduleId']) {
                    unset($aCoursesAvailable[$mKey]);
                }
            }
        }

        $aTrainingsAvailableForReschedule = [];
        if (count($aCoursesAvailable) > 0) {
            $aTrainingsAvailableForReschedule = $this->prepareTrainingsAvailable($aCoursesAvailable);
        }

        echo json_encode(array_values($aTrainingsAvailableForReschedule));
        // echo json_encode(array(
            // 'aTrainingsAvailableForReschedule' => array_values($aTrainingsAvailable),
            // 'aInstructors'                     => array_values(array_filter($this->oInstructorsModel->fetchInstructors(), fn ($aInstructors) => $aInstructors['status'] === 'Active'))
        // ));
    }
}
