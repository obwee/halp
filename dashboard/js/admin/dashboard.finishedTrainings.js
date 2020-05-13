var oFinishedTrainings = (() => {
    let oTblClassList = $('#tbl_finishedTrainings');
    let oTblStudentList = $('#tbl_studentList');
    let aTrainings = [];
    let aStudentList = [];
    let aPaymentModes = [];

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
            // {
            //     title: 'Payment Date', data: 'paymentDate', className: 'text-center'
            // },
            {
                title: 'Payment Amount', className: 'text-center', render: (aData, oType, oRow) =>
                    `P${oLibraries.formatCurrency(oRow.paymentAmount)}`
            },
            {
                title: 'Balance', className: 'text-center sum', render: (aData, oType, oRow) =>
                    `P${oLibraries.formatCurrency(oRow.balance)}`
            },
            {
                title: 'Credits', className: 'text-center sum', render: (aData, oType, oRow) =>
                    `P${oLibraries.formatCurrency(oRow.credits)}`
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) => {
                    if (oRow.balance !== 0) {
                        return `<button class="btn btn-success btn-sm" data-toggle="modal" id="clearBalance" data-id="${oRow.studentId}">
                                    <i class="fa fa-credit-card"></i>
                                </button>`;
                    }
                    if (oRow.credits !== 0) {
                        return `<button class="btn btn-success btn-sm" data-toggle="modal" id="clearChange" data-id="${oRow.trainingId}">
                                    <i class="fa fa-hand-holding-usd"></i>
                                </button>`;
                    }
                    return '-';
                }
            }
        ]
    };

    function init() {
        fetchFinishedTrainings();
        fetchPaymentMethods();
        setEvents();
    }

    function setEvents() {

        oForms.preparePaymentEvents();

        $(document).on('click', '#viewDetails', function () {
            const iScheduleId = $(this).attr('data-id');
            fetchStudentList(iScheduleId);
            prepareClassDetails(iScheduleId);
            $('#viewClassList').modal('show');
        });

        $(document).on('click', '#clearBalance', function () {
            const iStudentId = $(this).attr('data-id');
            const oStudentDetails = aStudentList.filter(oDetails => oDetails.studentId == iStudentId)[0];

            $('#clearBalanceModal').find('.paymentAmount').val(oStudentDetails.balance);
            $('#clearBalanceModal').find('.oldBalance').val(oStudentDetails.balance);
            $('#clearBalanceModal').find('.newBalance').val(0);
            $('#clearBalanceModal').modal('show');
        });

        $(document).on('click', '#clearChange', function () {
            Swal.fire({
                title: 'Clear existing change?',
                text: 'This will clear the change of the enrollee.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    const iTrainingId = $(this).attr('data-id');

                    axios.post('/Nexus/utils/ajax.php?class=Payment&action=clearChange', { trainingId: iTrainingId })
                        .then(function (oResponse) {
                            oLibraries.displayAlertMessage((oResponse.data.bResult === true) ? 'success' : 'error', oResponse.data.sMsg);
                            fetchFinishedTrainings();
                            $('.modal').modal('hide');
                        });
                }
            });
        });
    }

    function fetchPaymentMethods() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Payment&action=fetchModeOfPayments`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aPaymentModes = oResponse.filter(oMode => oMode.status === 'Active');
                populateModeOfPayments();
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    // Populate the payment mode dropdown select.
    function populateModeOfPayments() {
        let oPaymentModeDropdown = $('.modeOfPayment');
        oPaymentModeDropdown.empty().append($('<option value="" selected disabled hidden>Select Mode of Payment</option>'));

        $.each(aPaymentModes, function (iKey, oMode) {
            oPaymentModeDropdown.append($('<option />').val(oMode.id).text(`${oMode.methodName}`));
        });
    }

    function prepareClassDetails(iScheduleId) {
        const oClassDetails = aTrainings.filter(oList => oList.scheduleId == iScheduleId)[0];

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

    // Fix bug on multiple modals.
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