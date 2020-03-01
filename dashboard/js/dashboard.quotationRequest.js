var oQuotationRequests = (() => {

    let oTblSenders  = $('#quotationSenders');
    let oTblRequests = $('#quotationRequests');
    let oTblDetails  = $('#quotationDetails');

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
                    `<button class="btn btn-primary btn-sm" data-toggle="modal" id="viewDetails" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}" data-date-requested="${oRow.dateRequested}">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button class="btn btn-success btn-sm" data-toggle="modal" id="approveRequest" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}" data-date-requested="${oRow.dateRequested}">
                        <i class="fa fa-check"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteRequest" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}" data-date-requested="${oRow.dateRequested}">
                        <i class="fa fa-trash"></i>
                    </button>`
            },
        ],
        aDetails : [
            {
                title: 'Course Name', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.courseName === '') ? ' - ' : oRow.courseName
            },
            {
                title: 'Course Description', className: 'text-center',render: (aData, oType, oRow) =>
                    (oRow.courseDescription === '') ? ' - ' : oRow.courseDescription
            },
            {
                title: 'Exam Code', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.examCode === '') ? ' - ' : oRow.examCode
            },
            {
                title: 'Training Date', className: 'text-center', render: (aData, oType, oRow) =>
                    [oRow.fromDate, oRow.toDate].join(' - ')
            }
        ]
    };

    function init() {
        populateSendersTable();
        setEvents();
    }

    function setEvents() {
        $(document).on('click', '#viewRequest', function() {
            let oDetails = {
                iSenderId      : $(this).attr('data-sender-id'),
                iUserId        : $(this).attr('data-user-id')
            }

            populateRequestsTable(oDetails);

            $('#viewRequestModal').modal('show');
        });

        $(document).on('click', '#viewDetails', function() {
            let oDetails = {
                iSenderId      : $(this).attr('data-sender-id'),
                iUserId        : $(this).attr('data-user-id'),
                sDateRequested : $(this).attr('data-date-requested')  
            }

            populateDetailsTable(oDetails);

            $('#viewDetailsModal').modal('show');
        });

        // Allow only alphabetical characters and a period on first, middle, and last name via RegExp.
        $(document).on('keyup keydown', '#registrationFname, #registrationMname, #registrationLname, #quoteFname, #quoteMname, #quoteLname, #emailFname, #emailMname, #emailLname', function () {
            // Input must not start by a period.
            if (this.value.length === 1 && this.value.match(/[^a-zA-Z]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^a-zA-Z\s\.]/g, '');
        });
    }

    function populateSendersTable() {
        let oAjax = {
            url      : `../utils/ajax.php?class=Quotations&action=fetchSenders`,
            type     : 'GET',
            dataType : 'JSON',
            dataSrc  : function(oJson) {
                return oJson.aData;
            },
            async    : false
        };

        let aColumnDefs = [
            { orderable : false, targets : [1, 2, 3] }
        ];

        loadTable(oTblSenders.attr('id'), oAjax, oColumns.aSender, aColumnDefs);
    }

    function populateRequestsTable(oData) {
        let oAjax = {
            url      : `../utils/ajax.php?class=Quotations&action=fetchRequests`,
            type     : 'POST',
            data     : oData,
            dataSrc  : (oJson) => {
                return oJson;
            },
            async    : false
        };

        let aColumnDefs = [
            { orderable : false, targets : [1, 2, 3, 4] }
        ];

        loadTable(oTblRequests.attr('id'), oAjax, oColumns.aRequest, aColumnDefs);
    }

    function populateDetailsTable(oData) {
        let oAjax = {
            url      : `../utils/ajax.php?class=Quotations&action=fetchDetails`,
            type     : 'POST',
            data     : oData,
            dataSrc  : (oJson) => {
                return oJson;
            },
            async    : false
        };

        let aColumnDefs = [
            { orderable : false, targets : '_all' }
        ];

        loadTable(oTblDetails.attr('id'), oAjax, oColumns.aDetails, aColumnDefs);
    }

    function loadTable(sTableName, oData, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy      : true,
            deferRender  : true,
            ajax         : oData,
            responsive   : true,
            pagingType   : 'first_last_numbers',
            pageLength   : 5,
            ordering     : true,
            searching    : true,
            lengthChange : true,
            lengthMenu   : [ [5, 10, 15, 20, 25, 30, -1], [5, 10, 15, 20, 25, 30, "All"] ],
            info         : true,
            columns      : aColumns,
            columnDefs   : aColumnDefs
        });
    }

    return {
        initialize: init
    }

})();

$(() => {
    oQuotationRequests.initialize();
});