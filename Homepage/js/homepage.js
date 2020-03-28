var oHomepage = (() => {

    let aCoursesAndSchedules = [];
    let aFilteredCoursesAndSchedules = [];

    function init() {
        fetchData();
        prepareDomEvents();
    }

    function prepareDomEvents() {
        oForms.prepareDomEvents();

        $(document).on('change', '.quoteCourse', function () {
            populateCourseSchedule($(this).val());
        });

        $(document).on('click', '.addCourseBtn', function () {
            let oCourseDiv = $('.courseAndScheduleDiv').filter(':visible').last();

            if (oCourseDiv.find('select.quoteCourse').val() === null) {
                return oLibraries.displayAlertMessage('error', 'Please select a course first.');
            }

            aFilteredCoursesAndSchedules = aFilteredCoursesAndSchedules.filter(function (aCourse) {
                return aCourse.courseId != oCourseDiv.find('select.quoteCourse').val();
            });

            oCourseDiv.find('.quoteCourse').attr('disabled', true);
            oCourseDiv.find('.quoteSchedule').attr('disabled', true);

            populateCourseDropdown(aFilteredCoursesAndSchedules);

            if ($('.courseAndScheduleDiv').filter(':hidden').length === 0) {
                $('.addCourseBtn').parent().css('display', 'none');
                $('.deleteCourseBtn').parent().attr('class', 'col-sm-12 text-center');
            } else {
                $('.addCourseBtn').parent().attr('class', 'col-sm-6 text-right').css('display', 'block');
                $('.deleteCourseBtn').parent().attr('class', 'col-sm-6 text-left').css('display', 'block');
            }
        });

        $(document).on('click', '.deleteCourseBtn', function () {
            let oCourseAndScheduleDiv = $('.courseAndScheduleDiv').filter(':visible').last();

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

            let oCourseDiv = $('.courseAndScheduleDiv').filter(':visible').find('.quoteCourse');

            aFilteredCoursesAndSchedules.push(aCoursesAndSchedules.filter(function (aCourse) {
                return aCourse.courseId == oCourseDiv.last().val();
            })[0]);

            populateCourseSchedule(oCourseDiv.last().val(), true);

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

        $('#getQuoteModal').on('hidden.bs.modal', function (e) {
            $('.courseAndScheduleDiv:not(:first)').remove();
            $('.courseAndScheduleDiv:first').find('select.quoteCourse').attr('disabled', false).find('option:eq(0)').prop('selected', true);
            $('.courseAndScheduleDiv:first').find('select.quoteSchedule').attr('disabled', true).find('option:eq(0)').prop('selected', true);
            $(`.courseAndScheduleDiv:first`).find('input.numPax').val(1);
            aFilteredCoursesAndSchedules = aCoursesAndSchedules;
            oForms.cloneDivElements(aCoursesAndSchedules.length);
            $('.addCourseBtn').parent().attr('class', 'col-sm-12 text-center').css('display', 'block');
            $('.deleteCourseBtn').parent().css('display', 'none');
        });

        // Function for submission of any form.
        $(document).on('submit', 'form', function (event) {
            event.preventDefault();

            // Get the form id being submitted.
            let sFormId = '#' + $(this).attr('id') + '';

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            let oInputForms = {
                '#registrationForm': {
                    'validationMethod': oValidations.validateRegisterInputs(sFormId),
                    'requestClass': 'Student',
                    'requestAction': 'registerStudent'
                },
                '#quotationForm': {
                    'validationMethod': oValidations.validateQuoteInputs(sFormId),
                    'requestClass': 'Quotations',
                    'requestAction': 'requestQuotation'
                },
                '#emailForm': {
                    'validationMethod': oValidations.validateEmailUsInputs(sFormId),
                    'requestClass': 'Student',
                    'requestAction': 'sendEmail'
                }
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
                // Extract form data.
                let formData = $(sFormId).serializeArray();

                if (sFormId === '#quotationForm') {
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
                    success: function (oResponse) {
                        if (oResponse.bResult === true) {
                            $(sFormId).parents().find('div.modal').modal('hide');
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

    function fetchData() {
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
            }
        });
    }

    // Populate the course dropdown select.
    function populateCourseDropdown(aCourses) {
        let oCourseDropdown = $('.courseAndScheduleDiv[style*="display: none"]').first().find('.quoteCourse');
        oCourseDropdown.parent().parent().css('display', 'block');
        oCourseDropdown.empty().append($('<option value="" selected disabled hidden>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(`${oCourse.courseName} (${oCourse.courseCode})`));
        });
    }

    // Populate the schedule dropdown select.
    function populateCourseSchedule(iCourseId, bIsDeletePressed = false) {
        let oSchedule = $('.courseAndScheduleDiv[style*="display: block"]').last().find('.quoteSchedule');
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

    return {
        initialize: init
    }
})();

$(() => {
    oHomepage.initialize();
});
