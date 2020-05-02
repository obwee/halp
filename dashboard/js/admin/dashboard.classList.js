var oClassList = (() => {
    let oTblClassList = $('#tbl_classList');
    let oTblStudentList = $('#tbl_studentList');
    let aClassLists = [];
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
        ]
    };

    function init() {
        fetchClassLists();
        setEvents();
    }

    function setEvents() {
        $(document).on('click', '#viewDetails', function () {
            fetchStudentList($(this).attr('data-id'));
        });
    }

    function fetchStudentList(iScheduleId) {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Student&action=fetchStudentList`,
            type: 'POST',
            data: { iScheduleId: iScheduleId },
            dataSrc: (oJson) => {
                aClassLists = oJson;
                return aClassLists;
            },
            async: false
        };

        let aColumnDefs = [
            { orderable: false, targets: '_all' }
        ];

        loadTable(oTblStudentList.attr('id'), oAjax, oColumns.aClassList, aColumnDefs);
    }

    function fetchClassLists(oData) {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Training&action=fetchClassLists`,
            type: 'POST',
            data: oData,
            dataSrc: (oJson) => {
                aStudentList = oJson;
                return aStudentList;
            },
            async: false
        };

        let aOrder = [[1, 'asc']];
        
        let aColumnDefs = [
            { orderable: false, targets: [2, 3, 4, 5] }
        ];

        loadTable(oTblClassList.attr('id'), oAjax, oColumns.aClassList, aColumnDefs, aOrder);
    }

    function loadTable(sTableName, oData, aColumns, aColumnDefs, aOrder = []) {
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
            columnDefs: aColumnDefs
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oClassList.initialize();
});

