var oQuotationRequests = (() => {

    let oTblSenders = $('#quotationSenders');
    let oTblRequests = $('#quotationRequests');
    let oTblDetails = $('#quotationDetails');

    let oTemplate = {};

    let aCoursesAndSchedules = [];
    let aFilteredCoursesAndSchedules = [];
    let aSenders = [];
    let aSenderDetails = [];
    let oEditIds = {};

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
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteSender" data-sender-id="${oRow.senderId}" data-user-id="${oRow.userId}">
                        <i class="fa fa-trash"></i>
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
        fetchCoursesAndSchedules();
        setEvents();
    }

    function setEvents() {
        oForms.prepareDomEvents();

        $(document).on('click', '#deleteRequest', function () {
            Swal.fire({
                title: 'Delete the request?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((bResult) => {
                if (bResult.value === true) {
                    let oDetails = {
                        iSenderId: $(this).attr('data-sender-id'),
                        iUserId: $(this).attr('data-user-id'),
                        sDateRequested: $(this).attr('data-date-requested')
                    };
                    oLibraries.displayAlertMessage('success', deleteRequest(oDetails));
                    delete oDetails.sDateRequested;
                    populateRequestsTable(oDetails);
                }
            });
        });

        $(document).on('click', '#deleteSender', function () {
            Swal.fire({
                title: 'Delete the sender?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((bResult) => {
                if (bResult.value === true) {
                    let oDetails = {
                        iSenderId: $(this).attr('data-sender-id'),
                        iUserId: $(this).attr('data-user-id')
                    };
                    oLibraries.displayAlertMessage('success', deleteSender(oDetails));
                    populateSendersTable();
                }
            });
        });

        $(document).on('click', '#approveRequest', function () {
            let oDetails = {
                iSenderId: $(this).attr('data-sender-id'),
                iUserId: $(this).attr('data-user-id'),
                sDateRequested: $(this).attr('data-date-requested'),
                sFullName: `${aSenderDetails[0]['firstName']} ${aSenderDetails[0]['lastName']}`,
                sEmail: aSenderDetails[0]['email'],
                iContactNum: aSenderDetails[0]['contactNum']
            };

            Swal.fire({
                title: 'Approve the request?',
                text: 'This will send an email to the sender.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return approveQuotation(oDetails);
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((oResponse) => {
                if (oResponse.value.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.value.sMsg);
                    populateSendersTable();
                }
            });
        });

        $(document).on('click', '#viewRequest', function () {
            let oDetails = {
                iSenderId: $(this).attr('data-sender-id'),
                iUserId: $(this).attr('data-user-id')
            }

            populateRequestsTable(oDetails);

            aSenderDetails = aSenders.filter(function (aSender) {
                return aSender.senderId == oDetails.iSenderId && aSender.userId == oDetails.iUserId;
            });

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

        $(document).on('click', '#editRequest', function () {
            let oDetails = {
                iSenderId: $(this).attr('data-sender-id'),
                iUserId: $(this).attr('data-user-id'),
                sDateRequested: $(this).attr('data-date-requested')
            };

            // Execute AJAX request to fetch request details.
            $.ajax({
                url: `/Nexus/utils/ajax.php?class=Quotations&action=editQuotation`,
                type: 'POST',
                data: oDetails,
                dataType: 'JSON',
                success: (oResponse) => {
                    oEditIds = oDetails;
                    $('#editRequestModal').find('.quoteCompanyName').val(oResponse.quoteCompanyName);
                    $('#editRequestModal').find('.quoteBillToCompany').attr('checked', oResponse.isCompanySponsored);
                    cloneDivElementsForEditing(oResponse);
                    showAddDeleteButtons(oResponse.aCourses.length);
                    $('#editRequestModal')
                        .find('.courseAndScheduleDiv-edit')
                        .eq(oResponse.aCourses.length - 1)
                        .find('.quoteCourse')
                        .prop('disabled', false);
                    $('#editRequestModal').modal('show');
                }
            });

        });

        $(document).on('change', '.quoteCourse', function () {
            let oModal = {
                'getQuoteModal': '',
                'insertNewRequestModal': '-new',
                'editRequestModal': '-edit'
            };

            let modalName = $(this).closest('.modal').attr('id');
            let sSuffix = oModal[modalName];

            let oCourseAndScheduleDiv = $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last();

            if (oCourseAndScheduleDiv.find('.quoteCourse').val() !== '') {
                populateCourseSchedule($(this).val(), false, sSuffix);
            } else {
                oCourseAndScheduleDiv
                    .find('.quoteSchedule')
                    .empty()
                    .attr('disabled', true)
                    .append($('<option value="" selected disabled hidden>Select Course First</option>'))
                    .find('option:eq(0)')
                    .prop('selected', true);
            }
        });

        $(document).on('click', '.addCourseBtn', function () {
            let oModal = {
                'getQuoteModal': '',
                'insertNewRequestModal': '-new',
                'editRequestModal': '-edit'
            };

            let sModalName = $(this).closest('.modal').attr('id');
            let sSuffix = oModal[sModalName];

            let oCourseAndScheduleDiv = $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last();

            if (oCourseAndScheduleDiv.find('.quoteCourse').val() === '') {
                return oLibraries.displayAlertMessage('error', 'Please select a course first.');
            }

            aFilteredCoursesAndSchedules = aFilteredCoursesAndSchedules.filter(function (aCourse) {
                return aCourse.courseId != oCourseAndScheduleDiv.find('.quoteCourse').val();
            });

            oCourseAndScheduleDiv.find('.quoteCourse').attr('disabled', true);

            populateCourseDropdown(aFilteredCoursesAndSchedules, sSuffix);

            if ($(`.courseAndScheduleDiv${sSuffix}`).filter(':hidden').length === 0) {
                $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last().prev().find('.deleteCourseBtn').parent().css('display', 'block');
                $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last().find('.deleteCourseBtn').parent().css('display', 'none');
                $('.addCourseBtn').parent().css('display', 'none');
            }
            if ($(`.courseAndScheduleDiv${sSuffix}`).filter(':hidden').length !== 0) {
                $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last().prev().find('.deleteCourseBtn').parent().css('display', 'block');
                $(`.courseAndScheduleDiv${sSuffix}`).filter(':visible').last().find('.deleteCourseBtn').parent().css('display', 'none');
            }
        });

        $(document).on('click', '.deleteCourseBtn', function (e) {
            let oModal = {
                'getQuoteModal': '',
                'insertNewRequestModal': '-new',
                'editRequestModal': '-edit'
            };

            let sModalName = $(this).closest('.modal').attr('id');
            let sSuffix = oModal[sModalName];
            let oCourseAndScheduleDiv = $(this).closest(`.courseAndScheduleDiv${sSuffix}`);

            let iSelectedCourseId = oCourseAndScheduleDiv.find('.quoteCourse').val();

            let oCourseProperties = aCoursesAndSchedules.filter(function (oProperty) {
                return oProperty.courseId == iSelectedCourseId;
            })[0];

            aFilteredCoursesAndSchedules.push(oCourseProperties);

            let oClone = oCourseAndScheduleDiv.clone().css('display', 'none');

            $(this).closest(`.courseAndScheduleDiv${sSuffix}`).remove();

            oClone
                .find('.quoteSchedule')
                .empty()
                .attr('disabled', true)
                .append($('<option value="" selected disabled hidden>Select Course First</option>'))
                .find('option:eq(0)')
                .prop('selected', true);

            oClone
                .find('.quoteCourse')
                .empty()
                .attr('disabled', false);

            oClone.insertAfter($(`#${sModalName}`).find(`.courseAndScheduleDiv${sSuffix}:last`));

            // Re-add the course into the select dropdown.
            let aCourseDropDown = $(`#${sModalName}`)
                .find(`.courseAndScheduleDiv${sSuffix}`)
                .filter(':visible')
                .last()
                .find('select.quoteCourse')
                .empty()
                .append($('<option value="" selected>Select Course</option>'));


            $(`#${sModalName}`)
                .find(`.courseAndScheduleDiv${sSuffix}`)
                .filter(':visible')
                .last()
                .find('select.quoteSchedule')
                .empty()
                .append($('<option value="" selected disabled hidden>Select Course First</option>'));

            $.each(aFilteredCoursesAndSchedules, function (iKey, oCourse) {
                aCourseDropDown.append($('<option />').val(oCourse.courseId).text(oCourse.courseName)).find('option:eq(0)').prop('selected', true);
            });

            if ($(`#${sModalName}`).find(`.courseAndScheduleDiv${sSuffix}`).filter(':hidden').length === 0) {
                $('.addCourseBtn').parent().css('display', 'none');
                $(this).closest(`.courseAndScheduleDiv${sSuffix}`).find('.deleteCourseBtn').parent().css('display', 'none');
            }
            if ($(`#${sModalName}`).find(`.courseAndScheduleDiv${sSuffix}`).filter(':hidden').length !== 0) {
                $('.addCourseBtn').parent().css('display', 'block');
                $(this).closest(`.courseAndScheduleDiv${sSuffix}`).find('.deleteCourseBtn').parent().css('display', 'block');
            }
        });

        // Reset inputs before opening any modal.
        $(document).on('click', '#insertNewQuoteRequest, #addNewQuoteRequest', function () {
            let modalId = $(this).attr('data-target');
            let formName = '#' + $(modalId).find('form').attr('id') + '';
            oForms.resetInputBorders(formName);
            $(formName)[0].reset();
            $('.error-msg').css('display', 'none').html('');

            if ($(this).attr('id') === 'insertNewQuoteRequest') {
                includeSenderDetailsToForm();
            }
        });

        $('#getQuoteModal, #insertNewRequestModal, #editRequestModal').on('hidden.bs.modal', function () {
            let oModal = {
                'getQuoteModal': '',
                'insertNewRequestModal': '-new',
                'editRequestModal': '-edit'
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
                    'validationMethod': oValidations.validateQuoteRequestInputs('insertNewRequestForm'),
                    'requestClass': 'Quotations',
                    'requestAction': 'requestQuotation'
                },
                '#editRequestForm': {
                    'validationMethod': oValidations.validateQuoteRequestInputs('editRequestForm'),
                    'requestClass': 'Quotations',
                    'requestAction': 'updateQuotation'
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

                if (formName === '#editRequestForm') {
                    formData.push({ 'name': ':senderId', 'value': oEditIds.iSenderId });
                    formData.push({ 'name': ':userId', 'value': oEditIds.iUserId });
                    formData.push({ 'name': ':dateRequested', 'value': oEditIds.sDateRequested });
                }

                // Execute AJAX request.
                $.ajax({
                    url: `/Nexus/utils/ajax.php?class=${requestClass}&action=${requestAction}`,
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
            url: `/Nexus/utils/ajax.php?class=Quotations&action=fetchSenders`,
            type: 'POST',
            data: {iIsQuotationSent : 0},
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
        oData.iIsQuotationSent = 0;
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
        oData.iIsQuotationSent = 0;
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

    // Populate the course dropdown select.
    function populateCourseDropdown(aCourses, sSuffix = '') {
        let oCourseDropdown = $(`.courseAndScheduleDiv${sSuffix}[style*="display: none"]`).first().find('.quoteCourse');
        oCourseDropdown.parent().parent().css('display', 'block');
        oCourseDropdown.empty().append($('<option value="" selected>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    // Populate the schedule select dropdown.
    function populateCourseSchedule(iCourseId, bIsDeletePressed, sSuffix) {
        let oSchedule = $(`.courseAndScheduleDiv${sSuffix}[style*="display: block"]`).last().find('.quoteSchedule');
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
            oSchedule.append($('<option />').val(iKey).text(sSchedule));
        });

        if (bIsDeletePressed === true) {
            oSchedule.val(iSelectedScheduleId);
        } else {
            oSchedule.find('option:eq(0)').prop('selected', true)
        }
    }

    function includeSenderDetailsToForm() {
        let oData = aSenderDetails[0];
        let oInsertNewRequestForm = $('#insertNewRequestForm');
        oInsertNewRequestForm.find('.quoteFname').val(oData.firstName);
        oInsertNewRequestForm.find('.quoteMname').val(oData.middleName);
        oInsertNewRequestForm.find('.quoteLname').val(oData.lastName);
        oInsertNewRequestForm.find('.quoteEmail').val(oData.email);
        oInsertNewRequestForm.find('.quoteContactNum').val(oData.contactNum);
    }

    /**
     * fetchCoursesAndSchedules
     */
    function fetchCoursesAndSchedules() {
        // Execute AJAX request.
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Forms&action=fetchHomepageData',
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

    function getTemplate() {
        if ($.isEmptyObject(oTemplate) === true) {
            oTemplate = $('.courseAndScheduleDiv-edit').clone();
        }
        return oTemplate;
    }

    function cloneDivElementsForEditing(oData) {
        // Add the old company name and if company sponsored for editing.
        $('#editRequestForm').find('.quoteCompanyName').val(oData.quoteCompanyName);
        $('#editRequestForm').find('.quoteBillToCompany').prop('checked', oData.isCompanySponsored);

        getTemplate();

        $('.template')
            .empty()
            .find('div[class="courseAndScheduleDiv-edit"]:visible')
            .remove();

        let aCoursesAndSchedulesForEdit = aCoursesAndSchedules;
        let oLastCourse = {};

        $.each(oData.aCourses, function (iKey, sCourseName) {
            let sRow = oTemplate.clone().css('display', 'block');

            $('.template').append(sRow);

            populateCourseDropdownForEdit(aCoursesAndSchedulesForEdit);
            sRow.find(`select.quoteCourse option:contains(${oData.aCourses[iKey]})`).prop('selected', true);

            aFilteredCoursesAndSchedules = aCoursesAndSchedulesForEdit.filter(function (aCourse) {
                return aCourse.courseName != oData.aCourses[iKey];
            });

            let aSchedules = aCoursesAndSchedulesForEdit.filter(function (aCourse) {
                return aCourse.courseName == sCourseName;
            })[0];

            aCoursesAndSchedulesForEdit = aFilteredCoursesAndSchedules;

            populateCourseScheduleForEdit(aSchedules);
            sRow.find(`.quoteSchedule option:contains(${oData.aSchedules[iKey]})`).prop('selected', true);

            sRow.find(`input.numPax`).val(oData.numPax[iKey]);

            // Get last added course.
            oLastCourse = aCoursesAndSchedules.filter(function (aCourse) {
                return aCourse.courseName == oData.aCourses[iKey];
            })[0];
        });

        // Push the last added course to the aFilteredCoursesAndSchedules.
        aFilteredCoursesAndSchedules.push(oLastCourse);

        // Get the number of cloned divs and subtract it to the number of courses and schedules fetched from the database.
        let iClonedDivCount = $('.template').find('div.courseAndScheduleDiv-edit').length;

        let iRemainingDivsToClone = aCoursesAndSchedules.length - iClonedDivCount;

        while (iRemainingDivsToClone != 0) {
            let sRow = oTemplate.clone();
            $('.template').append(sRow);
            iRemainingDivsToClone--;
        };
    }

    // Populate the course dropdown select.
    function populateCourseDropdownForEdit(aCourse) {
        let oCourseDropdown = $('.courseAndScheduleDiv-edit').last().find('.quoteCourse').prop('disabled', 'true');
        oCourseDropdown.empty().append($('<option value="" selected disabled hidden>Select Course</option>'));

        $.each(aCourse, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    function populateCourseScheduleForEdit(aData) {
        let oScheduleDropdown = $('.courseAndScheduleDiv-edit').last().find('.quoteSchedule');

        $.each(aData.schedule, function (iKey, sSchedule) {
            oScheduleDropdown.append($('<option />').val(iKey).text(sSchedule));
        });
    }

    function showAddDeleteButtons(iDataLength) {
        let oEditForm = $('#editRequestForm');

        if (iDataLength === 1) {
            oEditForm.find('.deleteCourseBtn').parent().css('display', 'none');
        } else {
            if (iDataLength === aCoursesAndSchedules.length) {
                oEditForm.find('.addCourseBtn').parent().css('display', 'none');
            } else {
                oEditForm.find('.addCourseBtn').parent().css('display', 'block');
                oEditForm.find('.deleteCourseBtn').parent().css('display', 'block');
            }
            oEditForm.find('.courseAndScheduleDiv-edit').eq(iDataLength - 1).find('.deleteCourseBtn').parent().css('display', 'none');
        }
    }

    function deleteRequest(oData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Quotations&action=deleteQuotation',
            type: 'POST',
            data: oData,
            dataType: 'json',
            success: function (oResponse) {
                return oResponse.msg;
            }
        });
    }

    function deleteSender(oData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Quotations&action=deleteSender',
            type: 'POST',
            data: oData,
            dataType: 'json',
            success: function (oResponse) {
                return oResponse.msg;
            }
        });
    }

    function approveQuotation(oData) {
        return axios.post('/Nexus/utils/ajax.php?class=Quotations&action=approveQuotation', oData)
            .then(function (oResponse) {
                return oResponse.data;
            })
            .catch(function (oError) {
                return oError;
            });
    }

    return {
        initialize: init
    }

})();

$(() => {
    oQuotationRequests.initialize();
});