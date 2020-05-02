var oFinishedTrainings = (() => {
    let oTblClassList = $('#tbl_finishedTrainings');
    let oTblStudentList = $('#tbl_studentList');
    let aTrainings = [];
    let aStudentList = [];

    let oColumns = {
        aClassList: [
            {
                title: 'Course Code', data: 'courseCode', className: 'text-center'
            },
            {
                title: 'Schedule', data: 'schedule', className: 'text-center'
            },
            {
                title: 'No. of Students', data: 'numOfStudents', className: 'text-center'
            },
            {
                title: 'Instructor', data: 'instructor', className: 'text-center'
            },
            {
                title: 'Venue', data: 'venue', className: 'text-center'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="viewDetails" data-id="${oRow.scheduleId}">
                        <i class="fa fa-eye"></i>
                    </button>`
            },
        ],
        aStudentList: [
            {
                title: 'Student Name', data: 'studentName', className: 'text-center'
            },
            {
                title: 'E-mail Address', data: 'email', className: 'text-center'
            },
            {
                title: 'Contact Number', data: 'contactNum', className: 'text-center'
            },
            {
                title: 'Payment Date', data: 'paymentDate', className: 'text-center'
            },
            {
                title: 'Payment Amount', data: 'paymentDate', className: 'text-center'
            },
            {
                title: 'Balance', data: 'balance', className: 'text-center sum'
            },
            {
                title: 'Credits', data: 'credits', className: 'text-center sum'
            }
        ]
    };

    function init() {
        fetchFinishedTrainings();
        setEvents();
    }

    function setEvents() {
        $(document).on('click', '#viewDetails', function () {
            const iScheduleId = $(this).attr('data-id');
            fetchStudentList(iScheduleId);
            prepareClassDetails(iScheduleId);
            $('#viewClassList').modal('show');
        });
    }

    function prepareClassDetails(iScheduleId) {
        const oClassDetails = aClassLists.filter(oList => oList.scheduleId == iScheduleId)[0];

        $('#viewClassList').find('#courseName').val(oClassDetails.courseCode);
        $('#viewClassList').find('#schedule').val(oClassDetails.schedule);
        $('#viewClassList').find('#venue').val(oClassDetails.venue);
        $('#viewClassList').find('#instructor').val(oClassDetails.instructor);
    }

    function fetchStudentList(iScheduleId) {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Student&action=fetchStudentList`,
            type: 'POST',
            data: { iScheduleId: iScheduleId },
            dataSrc: (oJson) => {
                aStudentList = oJson;
                return aStudentList;
            },
            async: false
        };

        let aOrder = [[0, 'asc']];

        let aColumnDefs = [
            { orderable: false, targets: '_all' }
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
                let iSum = oApi
                    .cells(null, this.index())
                    .render('display')
                    .reduce((iAccumulator, iCurrentValue) => {
                        return intVal(iAccumulator) + intVal(iCurrentValue);
                    }, 0);

                $(this.footer()).text(`P${iSum.toLocaleString()}`);
            });
        };

        loadTable(oTblStudentList.attr('id'), oAjax, oColumns.aStudentList, aColumnDefs, aOrder, oFooterCallback);
    }

    function fetchFinishedTrainings(oData) {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchFinishedTrainings`,
            type: 'POST',
            data: oData,
            dataSrc: (oJson) => {
                aTrainings = oJson;
                return aTrainings;
            },
            async: false
        };

        let aOrder = [[1, 'asc']];

        let aColumnDefs = [
            { orderable: false, targets: [2, 3, 4, 5] }
        ];

        loadTable(oTblClassList.attr('id'), oAjax, oColumns.aClassList, aColumnDefs, aOrder);
    }

    function loadTable(sTableName, oData, aColumns, aColumnDefs, aOrder, oFooterCallback = () => { }) {
        $(`#${sTableName} > tbody`).empty().parent().dataTable({
            destroy: true,
            deferRender: true,
            ajax: oData,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            order: aOrder,
            searching: true,
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
    oFinishedTrainings.initialize();
});