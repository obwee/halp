var oEnrollment = (() => {

    let oTblReservations = $('#tbl_reservations');
    let oTblPaymentDetails = $('#tbl_paymentDetails');
    let oCourseFilterDropdown = $('.courseFilterDropdown');
    let oScheduleFilterDropdown = $('.scheduleFilterDropdown');
    let oCourseDropdownForWalkIn = $('.courseDropdown');
    let oScheduleDropdownForWalkIn = $('.scheduleDropdown');
    let oCourseDropdownForReschedule = $('.courseDropdownForReschedule');
    let oScheduleDropdownForReschedule = $('.scheduleDropdownForReschedule');

    let oColumns = {
        aEnrollees: [
            {
                title: 'Student Name', className: 'text-center', data: 'studentName'
            },
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Schedule', className: 'text-center', data: 'schedule'
            },
            {
                title: 'Venue', className: 'text-center', data: 'venue'
            },
            {
                title: 'Instructor', className: 'text-center', data: 'instructor'
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentStatus'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-success btn-sm" data-toggle="modal" id="viewPaymentDetails" data-id="${oRow.trainingId}">
                        <i class="fa fa-hand-holding-usd"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" id="rescheduleEnrollee" data-id="${oRow.trainingId}">
                        <i class="fa fa-calendar"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="cancelReservation" data-id="${oRow.trainingId}">
                        <i class="fa fa-times-circle"></i>
                    </button>`
            },
        ],
        aPaymentDetails: [
            {
                title: 'Date Paid', className: 'text-center', data: 'paymentDate'
            },
            {
                title: 'MOP', className: 'text-center', data: 'paymentMethod'
            },
            {
                title: 'Training Fee', className: 'text-center', data: 'coursePrice'
            },
            {
                title: 'Amount Paid', className: 'text-center sum', data: 'paymentAmount'
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentApproval'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.paymentApproval !== 'Approved') ?
                        `<button class="btn btn-success btn-sm" data-toggle="modal" id="approvePayment" data-id="${oRow.paymentId}">
                        <i class="fa fa-check-circle"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="rejectPayment" data-id="${oRow.paymentId}">
                        <i class="fa fa-times-circle"></i>
                    </button>
                    <a href="${oRow.paymentImage}" data-lightbox="payment-image-${oRow.paymentId}">
                        <button class="btn btn-primary btn-sm" id="viewPaymentImage" data-id="${oRow.paymentId}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </a>` :
                        `<a href="${oRow.paymentImage}" data-lightbox="payment-image-${oRow.paymentId}">
                        <button class="btn btn-primary btn-sm" id="viewPaymentImage" data-id="${oRow.paymentId}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </a>`
            },
        ]
    };

    let aCoursesAndSchedules = [];
    let aEnrollees = [];
    let aPaymentDetails = [];
    let aPaymentModes = [];
    let aStudentList = [];
    let aStudentNames = [];
    let oStudentsTypeAhead = {};
    let oStudentDetails = {};
    let aTrainingsAvailable = [];
    let aInstructors = [];
    let oTemplate = {};
    let aVenues = [];
    let aTrainingsAvailableForReschedule = [];
    let sFilter = '';

    function init() {
        checkUrlParams();
        fetchCoursesAndSchedules();
        fetchPaymentMethods();
        fetchVenues();
        fetchStudents();
        initializeBloodhound();
        fetchEnrollmentData();
        setEvents();
    }

    function checkUrlParams() {
        const oSearchParams = new URLSearchParams(window.location.search);
        if (oSearchParams.has('studentName') === true) {
            sFilter = oSearchParams.get('studentName');
        }
        if (oSearchParams.has('courseName') === true) {
            sFilter = sFilter + ' ' + oSearchParams.get('courseName');
        }
    }

    function initializeBloodhound() {
        oStudentsTypeAhead = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: aStudentNames
        });
    }

    function setEvents() {
        oForms.preparePaymentEvents();

        $('.studentSearch .studentName').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
            {
                name: 'aStudentNames',
                source: oStudentsTypeAhead
            });

        $(document).on('click', '.loadStudent', function () {
            const sFormId = `#${$(this).closest('form').attr('id')}`;
            const sStudentName = $(sFormId).find('input.typeahead.tt-input').val();
            oStudentDetails = aStudentList.filter(oStudent => oStudent.studentName == sStudentName)[0];

            if (oStudentDetails === undefined) {
                oLibraries.displayErrorMessage(sFormId, 'Invalid student.', '.studentName');
                $(sFormId)[0].reset();
                $(sFormId).find('.dropdowns select').prop('disabled', true);
            } else {
                fetchStudentEnrollmentData(oStudentDetails.studentId);
                $(sFormId).find('.dropdowns select').prop('disabled', false);
                $(sFormId).find('.studentId').val(oStudentDetails.studentId);
            }
        });

        $(document).on('hidden.bs.modal', '#approvePaymentModal, #addWalkinModal', function () {
            $(this).find('form')[0].reset();
            if ($(this).attr('id') === 'addWalkinModal') {
                $(this).find('.studentId').val('');
                $(this).find('.dropdowns select').prop('disabled', true);
            }
        });

        $(document).on('click', '#rescheduleEnrollee', function () {
            oStudentDetails = aEnrollees.filter(oEnrollee => oEnrollee.trainingId == $(this).attr('data-id'))[0];
            displayStudentDetails();
            fetchAvailableTrainingsForReschedule();
            $('#rescheduleModal').modal('show');
        });

        $(document).on('change', '.courseFilterDropdown', function () {
            populateScheduleDropdown(oScheduleFilterDropdown, aCoursesAndSchedules, $(this).val());
        });

        $(document).on('change', '.courseDropdown', function () {
            populateScheduleDropdown(oScheduleDropdownForWalkIn, aTrainingsAvailable, $(this).val());
        });

        $(document).on('change', '.scheduleDropdown', function () {
            populateRemainingInputs($(this).val());
        });

        $(document).on('change', '.scheduleFilterDropdown', function () {
            let iScheduleId = $(this).val();
            let iNumSlots = aCoursesAndSchedules.filter(oSchedule => oSchedule.schedule[iScheduleId])[0].slots[iScheduleId];
            $('.numSlots').val(iNumSlots);
        });

        $(document).on('change', '.courseDropdownForReschedule', function () {
            populateScheduleDropdown(oScheduleDropdownForReschedule, aTrainingsAvailableForReschedule, $(this).val());
        });

        $(document).on('click', '#clearSelection', function () {
            $(this).closest('form')[0].reset();
            oScheduleFilterDropdown.empty().append('<option selected disabled hidden>Select Schedule</option>');
            sFilter = '';
            fetchEnrollmentData();
        });

        $(document).on('click', '.addPayment', function () {
            $('#addPaymentModal').modal('show');
        });

        $(document).on('click', '#viewPaymentDetails', function () {
            oStudentDetails = aEnrollees.filter(oEnrollee => oEnrollee.trainingId == $(this).attr('data-id'))[0];
            preparePaymentDetails();
            $('#viewPaymentModal').modal('show');

            $('#viewPaymentModal').find('.addPayment').css('display', 'block');

            if (oStudentDetails.paymentStatus === 'Fully Paid') {
                $('#viewPaymentModal').find('.addPayment').css('display', 'none');
                $('#viewPaymentModal').find('.clearChange').css('display', 'none');
            } else if (oStudentDetails.paymentStatus === 'Has Change') {
                $('#viewPaymentModal').find('.addPayment').css('display', 'none');
                $('#viewPaymentModal').find('.clearChange').css('display', 'block');
            } else {
                $('#viewPaymentModal').find('.addPayment').css('display', 'block');
                $('#viewPaymentModal').find('.clearChange').css('display', 'none');
            }
        });

        $(document).on('click', '.clearChange', function () {
            Swal.fire({
                title: 'Clear existing credits?',
                text: 'This will clear the credits of the enrollee.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    const iTrainingId = aPaymentDetails[0]['trainingId'];

                    axios.post('/Nexus/utils/ajax.php?class=Payment&action=clearChange', { trainingId: iTrainingId })
                        .then(function (oResponse) {
                            oLibraries.displayAlertMessage((oResponse.data.bResult === true) ? 'success' : 'error', oResponse.data.sMsg);
                            fetchEnrollmentData();
                            $('.modal').modal('hide');
                        });
                }
            });
        });

        $(document).on('click', '#approvePayment', function () {
            const oDetails = aPaymentDetails.filter(oPaymentDetails => oPaymentDetails.paymentId == $(this).attr('data-id'))[0];
            $('.paymentImage a').attr('href', `../payments/${oDetails.paymentImage}`);
            $('.paymentImage img').attr('src', `../payments/${oDetails.paymentImage}`);

            // Remove peso sign.
            const iBalance = oDetails.totalBalance.replace('P', '');
            $('.oldBalance').val(iBalance);
            $('.newBalance').val(iBalance);
            // Add payment ID.
            $('.paymentId').val(oDetails.paymentId);

            populateModeOfPayments();

            $('#approvePaymentModal').modal('show');
        });

        $(document).on('click', '#rejectPayment', function () {
            Swal.fire({
                title: 'Reject payment?',
                text: 'Please state reason for rejecting payment.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: (sRejectReason) => {
                    if (sRejectReason === '') {
                        Swal.showValidationMessage('Payment reject reason cannot be empty.');
                    } else {
                        return rejectPayment($(this).attr('data-id'), sRejectReason);
                    }
                },
            }).then((oResponse) => {
                oLibraries.displayAlertMessage((oResponse.value.bResult === true) ? 'success' : 'error', oResponse.value.sMsg);
                fetchEnrollmentData();
                $('.modal').modal('hide');
            })
        });

        $(document).on('click', '#cancelReservation', function () {
            const oCourseDetails = aEnrollees.filter(oCourse => oCourse.trainingId == $(this).attr('data-id'))[0];
            if (oCourseDetails.paymentStatus === 'Not Yet Paid') {
                Swal.fire({
                    title: 'Cancel Reservation?',
                    text: 'Please state cancellation reason.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    allowOutsideClick: () => !Swal.isLoading(),
                    preConfirm: (sCancellationReason) => {
                        if (sCancellationReason === '') {
                            Swal.showValidationMessage('Cancellation reason cannot be empty.');
                        } else {
                            return cancelReservation(oCourseDetails.trainingId, sCancellationReason);
                        }
                    },
                }).then((oResponse) => {
                    oLibraries.displayAlertMessage((oResponse.value.bResult === true) ? 'success' : 'error', oResponse.value.sMsg);
                    fetchEnrollmentData();
                    $('.modal').modal('hide');
                })
            } else {
                checkIfAlreadyRequestedForRefund(oCourseDetails.trainingId)
                    .then((oResponse) => {
                        if (oResponse.bResult === false) {
                            return oLibraries.displayAlertMessage('error', oResponse.sMsg);
                        }
                        $('#cancelReservationModal').find('.trainingId').val(oCourseDetails.trainingId);
                        $('#cancelReservationModal').modal('show');
                    });
            }
        });

        $(document).on('submit', 'form[id!="filterForm"]', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oInputForms = {
                '#approvePaymentForm': {
                    'validationMethod': oValidations.validateApprovePaymentInputs('#approvePaymentForm'),
                    'requestClass': 'Payment',
                    'requestAction': 'approvePayment',
                    'alertTitle': 'Approve Payment?',
                    'alertText': 'This will approve the payment of the selected student.'
                },
                '#cancelReservationForm': {
                    'validationMethod': oValidations.validateCancelReservationForm('#cancelReservationForm'),
                    'requestClass': 'Refunds',
                    'requestAction': 'requestRefund',
                    'alertTitle': 'Request Refund?',
                    'alertText': 'This will request a refund before cancelling the reservation.'
                },
                '#addWalkInForm': {
                    'validationMethod': oValidations.validateAddWalkInInputs('#addWalkInForm'),
                    'requestClass': 'Student',
                    'requestAction': 'addWalkIn',
                    'alertTitle': 'Add Student?',
                    'alertText': 'This will add a student as walk-in.'
                },
                '#addPaymentForm': {
                    'validationMethod': oValidations.validateFileForPayment(sFormId),
                    'requestClass': 'Payment',
                    'requestAction': 'addPayment',
                    'alertTitle': 'Add Payment?',
                    'alertText': 'This will add a new payment to the selected reservation.'
                },
                '#rescheduleForm': {
                    'validationMethod': oValidations.validateRescheduleInputs(sFormId),
                    'requestClass': 'Schedules',
                    'requestAction': 'rescheduleTraining',
                    'alertTitle': 'Reschedule Training?',
                    'alertText': 'This will change the schedule of the selected training.'
                }
            }

            // Validate the inputs of the submitted form and store the result inside oValidateInputs variable.
            let oValidateInputs = oInputForms[sFormId].validationMethod;

            if (oValidateInputs.result === true) {
                Swal.fire({
                    title: oInputForms[sFormId].alertTitle,
                    text: oInputForms[sFormId].alertText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((bIsConfirm) => {
                    if (bIsConfirm.value === true) {
                        executeSubmit(sFormId, oInputForms[sFormId].requestClass, oInputForms[sFormId].requestAction);
                    }
                });
            } else {
                oLibraries.displayErrorMessage(sFormId, oValidateInputs.msg, oValidateInputs.element);
            }
            // Enable the form.
            oForms.disableFormState(sFormId, false);
        });

        $(document).on('submit', '#filterForm', function (oEvent) {
            oEvent.preventDefault();
            const sFormId = `#${$(this).attr('id')}`;
            let oFormData = new FormData($(sFormId)[0]);

            // Check for invalid values.
            for ([sName, sValue] of oFormData.entries()) {
                if (/^[0-9]/.test(sValue) === false) {
                    oLibraries.displayAlertMessage('error', 'Invalid filters detected.');
                    return false;
                }
            }

            $.ajax({
                url: `/Nexus/utils/ajax.php?class=Training&action=fetchFilteredEnrollmentData`,
                type: 'POST',
                data: oFormData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (oResponse) {
                    if (oResponse.bResult === false) {
                        oLibraries.displayAlertMessage('error', oResponse.sMsg);
                    }
                    aEnrollees = oResponse.aEnrollmentData;

                    let aColumnDefs = [
                        { orderable: false, targets: [3, 4, 5, 6] }
                    ];

                    loadTable(oTblReservations.attr('id'), aEnrollees, oColumns.aEnrollees, aColumnDefs);
                },
                error: function () {
                    oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
                }
            });

        });
    }

    /**
    * executeSubmit
    * @param {string} sFormId
    * @param {string} sRequestClass
    * @param {string} sRequestAction
    */
    function executeSubmit(sFormId, sRequestClass, sRequestAction) {
        const oFormData = new FormData($(sFormId)[0]);
        if (sRequestAction === 'addPayment') {
            for ([sName, mValue] of Object.entries(oStudentDetails)) {
                oFormData.append(sName, mValue);
            }
        }

        // Execute AJAX.
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=${sRequestClass}&action=${sRequestAction}`,
            type: 'POST',
            data: oFormData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.spinner').css('display', 'block');
            },
            success: (oResponse) => {
                if (oResponse.bResult === true) {
                    fetchEnrollmentData();
                    fetchCoursesAndSchedules();
                    fetchStudents();
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    $('.modal').modal('hide');
                } else {
                    oLibraries.displayErrorMessage(sFormId, oResponse.sMsg, oResponse.sElement);
                }
            },
            complete: () => {
                $('.spinner').css('display', 'none');
            }
        });
    }

    async function checkIfAlreadyRequestedForRefund(iTrainingId) {
        const oRequest = await axios.post('/Nexus/utils/ajax.php?class=Refunds&action=checkIfAlreadyRequestedForRefund', { iTrainingId });
        return oRequest.data;
    }

    function rejectPayment(iPaymentId, sRejectReason) {
        const oData = {
            iPaymentId,
            sRejectReason
        }

        return axios.post('/Nexus/utils/ajax.php?class=Payment&action=rejectPayment', oData)
            .then(function (oResponse) {
                return oResponse.data;
            })
            .catch(function (oError) {
                return oError;
            });
    }

    function cancelReservation(iTrainingId, sCancellationReason) {
        const oData = {
            iTrainingId,
            sCancellationReason
        }

        return axios.post('/Nexus/utils/ajax.php?class=Training&action=cancelReservation', oData)
            .then(function (oResponse) {
                return oResponse.data;
            })
            .catch(function (oError) {
                return oError;
            });
    }

    function preparePaymentDetails() {
        $('.viewPaymentModal').find('#studentName').val(oStudentDetails.studentName);
        $('.viewPaymentModal').find('#courseName').val(oStudentDetails.courseCode);
        $('.viewPaymentModal').find('#schedule').val(oStudentDetails.schedule);
        $('.viewPaymentModal').find('#venue').val(oStudentDetails.venue);
        $('.viewPaymentModal').find('#instructor').val(oStudentDetails.instructor);

        loadPaymentDetailsTable();
    }

    function displayStudentDetails() {
        $('.rescheduleModal').find('#studId').val(oStudentDetails.studentId);
        $('.rescheduleModal').find('#trainingId').val(oStudentDetails.trainingId);
        $('.rescheduleModal').find('#studName').val(oStudentDetails.studentName);
        $('.rescheduleModal').find('#course').val(oStudentDetails.courseCode);
        $('.rescheduleModal').find('#schedule').val(oStudentDetails.schedule);
    }

    function loadPaymentDetailsTable() {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Payment&action=fetchPaymentDetails',
            type: 'POST',
            data: { trainingId: oStudentDetails.trainingId },
            dataType: 'json',
            async: 'false',
            success: function (aResponse) {
                aPaymentDetails = aResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [1, 2, 3] }
                ];

                let oFooterCallback = function () {
                    let oApi = this.api();

                    // Remove the formatting to get integer data for summation.
                    let intVal = (mValue) => {
                        return typeof mValue === 'string' ?
                            mValue.replace(/[P,]/g, '') * 1 :
                            typeof mValue === 'number' ?
                                mValue : 0;
                    };

                    // Get the sum of all the columns with a class named 'sum'.
                    oApi.columns('.sum').every(function () {
                        let iTotalPaid = oApi
                            .cells(null, this.index())
                            .render('display')
                            .reduce((iAccumulator, iCurrentValue) => {
                                return intVal(iAccumulator) + intVal(iCurrentValue);
                            }, 0);

                        // const iCoursePrice = aTrainingRequests.filter(oCourse => oCourse.trainingId = oEr)

                        const iBalance = oStudentDetails.coursePrice.replace(/[P,]/g, '') - iTotalPaid;
                        if (iBalance === 0 || iBalance > 0) {
                            $('.footerBalance').text('Remaining Balance:');
                            $(this.footer()).text(`P${iBalance.toLocaleString()}`);
                        } else {
                            $('.footerBalance').text('Change:');
                            $(this.footer()).text(`P${Math.abs(iBalance).toLocaleString()}`);
                        }
                    });
                };

                const aDetails = aResponse.filter(oData => oData.paymentApproval != 'Rejected');

                loadTable(oTblPaymentDetails.attr('id'), aDetails, oColumns.aPaymentDetails, aColumnDefs, false, oFooterCallback);
            },
        });
    }

    // Populate the payment mode dropdown select.
    function populateModeOfPayments() {
        let oPaymentModeDropdown = $('#approvePaymentForm').find('.modeOfPayment');
        oPaymentModeDropdown.empty().append($('<option value="" selected disabled hidden>Select Mode of Payment</option>'));

        $.each(aPaymentModes, function (iKey, oMode) {
            oPaymentModeDropdown.append($('<option />').val(oMode.id).text(`${oMode.methodName}`));
        });
    }

    function populateCourseDropdown(oCourseDropdown, aData) {
        oCourseDropdown.empty().append($('<option selected disabled hidden>Select Course</option>'));

        $.each(aData, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    function populateScheduleDropdown(oScheduleDropdown, aData, iCourseId) {
        let oFilteredCourse = aData.filter(oCourse => oCourse.courseId == iCourseId)[0];
        oScheduleDropdown.empty().append($('<option selected disabled hidden>Select Schedule</option>'));

        $.each((oFilteredCourse.schedule ?? oFilteredCourse.schedules), function (iScheduleId, sScheduleDate) {
            oScheduleDropdown.append($('<option />').val(iScheduleId).text(sScheduleDate));
        });
    }

    function populateRemainingInputs(iScheduleId) {
        let oFilteredSchedule = aTrainingsAvailable.filter(oCourse => oCourse.schedules[iScheduleId])[0];

        $('.price').val(`P${parseInt(oFilteredSchedule['prices'][iScheduleId], 10).toLocaleString()}`);
        $('.venue').val(oFilteredSchedule['venues'][iScheduleId]);
        $('.slots').val(oFilteredSchedule['slots'][iScheduleId]);

        let iInstructorId = oFilteredSchedule['instructors'][iScheduleId];
        let oInstructor = aInstructors.filter(oInstructor => oInstructor.id == iInstructorId)[0];

        $('.instructor').val(`${oInstructor.firstName} ${oInstructor.lastName}`);
    }

    /**
     * fetchCoursesAndSchedules
     */
    function fetchCoursesAndSchedules() {
        // Execute AJAX request.
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Forms&action=fetchHomepageData',
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aCoursesAndSchedules = oResponse;
                populateCourseDropdown(oCourseFilterDropdown, aCoursesAndSchedules);
            }
        });
    }

    function fetchPaymentMethods() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Payment&action=fetchModeOfPayments`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aPaymentModes = oResponse.filter(oMode => oMode.status === 'Active');
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchVenues() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Venue&action=fetchVenues`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aVenues = oResponse.filter(oVenue => oVenue.status === 'Active');
                populateVenues();
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function loadTemplate() {
        if ($.isEmptyObject(oTemplate) === true) {
            oTemplate = $('.venue-tpl').clone();
        }
    }

    function populateVenues() {
        loadTemplate();

        $.each(aVenues, (iKey, oVal) => {
            let oRow = oTemplate.clone().attr({
                'hidden': false,
                'class': 'clonedTpl',
            });

            oRow.find('.venue').val(oVal.id);
            oRow.find('label').text(oVal.venue);

            oRow.insertAfter($('.venue-tpl'));
        });
    }

    function fetchAvailableTrainingsForReschedule() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchAvailableTrainingsForReschedule`,
            type: 'POST',
            data: {
                iTrainingId: oStudentDetails.trainingId,
                iScheduleId: oStudentDetails.scheduleId,
                iStudentId: oStudentDetails.studentId
            },
            dataType: 'json',
            success: function (oResponse) {
                aTrainingsAvailableForReschedule = oResponse;
                populateCourseDropdown(oCourseDropdownForReschedule, aTrainingsAvailableForReschedule);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchStudentEnrollmentData(iStudentId) {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchStudentEnrollmentData`,
            type: 'POST',
            data: { iStudentId },
            dataType: 'json',
            success: function (oResponse) {
                aTrainingsAvailable = oResponse.aTrainingsAvailable;
                aInstructors = oResponse.aInstructors;
                populateCourseDropdown(oCourseDropdownForWalkIn, aTrainingsAvailable);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchStudents() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Student&action=fetchStudents`,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (oResponse) {
                aStudentList = oResponse;
                aStudentList.forEach((oStudent) => {
                    aStudentNames.push(oStudent.studentName);
                });
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchEnrollmentData() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchEnrollmentData`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aEnrollees = oResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [3, 4, 5, 6] }
                ];

                loadTable(oTblReservations.attr('id'), aEnrollees, oColumns.aEnrollees, aColumnDefs);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function loadTable(sTableName, aData, aColumns, aColumnDefs, bSearching = true, oFooterCallback = () => { }) {
        $(`#${sTableName} > tbody`).empty().parent().dataTable({
            destroy: true,
            deferRender: true,
            data: aData,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            order: [[2, 'asc']],
            searching: bSearching,
            lengthChange: true,
            lengthMenu: [[4, 8, 12, 16, 20, 24, -1], [4, 8, 12, 16, 20, 24, 'All']],
            info: true,
            columns: aColumns,
            columnDefs: aColumnDefs,
            footerCallback: oFooterCallback
        }).fnFilter(sFilter);
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oEnrollment.initialize();
    window.swal = this.swal = this.Sweetalert2;
});