var oRejectedPayments = (() => {

    let oTblStudents = $('#tbl_students');

    let oTblTrainingDetails = $('#tbl_trainingDetails');

    let oTblPaymentDetails = $('#tbl_paymentDetails');

    let oColumns = {
        aStudents: [
            {
                title: 'Student Name', className: 'text-center', data: 'studentName'
            },
            {
                title: 'E-mail Address', className: 'text-center', data: 'email'
            },
            {
                title: 'Contact Number', className: 'text-center', data: 'contactNum'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="viewDetails" data-id="${oRow.studentId}">
                        <i class="fa fa-eye"></i>
                    </button>`
            },
        ],
        aTrainingDetails: [
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
                title: 'Amount', className: 'text-center', data: 'coursePrice'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="viewPaymentDetails" data-id="${oRow.trainingId}">
                        <i class="fa fa-money"></i>
                    </button>`
            },
        ],
        aPaymentDetails: [
            {
                title: 'Date Paid', className: 'text-center', data: 'paymentDate'
            },
            {
                title: 'MOP', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.paymentMethod === null) ? 'N/A' : oRow.paymentMethod
            },
            {
                title: 'Training Fee', className: 'text-center', data: 'coursePrice',
            },
            {
                title: 'Amount Paid', className: 'text-center sum', data: 'paymentAmount',
            },
            {
                title: 'Reject Reason', className: 'text-center', data: 'rejectReason'
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

    let aStudents = [];

    let aTrainingDetails = [];

    let aPaymentDetails = [];

    let aPaymentModes = [];

    function init() {
        fetchStudentsWithRejectedPayments();
        setEvents();
    }

    function setEvents() {
        oForms.preparePaymentEvents();

        $(document).on('click', '#viewDetails', function () {
            fetchTrainingDataOfSelectedStudentWithRejectedPayment($(this).attr('data-id'));
            $('#viewDetailsModal').modal('show');
        });

        $(document).on('click', '#viewPaymentDetails', function () {
            const iTrainingId = $(this).attr('data-id');
            preparePaymentDetails(iTrainingId);
            loadPaymentDetailsTable(iTrainingId);
            $('#viewPaymentModal').modal('show');
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

        $(document).on('hidden.bs.modal', '#approvePaymentModal', function () {
            $(this).find('form')[0].reset();
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
                    'validationMethod': oValidations.validateApprovePaymentInputs(sFormId),
                    'requestClass': 'Payment',
                    'requestAction': 'approvePayment',
                    'alertTitle': 'Approve Payment?',
                    'alertText': 'This will approve the payment of the selected student.'
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
                    fetchStudentsThatHasPaid();
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

    function fetchStudentsWithRejectedPayments() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Payment&action=fetchStudentsWithRejectedPayments`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aStudents = oResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [1, 2, 3] }
                ];

                loadTable(oTblStudents.attr('id'), aStudents, oColumns.aStudents, aColumnDefs);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
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

    function fetchTrainingDataOfSelectedStudentWithRejectedPayment(iStudentId) {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchTrainingDataOfSelectedStudentWithRejectedPayment`,
            type: 'POST',
            data: { iStudentId },
            dataType: 'json',
            success: function (oResponse) {
                aTrainingDetails = oResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [1, 2, 3] }
                ];

                loadTable(oTblTrainingDetails.attr('id'), aTrainingDetails, oColumns.aTrainingDetails, aColumnDefs);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function preparePaymentDetails(iTrainingId) {
        const oDetails = aTrainingDetails.filter(oTrainingDetails => oTrainingDetails.trainingId == iTrainingId)[0];
        $('.viewPaymentModal').find('#courseName').val(oDetails.courseName);
        $('.viewPaymentModal').find('#schedule').val(oDetails.schedule);
        $('.viewPaymentModal').find('#venue').val(oDetails.venue);
        $('.viewPaymentModal').find('#instructor').val(oDetails.instructor);
    }

    function loadPaymentDetailsTable(iTrainingId) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Payment&action=fetchPaymentDetails',
            type: 'POST',
            data: { trainingId: iTrainingId },
            dataType: 'json',
            async: 'false',
            success: function (aResponse) {
                aPaymentDetails = aResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [1, 2, 3] }
                ];

                const aRejectedPayments = aResponse.filter(oData => oData.paymentApproval == 'Rejected');

                loadTable(oTblPaymentDetails.attr('id'), aRejectedPayments, oColumns.aPaymentDetails, aColumnDefs, false);
            },
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
            order: [[0, 'asc']],
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
    oRejectedPayments.initialize();

    $('.modal').on("hidden.bs.modal", function () {
        if ($('.modal:visible').length) {
            $('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
            $('body').addClass('modal-open');
        }
    }).on("show.bs.modal", function () {
        if ($('.modal:visible').length) {
            $('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
            $(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
        }
    });

});