var oEnrollment = (() => {

    let oTblEnrollment = $('#tbl_enrollment');

    let oTblPaymentDetails = $('#tbl_paymentDetails');

    let aTrainingRequests = [];

    let aTrainingsAvailable = [];

    let aInstructors = [];

    let oEnrollmentDetails = {};

    let oCourseDropdown = $('.courses');

    let oScheduleDropdown = $('.schedules');

    let oColumns = {
        aCourses: [
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
                title: 'Amount', className: 'text-center', render: (aData, oType, oRow) =>
                    oLibraries.formatCurrency(oRow.coursePrice)
            },
            {
                title: 'Balance', className: 'text-center', render: (aData, oType, oRow) =>
                    oLibraries.formatCurrency(oRow.paymentBalance)
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentStatus'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-success btn-sm" data-toggle="modal" id="viewPayment" data-id="${oRow.trainingId}">
                        <i class="fa fa-hand-holding-usd"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" id="printRegiForm" data-id="${oRow.trainingId}">
                        <i class="fa fa-print"></i>
                    </button>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" id="reschedule" data-id="${oRow.trainingId}">
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
                    `<a href="${oRow.paymentImage}" data-lightbox="payment-image">
                        <button class="btn btn-primary btn-sm" id="viewPaymentImage" data-id="${oRow.paymentId}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </a>`
            },
        ]
    };

    function init() {
        fetchTrainingRequests();
        setEvents();
    }

    function setEvents() {

        oForms.prepareDomEvents();

        $('#enrollModal, #cancelReservationModal, #addPaymentModal').on('hidden.bs.modal', function () {
            let sFormId = `#${$(this).find('form').attr('id')}`;
            $(sFormId)[0].reset();
            $(sFormId).find('.custom-file-label').text('Select File');
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#viewPayment', function () {
            oEnrollmentDetails = aTrainingRequests.filter(aCourse => aCourse.trainingId == $(this).attr('data-id'))[0];
            preparePaymentDetails();
            $('#viewPaymentModal').modal('show');
        });

        $(document).on('click', '.addPayment', function () {
            $('#addPaymentModal').modal('show');
        });

        $(document).on('click', '#reschedule', function () {
            $('#rescheduleModal').modal('show');
        });

        $(document).on('click', '#cancelReservation', function () {
            const oCourseDetails = aTrainingRequests.filter(oCourse => oCourse.trainingId == $(this).attr('data-id'))[0];
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
                    fetchCourses();
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

        $(document).on('click', '#enrollBtn', function () {
            populateCourseDropdown();
            $('#enrollModal').modal('show');
        });

        $(document).on('click', '#printRegiForm', function () {
            const oDetails = aTrainingRequests.filter(oCourse => oCourse.trainingId == $(this).attr('data-id'))[0];
            printRegiForm(oDetails);
        });

        $(document).on('change', '.courses', function () {
            populateScheduleDropdown($(this).val());
        });

        $(document).on('change', '.schedules', function () {
            populateRemainingInputs($(this).val());
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oInputForms = {
                '#enrollForm': {
                    'validationMethod': oValidations.validateEnrollmentInputs(sFormId),
                    'requestClass': 'Student',
                    'requestAction': 'enrollForTraining',
                    'alertTitle': 'Enroll course?',
                    'alertText': 'This will add a new course to enroll.'
                },
                '#addPaymentForm': {
                    'validationMethod': oValidations.validateFileForPayment(sFormId),
                    'requestClass': 'Payment',
                    'requestAction': 'addPayment',
                    'alertTitle': 'Add Payment?',
                    'alertText': 'This will add a new payment to the selected reservation.'
                },
                '#cancelReservationForm': {
                    'validationMethod': oValidations.validateCancelReservationForm(sFormId),
                    'requestClass': 'Refunds',
                    'requestAction': 'requestRefund',
                    'alertTitle': 'Request Refund?',
                    'alertText': 'This will request a refund before cancelling the reservation.'
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

    async function checkIfAlreadyRequestedForRefund(iTrainingId) {
        const oRequest = await axios.post('/Nexus/utils/ajax.php?class=Refunds&action=checkIfAlreadyRequestedForRefund', { iTrainingId });
        return oRequest.data;
    }

    function preparePaymentDetails() {
        $('.viewPaymentModal').find('#courseName').val(oEnrollmentDetails.courseName);
        $('.viewPaymentModal').find('#schedule').val(`${oEnrollmentDetails.fromDate} - ${oEnrollmentDetails.toDate}`);
        $('.viewPaymentModal').find('#venue').val(oEnrollmentDetails.venue);
        $('.viewPaymentModal').find('#instructor').val(oEnrollmentDetails.instructorName);

        loadPaymentDetailsTable();
    }

    function loadPaymentDetailsTable() {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Payment&action=fetchPaymentDetails',
            type: 'POST',
            data: { trainingId: oEnrollmentDetails.trainingId },
            dataType: 'json',
            async: 'false',
            success: function (aResponse) {
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

                        const iBalance = oEnrollmentDetails.coursePrice.replace(/[P,]/g, '') - iTotalPaid;

                        $(this.footer()).text(`P${iBalance.toLocaleString()}`);
                    });
                };

                const aDetails = aResponse.filter(oData => oData.paymentStatus != 'Fully Paid' && oData.paymentApproval != 'Rejected');

                loadTable(oTblPaymentDetails.attr('id'), aDetails, oColumns.aPaymentDetails, aColumnDefs, false, oFooterCallback);
            },
        });
    }

    function populateCourseDropdown() {
        oCourseDropdown.empty().append($('<option selected disabled hidden>Select Course</option>'));

        $.each(aTrainingsAvailable, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    function populateScheduleDropdown(iCourseId) {
        let oFilteredCourse = aTrainingsAvailable.filter(oCourse => oCourse.courseId == iCourseId)[0];

        oScheduleDropdown.empty().append($('<option selected disabled hidden>Select Schedule</option>'));

        $.each(oFilteredCourse.schedules, function (iScheduleId, sScheduleDate) {
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
     * executeSubmit
     * @param {string} sFormId
     * @param {string} sRequestClass
     * @param {string} sRequestAction
     */
    function executeSubmit(sFormId, sRequestClass, sRequestAction) {
        const oFormData = new FormData($(sFormId)[0]);
        if (sRequestAction === 'addPayment') {
            for ([sName, mValue] of Object.entries(oEnrollmentDetails)) {
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
                    fetchCourses();
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

    function printRegiForm(oDetails) {
        window.open('/Nexus/utils/ajax.php?class=Student&action=printRegiForm&tId=' + oDetails.trainingId);
    }

    function fetchTrainingRequests() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchTrainingRequests`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aTrainingRequests = oResponse.aTrainingRequests;
                aTrainingsAvailable = oResponse.aTrainingsAvailable;
                aInstructors = oResponse.aInstructors;

                let aColumnDefs = [
                    { orderable: false, targets: [3, 4, 5, 6] }
                ];

                loadTable(oTblEnrollment.attr('id'), aTrainingRequests, oColumns.aCourses, aColumnDefs);
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
            order: [[1, 'asc']],
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

$(() => {
    oEnrollment.initialize();
});
