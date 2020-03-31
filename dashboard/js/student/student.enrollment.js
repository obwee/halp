var oEnrollment = (() => {

    let oTblEnrollment = $('#tbl_enrollment');

    let aEnrolledCourses = [];

    let aCoursesAvailable = [];

    let oColumns = {
        aCourses: [
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Schedule', className: 'text-center', render: (aData, oType, oRow) =>
                    oRow.fromDate + ' - ' + oRow.toDate
            },
            {
                title: 'Venue', className: 'text-center', data: 'venue'
            },
            {
                title: 'Instructor', className: 'text-center', data: 'instructorName'
            },
            {
                title: 'Amount', className: 'text-center', render: (aData, oType, oRow) =>
                    'P' + parseInt(oRow.coursePrice, 10).toLocaleString()
            },
            {
                title: 'Status', className: 'text-center', data: 'paymentStatus'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-success btn-sm" data-toggle="modal" id="payEnrolledSchedule" data-id="${oRow.trainingId}">
                        <i class="fa fa-hand-holding-usd"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" id="printRegiForm" data-id="${oRow.trainingId}">
                        <i class="fa fa-print"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteEnrolledSchedule" data-id="${oRow.trainingId}">
                        <i class="fa fa-trash-alt"></i>
                    </button>`
            },
        ]
    };

    function init() {
        fetchCourses();
        setEvents();
    }

    function setEvents() {
        $(document).on('click', '#payEnrolledSchedule', function() {
            $('#paymentModal').modal('show');
        });
    }

    function fetchCourses() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Courses&action=fetchCoursesToEnroll`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aEnrolledCourses = oResponse.aEnrolledCourses;
                aCoursesAvailable = oResponse.aCoursesAvailable;
                populateEnrollmentTable();
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function populateEnrollmentTable() {
        let aColumnDefs = [
            { orderable: false, targets: [2, 3, 4] }
        ];

        loadTable(oTblEnrollment.attr('id'), oColumns.aCourses, aColumnDefs);
    }

    function loadTable(sTableName, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy: true,
            deferRender: true,
            data: aEnrolledCourses,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            order: [[1, 'asc']],
            searching: true,
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

$(() => {
    oEnrollment.initialize();
});
