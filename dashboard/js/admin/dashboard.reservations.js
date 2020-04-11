var oReservations = (() => {

    let oTblReservations = $('#tbl_reservations');

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
                    `<button class="btn btn-success btn-sm" data-toggle="modal" id="viewPayment" data-id="${oRow.trainingId}">
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
                title: 'MOP', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.paymentMethod === null) ? 'N/A' : oRow.paymentMethod
            },
            {
                title: 'Training Fee', className: 'text-center', render: (aData, oType, oRow) =>
                    'P' + parseInt(oRow.coursePrice, 10).toLocaleString(undefined, { minimumFractionDigits: 2 })
            },
            {
                title: 'Amount Paid', className: 'text-center', render: (aData, oType, oRow) =>
                    'P' + parseInt(oRow.paymentAmount, 10).toLocaleString(undefined, { minimumFractionDigits: 2 })
            },
            {
                title: 'Remaining Balance', className: 'text-center', render: (aData, oType, oRow) =>
                    'P' + parseInt(oRow.remainingBalance, 10).toLocaleString(undefined, { minimumFractionDigits: 2 })
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentStatus'
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
        fetchEnrollmentData();
        setEvents();
    }

    function setEvents() {
        $(document).on('click', '#rescheduleEnrollee', function() {
            $('#rescheduleModal').modal('show');
        });
    }


    function fetchEnrollmentData() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Student&action=fetchEnrollmentData`,
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

    function loadTable(sTableName, aData, aColumns, aColumnDefs, bSearching = true) {
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
            columnDefs: aColumnDefs
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oReservations.initialize();
});