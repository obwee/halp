var oHomepage = (() => {

    let aCoursesAndSchedules = [];
    let aFilteredCoursesAndSchedules = [];

    function init() {
        fetchData();
        prepareDomEvents();
    }

    function prepareDomEvents() {

        $(document).on('change', '.quoteCourse', function () {
            oForms.populateCourseSchedule($(this).val());
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

            oForms.populateCourseDropdown(aFilteredCoursesAndSchedules);

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

            oForms.populateCourseSchedule(oCourseDiv.last().val(), true);

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
            $('.courseAndScheduleDiv:first').find('select.quoteCourse').attr('disabled', false);
            $('.courseAndScheduleDiv:first').find('select.quoteSchedule').attr('disabled', true);
            aFilteredCoursesAndSchedules = aCoursesAndSchedules;
            oForms.cloneDivElements(aCoursesAndSchedules.length);
            $('.addCourseBtn').parent().attr('class', 'col-sm-12 text-center').css('display', 'block');
            $('.deleteCourseBtn').parent().css('display', 'none');
        });

        // Allow only alphabetical characters and a period on first, middle, and last name via RegExp.
        $(document).on('keyup keydown', '#registrationFname, #registrationMname, #registrationLname, #quoteFname, #quoteMname, #quoteLname, #emailFname, #emailMname, #emailLname', function () {
            // Input must not start by a period.
            if (this.value.length === 1 && this.value.match(/[^a-zA-Z]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^a-zA-Z\s\.]/g, '');
        });

        $(document).on('keyup keydown', '#numPax', function () {
            if ($(this).val() > 100) {
                return this.value = this.value.slice(0, -1);
            }
            return this.value = this.value.replace(/^0/g, '');
        });

        $(document).on('keyup keydown', '#registrationContactNum, #quoteContactNum', function () {
            return this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Allow only alphanumeric characters and an underscore on username input via RegExp.
        $(document).on('keyup keydown', '#registrationUsername', function () {
            // Input must not start by a number or any special character.
            if (this.value.length === 1 && this.value.match(/[^a-zA-Z]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '');
        });

        // Trim excess spaces and dots on specific inputs via RegExp on focusout event.
        $(document).on('focusout', '#registrationFname, #registrationMname, #registrationLname, #registrationCompany, #quoteFname, #quoteMname, #quoteLname, #quoteCompanyName', function () {
            $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\.+/g, '.').trim());
        });

        // Remove red border on focus event on any input.
        $(document).on('focus', 'input, select', function () {
            $(this).css('border', '1px solid #ccc');
        });

        // Function for submission of any form.
        $(document).on('submit', 'form', function (event) {
            event.preventDefault();

            // Get the form name being submitted.
            let formName = '#' + $(this).attr('id') + '';

            oForms.disableFormState(formName, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(formName);

            // Validate the inputs of the submitted form and store the result inside validateInputs variable.
            let validateInputs = oValidations.oForms[formName].validationMethod;

            // Get the request class of the form submitted.
            let requestClass = oValidations.oForms[formName].requestClass;

            // Get the request action of the form submitted.
            let requestAction = oValidations.oForms[formName].requestAction;

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

    function fetchData() {
        // Execute AJAX request.
        $.ajax({
            url: '../utils/ajax.php?class=Forms&action=fetchHomepageData',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                aCoursesAndSchedules = response;
                aFilteredCoursesAndSchedules = aCoursesAndSchedules;
                oForms.cloneDivElements(aCoursesAndSchedules.length);
                oForms.populateCourseDropdown(aFilteredCoursesAndSchedules);
            }
        });
    }

    return {
        initialize: init
    }
})();

$(() => {
    oHomepage.initialize();
});
