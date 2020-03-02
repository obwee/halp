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
                    <button class="btn btn-warning btn-sm" data-toggle="modal" id="editRequest" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}" data-date-requested="${oRow.dateRequested}">
                        <i class="fa fa-pencil-alt"></i>
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
        fetchCoursesAndSchedules();
        setEvents();
    }

    function setEvents() {
        oForms.prepareDomEvents();
        
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

        $(document).on('click', '#editRequest', function() {
            let oDetails = {
                iSenderId      : $(this).attr('data-sender-id'),
                iUserId        : $(this).attr('data-user-id'),
                sDateRequested : $(this).attr('data-date-requested')  
            };

            // Execute AJAX request.
            $.ajax({
                url: `../utils/ajax.php?class=Quotations&action=editQuotation`,
                type: 'POST',
                data: oDetails,
                dataType: 'JSON',
                success: (oResponse) => {
                    // $('#editRequestModal').modal('show');
                }
            });

            $('#editRequestModal').modal('show');

        });
        
        $(document).on('change', '.quoteCourse', function () {
            let oModal = {
                'getQuoteModal'         : '',
                'insertNewRequestModal' : '-new'
            };

            let sSuffix = oModal[$(this).closest('.modal').attr('id')];
            
            populateCourseSchedule($(this).val());
        });

        $(document).on('click', '.addCourseBtn', function () {
            let oModal = {
                'getQuoteModal'         : '',
                'insertNewRequestModal' : '-new'
            };

            let sSuffix = oModal[$(this).closest('.modal').attr('id')];
            
            let oCourseDiv = $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last();

            if (oCourseDiv.find('select.quoteCourse').val() === null) {
                return oLibraries.displayAlertMessage('error', 'Please select a course first.');
            }

            aFilteredCoursesAndSchedules = aFilteredCoursesAndSchedules.filter(function (aCourse) {
                return aCourse.courseId != oCourseDiv.find('select.quoteCourse').val();
            });

            oCourseDiv.find('.quoteCourse').attr('disabled', true);
            oCourseDiv.find('.quoteSchedule').attr('disabled', true);
            
            populateCourseDropdown(aFilteredCoursesAndSchedules, sSuffix);

            if ($(`.courseAndScheduleDiv${sSuffix}`).filter(':hidden').length === 0) {
                $('.addCourseBtn').parent().css('display', 'none');
                $('.deleteCourseBtn').parent().attr('class', 'col-sm-12 text-center');
            } else {
                $('.addCourseBtn').parent().attr('class', 'col-sm-6 text-right').css('display', 'block');
                $('.deleteCourseBtn').parent().attr('class', 'col-sm-6 text-left').css('display', 'block');
            }
        });

        $(document).on('click', '.deleteCourseBtn', function () {

            let oModal = {
                'getQuoteModal'         : '',
                'insertNewRequestModal' : '-new'
            };

            let sSuffix = oModal[$(this).closest('.modal').attr('id')];
            let oCourseAndScheduleDiv = $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last();

            // Reset schedule select option.
            oCourseAndScheduleDiv
                .find('.quoteSchedule')
                .empty()
                .attr('disabled', true)
                .append($('<option value="" selected disabled hidden>Select Course First</option>'))
                .find('option:eq(0)')
                .prop('selected', true);

            oCourseAndScheduleDiv.css('display', 'none');
            oCourseAndScheduleDiv.prev().find('.quoteSchedule').attr('disabled', false);
            oCourseAndScheduleDiv.prev().find('.quoteCourse').attr('disabled', false);

            let oCourseDiv = $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').find('.quoteCourse');

            aFilteredCoursesAndSchedules.push(aCoursesAndSchedules.filter(function (aCourse) {
                return aCourse.courseId == oCourseDiv.last().val();
            })[0]);

            populateCourseSchedule(oCourseDiv.last().val(), true, sSuffix);

            if (oCourseDiv.parent().parent().length === 1) {
                $('.addCourseBtn').parent().attr('class', 'col-sm-12 text-center');
                $('.deleteCourseBtn').parent().css('display', 'none');
            } else {
                $('.addCourseBtn').parent().attr('class', 'col-sm-6 text-right').css('display', 'block');
                $('.deleteCourseBtn').parent().attr('class', 'col-sm-6 text-left').css('display', 'block');
            }
        });

        // Reset inputs before opening any modal.
        $(document).on('click', 'a[data-toggle="modal"]', function () {
            let modalId = $(this).attr('data-target');
            let formName = '#' + $(modalId).find('form').attr('id') + '';
            oForms.resetInputBorders(formName);
            $(formName)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $('#getQuoteModal, #viewDetailsModal').on('hidden.bs.modal', function (e) {
            let oModal = {
                'getQuoteModal'         : '',
                'insertNewRequestModal' : '-new'
            };

            let sSuffix = oModal[$(this).attr('id')];

            $(`.courseAndScheduleDiv${sSuffix}:not(:first)`).remove();
            $(`.courseAndScheduleDiv${sSuffix}:first`).find('select.quoteCourse').attr('disabled', false).find('option:eq(0)').prop('selected', true);
            $(`.courseAndScheduleDiv${sSuffix}:first`).find('select.quoteSchedule').attr('disabled', true).find('option:eq(0)').prop('selected', true);
            $(`.courseAndScheduleDiv${sSuffix}:first`).find('input.numPax').val(1);
            aFilteredCoursesAndSchedules = aCoursesAndSchedules;
            oForms.cloneDivElements(aCoursesAndSchedules.length);
            $('.addCourseBtn').parent().attr('class', 'col-sm-12 text-center').css('display', 'block');
            $('.deleteCourseBtn').parent().css('display', 'none');
        });

        // Function for submission of any form.
        $(document).on('submit', 'form', function (event) {
            event.preventDefault();

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            let oInputForms = {
                '#quotationForm': {
                    'validationMethod': oValidations.validateQuoteInputs(),
                    'requestClass': 'Quotations',
                    'requestAction': 'requestQuotation'
                },
                '#insertNewRequestForm': {
                    'validationMethod': oValidations.validateNewQuoteRequestInputs(),
                    'requestClass': 'Quotations',
                    'requestAction': 'addNewQuotation'
                },
                '#insertNewRequestForm': {
                    'validationMethod': oValidations.validateNewQuoteRequestInputs(),
                    'requestClass': 'Quotations',
                    'requestAction': 'addNewQuotation'
                }
            }

            // Get the form name being submitted.
            let formName = '#' + $(this).attr('id') + '';

            oForms.disableFormState(formName, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(formName);

            // Validate the inputs of the submitted form and store the result inside validateInputs variable.
            let validateInputs = oInputForms[formName].validationMethod;

            // Get the request class of the form submitted.
            let requestClass = oInputForms[formName].requestClass;

            // Get the request action of the form submitted.
            let requestAction = oInputForms[formName].requestAction;

            // Check if input validation result is true.
            if (validateInputs.result === true) {
                // Extract form data.
                let formData = $(formName).serializeArray();

                if (formName === '#quotationForm') {
                    let aSelectedCourses = [];
                    let aSelectedSchedules = [];
                    let aSelectedNumPax = [];

                    // Get courses.
                    $('select[name="quoteCourse[]"]:visible').each(function () {
                        aSelectedCourses.push($(this).val());
                    });

                    // Get schedules.
                    $('select[name="quoteSchedule[]"]:visible').each(function () {
                        aSelectedSchedules.push($(this).val());
                    });

                    // Get numpax.
                    $('input[name="numPax[]"]:visible').each(function () {
                        aSelectedNumPax.push($(this).val());
                    });

                    // Remove unnecessary data to be sent in AJAX request.
                    formData = formData.filter(function (sFormKey) {
                        return sFormKey.name != 'quoteCourse[]' && sFormKey.name != 'quoteSchedule[]' && sFormKey.value !== '';
                    });

                    formData.push({ 'name': 'quoteCourses', 'value': aSelectedCourses });
                    formData.push({ 'name': 'quoteSchedules', 'value': aSelectedSchedules });
                    formData.push({ 'name': 'quoteNumPax', 'value': aSelectedNumPax });
                }

                // Execute AJAX request.
                $.ajax({
                    url: `../utils/ajax.php?class=${requestClass}&action=${requestAction}`,
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.result === true) {
                            $(formName).parents().find('div.modal').modal('hide');
                            populateSendersTable();
                            oLibraries.displayAlertMessage('success', response.msg);
                        } else {
                            oLibraries.displayErrorMessage(formName, response.msg, response.element);
                        }
                    },
                    error: function () {
                        oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
                    }
                });
            } else { // This means that there's an error while validating inputs.
                oLibraries.displayErrorMessage(formName, validateInputs.msg, validateInputs.element);
            }
            oForms.disableFormState(formName, false);
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
            pageLength   : 4,
            ordering     : true,
            searching    : true,
            lengthChange : true,
            lengthMenu   : [ [4, 8, 12, 16, 20, 24, -1], [4, 8, 12, 16, 20, 24, 'All'] ],
            info         : true,
            columns      : aColumns,
            columnDefs   : aColumnDefs
        });
    }

    // Populate the course dropdown select.
    function populateCourseDropdown(aCourses, sSuffix = '') {
        let oCourseDropdown = $(`.courseAndScheduleDiv${sSuffix}[style*="display: none"]`).first().find('.quoteCourse');
        oCourseDropdown.parent().parent().css('display', 'block');
        oCourseDropdown.empty().append($('<option value="" selected disabled hidden>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(oCourse.courseName));
        });
    }

    // Populate the schedule dropdown select.
    function populateCourseSchedule(iCourseId, bIsDeletePressed = false, sSuffix = '') {
        let oSchedule = $(`.courseAndScheduleDiv[style*="display: block"]`).last().find('.quoteSchedule');
        let iSelectedScheduleId = oSchedule.find('option:selected').val();

        let oFilteredCourse = aFilteredCoursesAndSchedules.filter(function (aCourse) {
            return aCourse.courseId == iCourseId;
        })[0];

        let aSchedules = oFilteredCourse.schedule;

        oSchedule
            .empty()
            .attr('disabled', false)
            .append($('<option value="" selected disabled hidden>Select Schedule</option>'));

        $.each(aSchedules, function (iKey, sSchedule) {
            oSchedule.append($('<option />').val(oFilteredCourse.scheduleId).text(sSchedule));
        });

        if (bIsDeletePressed === true) {
            oSchedule.val(iSelectedScheduleId);
        } else {
            oSchedule.find('option:eq(0)').prop('selected', true)
        }
    }

    /**
     * fetchCoursesAndSchedules
     */
    function fetchCoursesAndSchedules() {
        // Execute AJAX request.
        $.ajax({
            url: '../utils/ajax.php?class=Forms&action=fetchHomepageData',
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aCoursesAndSchedules = oResponse;
                aFilteredCoursesAndSchedules = oResponse;
                oForms.cloneDivElements(oResponse.length);
                populateCourseDropdown(oResponse);
                populateCourseDropdown(oResponse, '-new');
            }
        });
    }

    return {
        initialize: init
    }

})();

$(() => {
    oQuotationRequests.initialize();
});