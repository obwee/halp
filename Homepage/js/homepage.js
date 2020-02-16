$(function () {

    // Allow only alphabetical characters and a period on first, middle, and last name via RegExp.
    $(document).on('keyup keydown', '#registrationFname, #registrationMname, #registrationLname, #quoteFname, #quoteMname, #quoteLname', function () {
        // Input must not start by a period.
        if (this.value.length === 1 && this.value.match(/[^a-zA-Z]/)) {
            return this.value = this.value.replace(this.value, '');
        }
        return this.value = this.value.replace(/[^a-zA-Z\s\.]/g, '');
    });

    $(document).on('keyup keydown', '#registrationContactNum', function () {
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
    $(document).on('focusout', '#registrationFname, #registrationMname, #registrationLname, #registrationCompany', function () {
        $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\.+/g, '.').trim());
    });

    // Remove red border on focus event on any input.
    $(document).on('focus', '#registrationForm :input', function () {
        $(this).css('border', '1px solid #ccc');
    });

    // Function for submission of registration form.
    $(document).on('submit', '#registrationForm', function (event) {
        console.log(123);
        event.preventDefault();
        // Remove existing red borders on inputs.
        $('#registrationForm :input').css('border', '1px solid #ccc');

        // Check if input validation result is true.
        if (validateInputs().result === true) {
            let formData = $(this).serializeArray();

            $.ajax({
                url: '../utils/ajax.php?class=Register&action=registerStudent',
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
                scrollTop: $("#error").offset().top
            } /* speed */);

            // Display error message.
            $('#error').css('display', 'block').html("<span class='text-danger'><i class='fas fa-exclamation-triangle'></i> " + validateInputs().msg + "</span><br><br>");

            // Highlight the input that has an error.
            $(validateInputs().element).css('border', '1px solid red');

            // Remove the error message after 2000 milliseconds.
            setTimeout(function () {
                $('#error').css('display', 'none').html('');
            }, 3000);
        }
    });

    // This method validates the inputs of the user before submission.
    function validateInputs() {

        return {
            result: true
        }; 

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
        if ($.trim($('#registrationMname').val().length) !== 0) {
            inputRules.push(
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
        if ($.trim($('#registrationCompanyName').val().length) !== 0) {
            inputRules.push(
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

});
