var oRefundRequests = (() => {

    let oTblRefunds = $('#tbl_refunds');
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
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="viewRequestDetails" data-id="${oRow.trainingId}">
                        <i class="fa fa-eye"></i>
                    </button>`
            },
        ],
        aRequestDetails: [
            {
                title: 'Date Requested', className: 'text-center', data: 'dateRequested'
            },
            {
                title: 'MOP', className: 'text-center', data: 'paymentMethod'
            },
            {
                title: 'Training Fee', className: 'text-center', data: 'coursePrice',
            },
            {
                title: 'Amount Paid', className: 'text-center sum', data: 'paymentAmount',
            },
            {
                title: 'Refund Reason', className: 'text-center', data: 'refundReason'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-success btn-sm" data-toggle="modal" id="approveRefund" data-id="${oRow.refundId}">
                        <i class="fa fa-check-circle"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="rejectRefund" data-id="${oRow.refundId}">
                        <i class="fa fa-times-circle"></i>
                    </button>`
            },
        ]
    };

    let aRefunds = [];
    let aTrainingDetails = [];
    let aRefundDetails = [];

    function init() {
        fetchRefundRequests();
        setEvents();
    }

    function setEvents() {
        oForms.preparePaymentEvents();

        $(document).on('click', '#viewDetails', function () {
            fetchTrainingDataOfSelectedStudentWithRefundRequest($(this).attr('data-id'));
            $('#viewDetailsModal').modal('show');
        });

        $(document).on('click', '#viewRequestDetails', function () {
            const iTrainingId = $(this).attr('data-id');
            prepareStudentDetails(iTrainingId);
            loadRefundDetailsTable(iTrainingId);
            $('#viewRequestModal').modal('show');
        });

        $(document).on('click', '#rejectRefund', function () {
            Swal.fire({
                title: 'Reject Refund?',
                text: 'This will reject the refund request.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    return rejectApproveRefund($(this).attr('data-id'), 'reject');
                },
            }).then((oResponse) => {
                oLibraries.displayAlertMessage((oResponse.value.bResult === true) ? 'success' : 'error', oResponse.value.sMsg);
                fetchRefundRequests();
                $('.modal').modal('hide');
            })
        });

        $(document).on('click', '#approveRefund', function () {
            Swal.fire({
                title: 'Approve Refund?',
                text: 'This will approve the refund request.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    return rejectApproveRefund($(this).attr('data-id'), 'approve');
                },
            }).then((oResponse) => {
                oLibraries.displayAlertMessage((oResponse.value.bResult === true) ? 'success' : 'error', oResponse.value.sMsg);
                fetchRefundRequests();
                $('.modal').modal('hide');
            })
        });

    }

    function rejectApproveRefund(iRefundId, sAction) {
        return axios.post(`/Nexus/utils/ajax.php?class=Refunds&action=${sAction}Refund`, { iRefundId })
            .then(function (oResponse) {
                return oResponse.data;
            })
            .catch(function (oError) {
                return oError;
            });
    }

    function fetchRefundRequests() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Refunds&action=fetchAllRefundRequests`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aRefunds = oResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [3] }
                ];

                const aData = aRefunds.filter(oData => oData.refundStatus == 'Not Yet Approved');

                loadTable(oTblRefunds.attr('id'), aData, oColumns.aStudents, aColumnDefs);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchTrainingDataOfSelectedStudentWithRefundRequest(iStudentId) {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchTrainingDataOfSelectedStudentWithRefunds`,
            type: 'POST',
            data: { iStudentId },
            dataType: 'json',
            success: function (oResponse) {
                aTrainingDetails = oResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [1, 2, 3] }
                ];

                const aData = aTrainingDetails.filter(oData => oData.refundStatus == 'Not Yet Approved');

                loadTable(oTblTrainingDetails.attr('id'), aData, oColumns.aTrainingDetails, aColumnDefs);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function prepareStudentDetails(iTrainingId) {
        const oDetails = aTrainingDetails.filter(oTrainingDetails => oTrainingDetails.trainingId == iTrainingId)[0];
        $('.viewRequestModal').find('#studentName').val(oDetails.studentName);
        $('.viewRequestModal').find('#email').val(oDetails.email);
        $('.viewRequestModal').find('#contactNum').val(oDetails.contactNum);
    }

    function loadRefundDetailsTable(iTrainingId) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Refunds&action=fetchRefundDetails',
            type: 'POST',
            data: { trainingId: iTrainingId },
            dataType: 'json',
            async: 'false',
            success: function (aResponse) {
                aRefundDetails = aResponse;

                let aColumnDefs = [
                    { orderable: false, targets: [1, 2, 3] }
                ];

                loadTable(oTblPaymentDetails.attr('id'), aRefundDetails, oColumns.aRequestDetails, aColumnDefs, false);
            },
        });
    }

    function loadTable(sTableName, aData, aColumns, aColumnDefs, bSearching = true) {
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
            columnDefs: aColumnDefs
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oRefundRequests.initialize();
});

