var oSalesReport = (() => {

    let oColumns = {
        aClassList: [
            {
                title: 'Payment Date', data: 'paymentDate', className: 'text-center'
            },
            {
                title: 'Student Name', data: 'studentName', className: 'text-center'
            },
            {
                title: 'Course Code', data: 'courseCode', className: 'text-center'
            },
            {
                title: 'Schedule', data: 'schedule', className: 'text-center'
            },
            {
                title: 'Venue', data: 'venue', className: 'text-center'
            },
            {
                title: 'Course Price', data: 'coursePrice', className: 'text-center sum'
            },
            {
                title: 'Payment Amount', data: 'paymentAmount', className: 'text-center sum'
            },
            {
                title: 'Payment Status', data: 'paymentStatus', className: 'text-center'
            }
        ]
    };

    let oTblSalesReport = $('#tbl_salesReport');
    let oScheduleDropdown = $('.scheduleDropdown');
    let oCourseDropdown = $('.courseDropdown');
    let oDateFilters = $('.dateFilter').find('input');
    let aSalesReport = [];
    let aCoursesAndSchedules = [];
    let aPaymentModes = [];
    let aVenues = [];

    function init() {
        setEvents();
        fetchSalesReport();
        fetchCoursesAndSchedules();
        fetchPaymentMethods();
        fetchVenues();
    }

    function setEvents() {
        $(document).on('change', '.courseDropdown', function () {
            populateScheduleDropdown($(this).val());
        });

        $(document).on('change', '.scheduleDropdown', () => {
            toggleDateFilter('disable');
        });

        $(document).on('change', '.fromDate, .toDate', () => {
            toggleScheduleDropdownFilter('disable');
        });

        $(document).on('click', '#clearSelection', function () {
            toggleDateFilter('enable');
            toggleScheduleDropdownFilter('enable');
            $(this).closest('form')[0].reset();
            oScheduleDropdown.empty().append('<option selected disabled hidden>Select Schedule</option>');
            fetchSalesReport();
        });

        $(document).on('click', '#loadClassList', function () {
            const sFormId = `#${$(this).closest('form').attr('id')}`;

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oFormProps = {
                'validationMethod': oValidations.validateSalesReportFilters(),
                'requestClass': 'Reports',
                'requestAction': 'fetchFilteredSalesReport'
            };

            const oValidation = oFormProps.validationMethod;

            if (oValidation.result === false) {
                oLibraries.displayErrorMessage(sFormId, oValidation.msg, oValidation.element, false);
                return false;
            }
            fetchFilteredSalesReport(sFormId);
        });
    }

    function toggleDateFilter(sAction) {
        const oToggles = {
            'enable': false,
            'disable': true
        };

        oDateFilters.attr('disabled', oToggles[sAction]);
    }

    function toggleScheduleDropdownFilter(sAction) {
        const oToggles = {
            'enable': false,
            'disable': true
        };

        oScheduleDropdown.attr('disabled', oToggles[sAction]);
    }

    function populateCourseDropdown(aData) {
        oCourseDropdown.empty().append($('<option selected disabled hidden>Select Course</option>'));

        $.each(aData, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    function populateScheduleDropdown(iCourseId) {
        let oFilteredCourse = aCoursesAndSchedules.filter(oCourse => oCourse.courseId == iCourseId)[0];
        oScheduleDropdown.empty().append($('<option selected disabled hidden>Select Schedule</option>'));

        $.each((oFilteredCourse.schedule ?? oFilteredCourse.schedules), function (iScheduleId, sScheduleDate) {
            oScheduleDropdown.append($('<option />').val(iScheduleId).text(sScheduleDate));
        });
    }

    function populateVenues() {
        $('.venueDropdown').empty().append($('<option selected disabled hidden>Select Venue</option>'));

        $.each(aVenues, function (iKey, aData) {
            $('.venueDropdown').append($('<option />').val(aData.id).text(aData.venue));
        });
    }

    function fetchCoursesAndSchedules() {
        // Execute AJAX request.
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Forms&action=fetchCoursesAndSchedulesForReports',
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aCoursesAndSchedules = oResponse;
                populateCourseDropdown(aCoursesAndSchedules);
            }
        });
    }

    function fetchPaymentMethods() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Payment&action=fetchModeOfPayments`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aPaymentModes = oResponse.filter(oMode => oMode.status === 'Active');
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchVenues() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Venue&action=fetchVenues`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aVenues = oResponse.filter(oVenue => oVenue.status === 'Active');
                populateVenues();
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function fetchSalesReport() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Reports&action=fetchSalesReport`,
            type: 'GET',
            dataType: 'json',
            success: (oJson) => {
                aSalesReport = oJson;
                loadSalesReport(aSalesReport);
            }
        });
    }

    function fetchFilteredSalesReport(sFormId) {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Reports&action=fetchFilteredSalesReport`,
            type: 'POST',
            data: new FormData($(sFormId)[0]),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (oResponse) {
                if (oResponse.bResult === false) {
                    oLibraries.displayErrorMessage(sFormId, oResponse.sMsg, oResponse.sElement, false);
                    return false;
                }
                aSalesReport = oResponse.aSalesReport;
                loadSalesReport(aSalesReport);
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    function loadSalesReport(aData) {
        console.log(aData)
        let aOrder = [[0, 'asc']];

        let aColumnDefs = [
            { orderable: false, targets: [2, 3, 4, 5] }
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

        loadTable(oTblSalesReport.attr('id'), aData, oColumns.aClassList, aColumnDefs, aOrder, oFooterCallback);
    }

    function loadTable(sTableName, oData, aColumns, aColumnDefs, aOrder, oFooterCallback = () => { }) {
        $(`#${sTableName} > tbody`).empty().parent().dataTable({
            destroy: true,
            deferRender: true,
            data: oData,
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
    oSalesReport.initialize();
});

