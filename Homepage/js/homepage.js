$(function () {

    // Reset inputs before opening any modal.
    $(document).on('click', 'a[data-toggle="modal"]', function() {
        let modalId = $(this).attr('data-target');
        resetInputBorders();
        $(modalId).find('form')[0].reset();
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
    $(document).on('focus', 'input', function () {
        $(this).css('border', '1px solid #ccc');
    });

    // Function for submission of registration form.
    $(document).on('submit', 'form', function (event) {
        event.preventDefault();
        
        let formName = '#' + $(this).attr('id') + '';
        console.log(formName);

        // Invoke the resetInputBorders method.
        resetInputBorders(formName);

        let aForms = {
            '#registrationForm' : validateRegisterInputs(),
            '#quotationForm'    : validateQuoteInputs(),
            '#emailForm'        : validateEmailUsInputs()
        }

        let validateInput = aForms[formName];

        console.log(validateInput); return;

        // Check if input validation result is true.
        if (validateRegisterInputs().result === true) {
            // Extract form data.
            let formData = $(formName).serializeArray();

            // Execute AJAX request.
            $.ajax({
                url: '../utils/ajax.php?class=Student&action=registerStudent',
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                },
                error: function() {
                    Swal.fire({
                        title: 'Error.',
                        text: 'An error has occured. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        } else { // This means that there's an error while validating inputs.

            // Scroll to div with an id of error.
            $("#registerModal").animate({
                scrollTop: $(".error-msg").offset().top
            } /* speed */);

            // Display error message.
            $('.error-msg')
                .css('display', 'block')
                .html("<span class='text-danger'><i class='fas fa-exclamation-triangle'></i> " + validateRegisterInputs().msg + "</span><br><br>");

            // Highlight the input that has an error.
            $(validateRegisterInputs().element).css('border', '1px solid red');

            // Remove the error message after 2000 milliseconds.
            setTimeout(function () {
                $('.error-msg').css('display', 'none').html('');
            }, 3000);
        }
    });

    // Remove existing red borders on inputs.
    function resetInputBorders(formName) {
        $(formName).find('input').css('border', '1px solid #ccc');
    }

    // This method validates the inputs of the user before submission for registration.
    function validateRegisterInputs() {

        // Declare an object with properties related to inputs that need to be validated.
        let inputRules = [
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
            inputRules.splice(1, 0,
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
            inputRules.splice(4, 0,
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

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $.each(inputRules, function (key, inputRule) {
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
        let inputRules = [
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
            inputRules.push(
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
            inputRules.push(
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

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $.each(inputRules, function (key, inputRule) {
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
        });
        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for emailing.
    function validateEmailUsInputs() {

        // Declare an object with properties related to inputs that need to be validated.
        let inputRules = [
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
            }
        ];

        // Declare initially the validation result to be returned by the function.
        let validationResult = {
            result: true
        }

        // Check if middle name has a value.
        if ($.trim($('#emailMname').val()).length !== 0) {
            inputRules.push(
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

        // Loop thru each inputRules and if there are rules violated, return false and the error message.
        $.each(inputRules, function (key, inputRule) {
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
        });
        // Return the result of the validation.
        return validationResult;
    }

});
