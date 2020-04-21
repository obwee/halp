var oEnrollment = (() => {

    let oTblReservations = $('#tbl_reservations');
    let oTblPaymentDetails = $('#tbl_paymentDetails');
    let oCourseDropdown = $('.courseDropdown');
    let oScheduleDropdown = $('.scheduleDropdown');

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
    let aTrainingsAvailable = [];
    let aInstructors = [];

    function init() {
        fetchCoursesAndSchedules();
        fetchPaymentMethods();
        fetchStudents();
        initializeBloodhound();
        fetchEnrollmentData();
        setEvents();
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

        $(document).on('click', '.loadStudent', function() {
            const sFormId = `#${$(this).closest('form').attr('id')}`;
            const sStudentName = $(sFormId).find('input.typeahead.tt-input').val();
            const oStudentDetails = aStudentList.filter(oStudent => oStudent.studentName == sStudentName)[0];

            if (oStudentDetails === undefined) {
                oLibraries.displayErrorMessage(sFormId, 'Invalid student.', '.studentName');
            } else {
                fetchStudentEnrollmentData(oStudentDetails.studentId);
            }
        });

        $(document).on('hidden.bs.modal', '#approvePaymentModal', function () {
            $(this).find('form')[0].reset();
        });

        $(document).on('click', '#rescheduleEnrollee', function () {
            $('#rescheduleModal').modal('show');
        });

        $(document).on('change', '.courseDropdown', function () {
            populateScheduleDropdown($(this).val());
        });

        $(document).on('click', '#viewPaymentDetails', function () {
            const oStudentDetails = aEnrollees.filter(oEnrollee => oEnrollee.trainingId == $(this).attr('data-id'))[0];
            preparePaymentDetails(oStudentDetails);
            $('#viewPaymentModal').modal('show');

            $('#viewPaymentModal').find('.addPayment').css('display', 'block');
            if (oStudentDetails.paymentStatus === 'Fully Paid') {
                $('#viewPaymentModal').find('.addPayment').css('display', 'none');
            }

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

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            // oForms.disableFormState(sFormId, true);

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
                    'validationMethod': oValidations.validateAddWalkInForm('#addWalkInForm'),
                    'requestClass': 'Student',
                    'requestAction': 'addWalkIn',
                    'alertTitle': 'Add Student?',
                    'alertText': 'This will add a student as walk-in.'
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
    }

    /**
    * executeSubmit
    * @param {string} sFormId
    * @param {string} sRequestClass
    * @param {string} sRequestAction
    */
    function executeSubmit(sFormId, sRequestClass, sRequestAction) {
        const oFormData = new FormData($(sFormId)[0]);

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

    function preparePaymentDetails(oStudentDetails) {
        $('.viewPaymentModal').find('#studentName').val(oStudentDetails.studentName);
        $('.viewPaymentModal').find('#courseName').val(oStudentDetails.courseCode);
        $('.viewPaymentModal').find('#schedule').val(oStudentDetails.schedule);
        $('.viewPaymentModal').find('#venue').val(oStudentDetails.venue);
        $('.viewPaymentModal').find('#instructor').val(oStudentDetails.instructor);

        loadPaymentDetailsTable(oStudentDetails);
    }

    function loadPaymentDetailsTable(oStudentDetails) {
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

                        $(this.footer()).text(`P${iBalance.toLocaleString()}`);
                    });
                };

                const aDetails = aResponse.filter(oData => oData.paymentApproval != 'Rejected');

                loadTable(oTblPaymentDetails.attr('id'), aDetails, oColumns.aPaymentDetails, aColumnDefs, false, oFooterCallback);
            },
        });
    }

    // Populate the payment mode dropdown select.
    function populateModeOfPayments(aCourses) {
        let oPaymentModeDropdown = $('#approvePaymentForm').find('.modeOfPayment');
        oPaymentModeDropdown.empty().append($('<option value="" selected disabled hidden>Select Mode of Payment</option>'));

        $.each(aPaymentModes, function (iKey, oMode) {
            oPaymentModeDropdown.append($('<option />').val(oMode.id).text(`${oMode.methodName}`));
        });
    }

    function populateCourseDropdown() {
        oCourseDropdown.empty().append($('<option selected disabled hidden>Select Course</option>'));

        $.each(aCoursesAndSchedules, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    function populateScheduleDropdown(iCourseId) {
        let oFilteredCourse = aCoursesAndSchedules.filter(oCourse => oCourse.courseId == iCourseId)[0];
        oScheduleDropdown.empty().append($('<option selected disabled hidden>Select Schedule</option>'));

        $.each(oFilteredCourse.schedule, function (iScheduleId, sScheduleDate) {
            oScheduleDropdown.append($('<option />').val(iScheduleId).text(sScheduleDate));
        });
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
                populateCourseDropdown(oResponse);
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

    function fetchStudentEnrollmentData(iStudentId) {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchStudentEnrollmentData`,
            type: 'POST',
            data: {iStudentId},
            dataType: 'json',
            success: function (oResponse) {
                aTrainingsAvailable = oResponse.aTrainingsAvailable;
                aInstructors = oResponse.aInstructors;
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
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
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
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oEnrollment.initialize();
    window.swal = this.swal = this.Sweetalert2;
});