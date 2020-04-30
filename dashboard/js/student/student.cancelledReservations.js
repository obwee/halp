var oCancelledReservations = (() => {

    let oTblCancelledReservations = $('#tbl_cancelledReservations');

    let oColumns = {
        aCourses: [
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Schedule', className: 'text-center', data: 'schedule'
            },
            {
                title: 'Amount', className: 'text-center', data: 'coursePrice'
            },
            {
                title: 'Venue', className: 'text-center', data: 'venue'
            },
            {
                title: 'Instructor', className: 'text-center', data: 'instructorName'
            },
            {
                title: 'Reason', className: 'text-center', data: 'cancellationReason'
            }
        ]
    };

    let sFilter = '';

    function init() {
        checkUrlParams();
        fetchCancelledReservations();
    }

    function checkUrlParams() {
        const oSearchParams = new URLSearchParams(window.location.search);
        if (oSearchParams.has('courseName') === true) {
            sFilter = oSearchParams.get('courseName');
        }
    }

    function fetchCancelledReservations() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchCancelledReservations`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                const aColumnDefs = [
                    { orderable: false, targets: [3, 4, 5] }
                ];
                const aOrder = [[1, 'asc']];

                loadTable(oTblCancelledReservations.attr('id'), oResponse, oColumns.aCourses, aColumnDefs, aOrder);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function loadTable(sTableName, aData, aColumns, aColumnDefs, aOrder, bSearching = true, oFooterCallback = () => { }) {
        $(`#${sTableName} > tbody`).empty().parent().dataTable({
            destroy: true,
            deferRender: true,
            data: aData,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            order: aOrder,
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

$(() => {
    oCancelledReservations.initialize();
});
