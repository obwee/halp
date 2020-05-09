var oCourses = (() => {

    let oTblCourses = $('#tbl_courses');

    /**
     * @var {object} oTemplate
     * Template holder for cloning elements.
     */
    let oTemplate = {};

    let aCourses = [];

    let oColumns = {
        aCourses: [
            {
                title: 'Course Code', className: 'text-center', data: 'courseCode'
            },
            {
                title: 'Official Course Title', className: 'text-center', data: 'courseName'
            },
            {
                title: 'Details', className: 'text-center', render: (aData, oType, oRow) =>
                    (oRow.courseDescription === '') ? '-' : oRow.courseDescription
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-warning btn-sm" data-toggle="modal" id="editCourse" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-${(oRow.status === 'Active') ? 'danger' : 'success'} btn-sm" data-toggle="modal" id="${(oRow.status === 'Active') ? 'disableCourse' : 'enableCourse'}" data-id="${oRow.id}">
                        <i class="fa fa-${(oRow.status === 'Active') ? 'times-circle' : 'check-circle'}"></i>
                    </button>`
            },
        ]
    };

    function init() {
        populateCoursesTable();
        setEvents();
    }

    function setEvents() {

        $(document).on('hidden.bs.modal', '.modal', function() {
            $('form')[0].reset();
        });

        oForms.prepareDomEvents();

        $(document).on('click', '#editCourse', function () {
            let iCourseId = $(this).attr('data-id');

            // Get the course by filtering the fetched courses using the course ID.
            let oCourse = aCourses.filter((aCourse) => {
                return aCourse.id == iCourseId
            })[0];

            // Populate the fields with its corresponding data from the table.
            $('.courseId').val(oCourse.id);
            $('.courseCode').val(oCourse.courseCode);
            $('.courseTitle').val(oCourse.courseName);
            $('.courseDetails').val((oCourse.courseDescription === '-') ? '' : oCourse.courseDescription);

            $('#editCourseModal').modal('show');
        });

        $(document).on('click', '#disableCourse', function () {
            const iCourseId = parseInt($(this).attr('data-id'), 10);
            const oCourse = aCourses.filter(oCourseData => oCourseData.id == iCourseId)[0];

            Swal.fire({
                title: 'Disable the course?',
                text: `This will mark ${oCourse.courseCode} as 'Inactive'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'courseId': iCourseId,
                        'courseAction': 'disable'
                    }
                    toggleEnableDisableCourse(oDetails);
                }
            });
        });

        $(document).on('click', '#enableCourse', function () {
            const iCourseId = parseInt($(this).attr('data-id'), 10);
            const oCourse = aCourses.filter(oCourseData => oCourseData.id == iCourseId)[0];

            Swal.fire({
                title: 'Enable the course?',
                text: `This will mark the status of ${oCourse.courseCode} as 'Active'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'courseId': iCourseId,
                        'courseAction': 'enable'
                    }
                    toggleEnableDisableCourse(oDetails);
                }
            });
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            // Get the form name being submitted.
            let sFormId = '#' + $(this).attr('id') + '';

            // Extract form data.
            let aFormData = $(sFormId).serializeArray();

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            let oInputForms = {
                '#addCourseForm': {
                    'validationMethod': oValidations.validateAddUpdateCourseInputs(sFormId),
                    'requestClass': 'Courses',
                    'requestAction': 'addCourse'
                },
                '#editCourseForm': {
                    'validationMethod': oValidations.validateAddUpdateCourseInputs(sFormId),
                    'requestClass': 'Courses',
                    'requestAction': 'updateCourse'
                },
                '#changeCourseForm': {
                    'validationMethod': oValidations.validateChangeCourseInputs(aFormData),
                    'requestClass': 'Courses',
                    'requestAction': 'changeCourses'
                },
            }

            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            // Validate the inputs of the submitted form and store the result inside validateInputs variable.
            let validateInputs = oInputForms[sFormId].validationMethod;

            // Get the request class of the form submitted.
            let requestClass = oInputForms[sFormId].requestClass;

            // Get the request action of the form submitted.
            let requestAction = oInputForms[sFormId].requestAction;

            // Check if input validation result is true.
            if (validateInputs.result === true) {

                // Execute AJAX request.
                $.ajax({
                    url: `/Nexus/utils/ajax.php?class=${requestClass}&action=${requestAction}`,
                    type: 'post',
                    data: aFormData,
                    dataType: 'json',
                    success: function (oResponse) {
                        if (oResponse.bResult === true) {
                            $(sFormId).parents().find('div.modal').modal('hide');
                            populateCoursesTable();
                            oLibraries.displayAlertMessage('success', oResponse.sMsg);
                        } else {
                            oLibraries.displayErrorMessage(sFormId, oResponse.sMsg, oResponse.sElement);
                        }
                    },
                    error: function () {
                        oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
                    }
                });
            } else { // This means that there's an error while validating inputs.
                oLibraries.displayErrorMessage(sFormId, validateInputs.msg, validateInputs.element);
            }
            oForms.disableFormState(sFormId, false);
        });
    }

    /**
     * proceedToChangeCourse
     * @param {object} oDetails
     * @param {int} iCourseId
     */
    function proceedToChangeCourse(oDetails, iCourseId) {
        oLibraries.displayAlertMessage('warning', 'Please update the courses for the following schedules.');

        loadTemplate();

        $('.box')
            .empty()
            .find('div[class!="template"]')
            .remove();

        $.each(oDetails, (iKey, oVal) => {
            let oRow = oTemplate.clone().attr({
                'hidden': false,
                'class': 'clonedTpl',
            });

            oRow.find('.courseSchedule span').text(oVal.fromDate + ' - ' + oVal.toDate);
            oRow.find('.courseInstructor span').text(oVal.instructorName);
            oRow.find('.courseVenue span').text(oVal.venue);

            cloneCourseDropdown(oRow.find('.courses'), oVal.scheduleId, iCourseId);
            insertCourseToBeDisabled($('.courseName'), iCourseId);

            $('.box').append(oRow);
        });

        $('.clonedTpl hr').last().remove();
        $('#changeCourseModal').find('.courseId').val(iCourseId);
        $("#changeCourseModal").modal('show');
    }

    /**
     * loadTemplate
     * Loads the template.
     */
    function loadTemplate() {
        if ($.isEmptyObject(oTemplate) === true) {
            oTemplate = $('.template').clone();
        }
    }

    /**
     * cloneCourseDropdown
     * Clones the course dropdown inside the template.
     */
    function cloneCourseDropdown(oElement, iScheduleId, iCourseId) {
        let aFilteredCourses = aCourses.filter((oCourse) => {
            return oCourse.id !== iCourseId && oCourse.status === 'Active';
        });

        oElement.empty().attr('name', `courses[${iScheduleId}]`).append($('<option selected disabled hidden>Select Course</option>'));
        $.each(aFilteredCourses, (iKey, oVal) => {
            oElement.append($('<option />').val(oVal.id).text(`${oVal.courseCode}`));
        });
    }

    /**
     * insertCourseToBeDisabled
     * Inserts the name of the course to be disabled.
     */
    function insertCourseToBeDisabled(oElement, iCourseId) {
        let oCourseData = aCourses.filter((oCourse) => {
            return oCourse.id === iCourseId;
        })[0];

        oElement.val(`${oCourseData.courseCode} (${oCourseData.courseName})`);
    }

    /**
     * toggleEnableDisableCourse
     * @param {object} oCourseData
     */
    function toggleEnableDisableCourse(oCourseData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Courses&action=enableDisableCourse',
            type: 'POST',
            data: oCourseData,
            dataType: 'json',
            success: function (oResponse) {
                if (oResponse.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    populateCoursesTable();
                } else {
                    // If there are pending schedules for the instructor to be disabled.
                    if (typeof (oResponse.aSchedules) !== 'undefined') {
                        oCourseDetails = oCourseData;
                        proceedToChangeCourse(oResponse.aSchedules, oCourseData.courseId);
                        return;
                    }
                    oLibraries.displayAlertMessage('error', oResponse.sMsg);
                }
            }
        });
    }

    function populateCoursesTable() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Courses&action=fetchAllCourses`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                aCourses = oData;
                return oData;
            },
            async: false
        };

        let aColumnDefs = [
            { orderable: false, targets: [1, 2, 3] }
        ];

        loadTable(oTblCourses.attr('id'), oAjax, oColumns.aCourses, aColumnDefs);
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
    oCourses.initialize();
});
