var oPayments = (() => {

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
                title: 'Balance', className: 'text-center', data: 'remainingBalance'
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentStatus'
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
                        <a href="${oRow.paymentImage}" data-lightbox="payment-image">
                            <button class="btn btn-primary btn-sm" id="viewPaymentImage" data-id="${oRow.paymentId}">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>` :
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
        fetchStudentsThatHasPaid();
        fetchPaymentMethods();
        setEvents();
    }

    function setEvents() {
        oForms.preparePaymentEvents();

        $(document).on('click', '#viewDetails', function () {
            fetchTrainingDataOfSelectedStudent($(this).attr('data-id'));
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
                $('.modal').modal('hide');
            })
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

    function fetchStudentsThatHasPaid() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Payment&action=fetchStudentsThatHasPaid`,
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

    // Populate the payment mode dropdown select.
    function populateModeOfPayments(aCourses) {
        let oPaymentModeDropdown = $('#approvePaymentForm').find('.modeOfPayment');
        oPaymentModeDropdown.empty().append($('<option value="" selected disabled hidden>Select Mode of Payment</option>'));

        $.each(aPaymentModes, function (iKey, oMode) {
            oPaymentModeDropdown.append($('<option />').val(oMode.id).text(`${oMode.methodName}`));
        });
    }

    function fetchTrainingDataOfSelectedStudent(iStudentId) {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchTrainingDataOfSelectedStudent`,
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

                        const iBalance = aPaymentDetails[0].coursePrice.replace(/[P,]/g, '') - iTotalPaid;

                        $(this.footer()).text(`P${iBalance.toLocaleString()}`);
                    });
                };

                const aData = aPaymentDetails.filter(oData => oData.paymentApproval != 'Rejected');

                loadTable(oTblPaymentDetails.attr('id'), aData, oColumns.aPaymentDetails, aColumnDefs, false, oFooterCallback);
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
    oPayments.initialize();

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