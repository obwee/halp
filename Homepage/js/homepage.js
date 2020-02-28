let Homepage = (() => {

    let aCoursesAndSchedules = [];

    let aFilteredCoursesAndSchedules = [];

    function init() {
        fetchData();
        prepareDomEvents();
    }

    function prepareDomEvents() {

        $(document).on('change', '.quoteCourse', function () {
            populateCourseSchedule($(this).val());
        });

        $(document).on('click', '.addCourseBtn', function () {
            let oCourseDiv = $('.courseAndScheduleDiv').filter(':visible').last();

            if (oCourseDiv.find('select.quoteCourse').val() === null) {
                return Swal.fire({
                    title: 'Error.',
                    text: 'Please select a course first.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
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
            resetInputBorders(formName);
            $(formName)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $('#getQuoteModal').on('hidden.bs.modal', function (e) {
            $('.courseAndScheduleDiv:not(:first)').remove();
            $('.courseAndScheduleDiv:first').find('select.quoteCourse').attr('disabled', false);
            $('.courseAndScheduleDiv:first').find('select.quoteSchedule').attr('disabled', true);
            aFilteredCoursesAndSchedules = aCoursesAndSchedules;
            cloneDivElements(aCoursesAndSchedules.length);
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

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            let aForms = {
                '#registrationForm': {
                    'validationMethod': validateRegisterInputs(),
                    'requestAction': 'registerStudent'
                },
                '#quotationForm': {
                    'validationMethod': validateQuoteInputs(),
                    'requestAction': 'requestQuotation'
                },
                '#emailForm': {
                    'validationMethod': validateEmailUsInputs(),
                    'requestAction': 'sendEmail'
                }
            }

            // Get the form name being submitted.
            let formName = '#' + $(this).attr('id') + '';

            disableFormState(formName, true);

            // Invoke the resetInputBorders method for that form.
            resetInputBorders(formName);

            // Validate the inputs of the submitted form and store the result inside validateInputs variable.
            let validateInputs = aForms[formName].validationMethod;

            // Get the request action of the form submitted.
            let requestAction = aForms[formName].requestAction;

            // Check if input validation result is true.
            if (validateInputs.result === true) {
                // Extract form data.
                let formData = $(formName).serializeArray();

                let aSelectedCourses = [];
                let aSelectedSchedules = [];

                if (formName === '#quotationForm') {
                    // Get courses.
                    $('select[name="quoteCourse[]"]:visible').each(function () {
                        // oSelectedCourseAndSchedule.push({$(this).val()})
                        aSelectedCourses.push($(this).val());
                    });

                    // Get schedules.
                    $('select[name="quoteSchedule[]"]:visible').each(function () {
                        aSelectedSchedules.push($(this).val());
                    });

                    // Remove unnecessary data to be sent in AJAX request.
                    formData = formData.filter(function (sFormKey) {
                        return sFormKey.name != 'quoteCourse[]' && sFormKey.name != 'quoteSchedule[]' && sFormKey.value !== '';
                    });

                    formData.push({ 'name': 'quoteCourses', 'value': aSelectedCourses });
                    formData.push({ 'name': 'quoteSchedules', 'value': aSelectedSchedules });
                }

                // Execute AJAX request.
                $.ajax({
                    url: '../utils/ajax.php?class=Student&action=' + requestAction,
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.result === true) {
                            $(formName).parents().find('div.modal').modal('hide');
                            Swal.fire({
                                title: 'Success.',
                                text: response.msg,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            displayErrorMessage(formName, response.msg, response.element);
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error.',
                            text: 'An error has occured. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            } else { // This means that there's an error while validating inputs.
                displayErrorMessage(formName, validateInputs.msg, validateInputs.element);
            }
            disableFormState(formName, false);
        });
    }

    // Toggle disabled state of the form.
    function disableFormState(formName, state) {
        $(formName).find('div[class="modal-footer"] button').prop('disabled', state);
        $(formName).prop('disabled', state);
    }

    // Remove existing red borders on inputs.
    function resetInputBorders(formName) {
        $(formName).find('input').css('border', '1px solid #ccc');
    }

    function displayErrorMessage(formName, msg, element) {
        // Scroll to div that displays the error message.
        $(formName).parents().find('div.modal').animate({
            scrollTop: $('.error-msg').offset().top
        } /* speed */);

        // Display error message.
        $('.error-msg')
            .css('display', 'block')
            .html("<span class='text-danger'><i class='fas fa-exclamation-triangle'></i> " + msg + "</span>");

        // Highlight the input that has an error.
        $(element).css('border', '1px solid red');

        // Remove the error message after 2000 milliseconds.
        setTimeout(function () {
            $('.error-msg').css('display', 'none').html('');
        }, 3000);
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
                cloneDivElements(aCoursesAndSchedules.length);
                populateCourseDropdown(aFilteredCoursesAndSchedules);
            }
        });
    }

    function cloneDivElements(iCount) {
        for (let i = 1; i < iCount; i++) {
            let oCourseScheduleDiv = $('.courseAndScheduleDiv:last').clone();
            oCourseScheduleDiv.insertAfter('.courseAndScheduleDiv:last').css('display', 'none');
        }
    }

    function populateCourseDropdown(aCourses) {
        let oCourseDropdown = $('.courseAndScheduleDiv[style*="display: none"]').first().find('.quoteCourse');
        oCourseDropdown.parent().parent().css('display', 'block');
        oCourseDropdown.empty().append($('<option value="" selected disabled hidden>Select Course</option>'));

        $.each(aCourses, function (iKey, oCourse) {
            oCourseDropdown.append($('<option />').val(oCourse.courseId).text(oCourse.courseName));
        });
    }

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

    // This method validates the inputs of the user before submission for registration.
    function validateRegisterInputs() {

        // Declare an object with properties related to inputs that need to be validated.
        let registerInputRules = [
            {
                name: 'First name',
                element: '#registrationFname',
                length: $.trim($('#registrationFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '#registrationLname',
                length: $.trim($('#registrationLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '#registrationContactNum',
                length: $.trim($('#registrationContactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '#registrationEmail',
                length: $.trim($('#registrationEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Username',
                element: '#registrationUsername',
                length: $.trim($('#registrationUsername').val()).length,
                minLength: 4,
                maxLength: 15,
                pattern: /^(?![0-9_])\w+$/g
            },
            {
                name: 'Password',
                element: '#registrationPassword',
                length: $.trim($('#registrationPassword').val()).length,
                minLength: 4,
                maxLength: 30
            },
            {
                name: 'Password',
                element: '#registrationConfirmPassword',
                length: $.trim($('#registrationConfirmPassword').val()).length,
                minLength: 4,
                maxLength: 30
            },
        ];

        // Declare initially the validation result to be returned by the function.
        let validationResult = {
            result: true
        }

        // Check if middle name has a value.
        if ($.trim($('#registrationMname').val()).length !== 0) {
            registerInputRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '#registrationMname',
                    length: $.trim($('#registrationMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }
        // Check if company name has a value.
        if ($.trim($('#registrationCompanyName').val()).length !== 0) {
            registerInputRules.splice(4, 0,
                {
                    name: 'Company name',
                    element: '#registrationCompanyName',
                    length: $.trim($('#registrationCompanyName').val()).length,
                    minLength: 4,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9\s\.]+$/g
                },
            );
        }

        // Loop thru each registerInputRules and if there are rules violated, return false and the error message.
        $.each(registerInputRules, function (key, inputRule) {
            if (inputRule.length < inputRule.minLength) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be minimum of ' + inputRule.minLength + ' characters.'
                };
                return false;
            }
            if (inputRule.length > inputRule.maxLength) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be maximum of ' + inputRule.maxLength + ' characters.'
                };
                return false;
            }
            if ((inputRule.name !== 'Password') && (inputRule.pattern.test($(inputRule.element).val()) === false)) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' input is invalid.'
                };
                return false;
            }
        });

        // Check if passwords are equal.
        if ($('#registrationPassword').val() !== $('#registrationConfirmPassword').val()) {
            validationResult = {
                result: false,
                element: '#registrationPassword, #registrationConfirmPassword',
                msg: 'Passwords do not match.'
            };
        }

        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for quotation.
    function validateQuoteInputs() {

        // Declare an object with properties related to inputs that need to be validated.
        let quoteInputRules = [
            {
                name: 'First name',
                element: '#quoteFname',
                length: $.trim($('#quoteFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '#quoteLname',
                length: $.trim($('#quoteLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '#quoteContactNum',
                length: $.trim($('#quoteContactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '#quoteEmail',
                length: $.trim($('#quoteEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            }
        ];

        // Declare initially the validation result to be returned by the function.
        let validationResult = {
            result: true
        }

        // Check if middle name has a value.
        if ($.trim($('#quoteMname').val()).length !== 0) {
            quoteInputRules.push(
                {
                    name: 'Middle name',
                    element: '#quoteMname',
                    length: $.trim($('#quoteMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Check if company name has a value.
        if ($.trim($('#quoteCompanyName').val()).length !== 0) {
            quoteInputRules.push(
                {
                    name: 'Company name',
                    element: '#quoteCompanyName',
                    length: $.trim($('#quoteCompanyName').val()).length,
                    minLength: 4,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9\s\.]+$/g
                },
            );
        }

        // Loop thru each quoteInputRules and if there are rules violated, return false and the error message.
        $.each(quoteInputRules, function (key, inputRule) {
            if (inputRule.length < inputRule.minLength) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be minimum of ' + inputRule.minLength + ' characters.'
                };
                return false;
            }
            if (inputRule.length > inputRule.maxLength) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be maximum of ' + inputRule.maxLength + ' characters.'
                };
                return false;
            }
            if (inputRule.pattern.test($(inputRule.element).val()) === false) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' input is invalid.'
                };
                return false;
            }
        });

        let iBillToCompany = $('#quoteBillToCompany').is(':checked') ? 1 : 0;
        $('#quoteBillToCompany').val(iBillToCompany);

        if (iBillToCompany === 1 && $('#quoteCompanyName').val() === '') {
            return {
                result: false,
                element: '#quoteCompanyName',
                msg: 'Please specify company name if billing to company.'
            };
        }

        if ($('.quoteCourse').val() === null) {
            return {
                result: false,
                element: '.quoteCourse',
                msg: 'Please select a course.'
            };
        }

        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for emailing.
    function validateEmailUsInputs() {

        // Declare an object with properties related to inputs that need to be validated.
        let emailInputRules = [
            {
                name: 'First name',
                element: '#emailFname',
                length: $.trim($('#emailFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '#emailLname',
                length: $.trim($('#emailFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Email address',
                element: '#emailAddress',
                length: $.trim($('#emailAddress').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Email title',
                element: '#emailTitle',
                length: $.trim($('#emailTitle').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
        ];

        // Declare initially the validation result to be returned by the function.
        let validationResult = {
            result: true
        }

        // Check if middle name has a value.
        if ($.trim($('#emailMname').val()).length !== 0) {
            emailInputRules.push(
                {
                    name: 'Middle name',
                    element: '#emailMname',
                    length: $.trim($('#emailMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Loop thru each emailInputRules and if there are rules violated, return false and the error message.
        $.each(emailInputRules, function (key, inputRule) {
            if (inputRule.length < inputRule.minLength) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be minimum of ' + inputRule.minLength + ' characters.'
                };
                return false;
            }
            if (inputRule.length > inputRule.maxLength) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be maximum of ' + inputRule.maxLength + ' characters.'
                };
                return false;
            }
            if (inputRule.pattern.test($(inputRule.element).val()) === false) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' input is invalid.'
                };
                return false;
            }
        });
        // Return the result of the validation.
        return validationResult;
    }

    return {
        initialize: init
    }
})();

$(() => {
    Homepage.initialize();
});
