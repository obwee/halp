var oFinishedTrainings = (() => {

    let oTblTrainings = $('#tbl_trainings');

    let aReservations = [];

    let oColumns = [
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
            title: 'Instructor', className: 'text-center', data: 'instructorName'
        }
    ];

    function init() {
        fetchFinishedTrainings();
    }

    function fetchFinishedTrainings() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Student&action=fetchFinishedTrainings`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aReservations = oResponse;

                const aColumnDefs = [
                    // { orderable: false, targets: [3, 4, 5] }
                ];
                const aOrder = [[1, 'asc']];

                loadTable(oTblTrainings.attr('id'), aReservations, oColumns, aColumnDefs, aOrder);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function loadTable(sTableName, aData, aColumns, aColumnDefs, aOrder, bSearching = true, oFooterCallback = () => { }) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
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
        });
    }

    return {
        initialize: init
    }

})();

$(() => {
    oFinishedTrainings.initialize();
});
