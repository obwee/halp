var oSentQuotations = (() => {

    let oTblSenders = $('#quotationSenders');
    let oTblRequests = $('#quotationRequests');
    let oTblDetails = $('#quotationDetails');
    
    let oColumns = {
        aSender: [
            {
                title: 'Sender Name', render: (aData, oType, oRow) =>
                    [oRow.firstName, oRow.middleName, oRow.lastName].join(' ')
            },
            {
                title: 'Email Address', data: 'email'
            },
            {
                title: 'Contact Number', data: 'contactNum'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="viewRequest" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}">
                        <i class="fa fa-eye"></i>
                    </button>`
            },
        ],
        aRequest: [
            {
                title: 'Date Requested', className: 'text-center', data: 'fullDate'
            },
            {
                title: 'Number of Courses', className: 'text-center', data: 'numberOfCourses'
            },
            {
                title: 'Company Name', className: 'text-center', render: (oData, oType, oRow) =>
                    (oRow.companyName === '') ? '-' : oRow.companyName
            },
            {
                title: 'Bill to Company', className: 'text-center', render: (oData, oType, oRow) =>
                    (oRow.companyName === '') ? '-' : oRow.isCompanySponsored
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-primary btn-sm viewDetails" data-toggle="modal" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}" data-date-requested="${oRow.dateRequested}">
                        <i class="fa fa-eye"></i>
                    </button>`
            },
        ],
        aDetails: [
            {
                title: 'Course Name', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.courseName === '') ? ' - ' : oRow.courseName
            },
            {
                title: 'Course Description', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.courseDescription === '') ? ' - ' : oRow.courseDescription
            },
            {
                title: 'Exam Code', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.courseCode === '') ? ' - ' : oRow.courseCode
            },
            {
                title: 'Training Date', className: 'text-center', render: (aData, oType, oRow) =>
                    [oRow.fromDate, oRow.toDate].join(' - ')
            },
            {
                title: 'Number of Persons', className: 'text-center', data: 'numPax'
            }
        ]
    };

    function init() {
        populateSendersTable();
        // fetchCoursesAndSchedules();
        setEvents();
    }

    function setEvents() {
        $(document).on('click', '#viewRequest', function () {
            let oDetails = {
                iSenderId: $(this).attr('data-sender-id'),
                iUserId: $(this).attr('data-user-id')
            }

            populateRequestsTable(oDetails);

            // aSenderDetails = aSenders.filter(function (aSender) {
            //     return aSender.senderId == oDetails.iSenderId && aSender.userId == oDetails.iUserId;
            // });

            $('#viewRequestModal').modal('show');
        });

        $(document).on('click', '.viewDetails', function () {
            let oDetails = {
                iSenderId: $(this).attr('data-sender-id'),
                iUserId: $(this).attr('data-user-id'),
                sDateRequested: $(this).attr('data-date-requested')
            }

            populateDetailsTable(oDetails);

            $('#viewDetailsModal').modal('show');
        });
    }

    function populateSendersTable() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Quotations&action=fetchSenders`,
            type: 'POST',
            data: { iIsQuotationSent: 1 },
            dataType: 'JSON',
            dataSrc: function (oJson) {
                aSenders = oJson.aData;
                return aSenders;
            },
            async: false
        };

        let aColumnDefs = [
            { orderable: false, targets: [1, 2, 3] }
        ];

        loadTable(oTblSenders.attr('id'), oAjax, oColumns.aSender, aColumnDefs);
    }

    function populateRequestsTable(oData) {
        oData.iIsQuotationSent = 1;
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Quotations&action=fetchRequests`,
            type: 'POST',
            data: oData,
            dataSrc: (oJson) => {
                return oJson;
            },
            async: false
        };

        let aColumnDefs = [
            { orderable: false, targets: [1, 2, 3, 4] }
        ];

        loadTable(oTblRequests.attr('id'), oAjax, oColumns.aRequest, aColumnDefs);
    }

    function populateDetailsTable(oData) {
        oData.iIsQuotationSent = 1;
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Quotations&action=fetchDetails`,
            type: 'POST',
            data: oData,
            dataSrc: (oJson) => {
                return oJson;
            },
            async: false
        };

        let aColumnDefs = [
            { orderable: false, targets: '_all' }
        ];

        loadTable(oTblDetails.attr('id'), oAjax, oColumns.aDetails, aColumnDefs);
    }

    function loadTable(sTableName, oData, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy: true,
            deferRender: true,
            ajax: oData,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
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
    oSentQuotations.initialize();
});