$(function () {

    // Allow only alphabetical characters and a period on first, middle, and last name via RegExp.
    $(document).on('keyup keydown', '#registrationFname, #registrationMname, #registrationLname', function () {
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

    // Function for submission of registration form.
    $(document).on('submit', '#registrationForm', function (event) {
        event.preventDefault();
        if (validateInputs().result === true) {
            alert(123)
        } else { // This means that there's an error while validating inputs.

            $("#registerModal").animate({
                scrollTop: $("#error").offset().top
            } /* speed */);

            // Display error message.
            $('#error').css('display', 'block').html("<span class='text-danger'><i class='fas fa-exclamation-triangle'></i> " + validateInputs().msg + "</span><br><br>");

            // Remove the error message after 2000 milliseconds.
            setTimeout(function () {
                $('#error').css('display', 'none').html('');
            }, 3000);
        }
    });

    // This method validates the inputs of the user before submission.
    function validateInputs() {

        let inputRules = [
            {
                name: 'First name',
                element: $('#registrationFname'),
                length: $.trim($('#registrationFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /[a-zA-Z\s\.]/g
            },
            {
                name: 'Last name',
                element: $('#registrationLname'),
                length: $.trim($('#registrationLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /[a-zA-Z\s\.]/g
            },
            // {
            //     name: 'Contact number',
            //     element: $('#registrationContactNum'),
            //     length: $.trim($('#registrationContactNum').val()).length,
            //     minLength: 7,
            //     maxLength: 12,
            //     pattern: /[0-9]/g
            // },
            // {
            //     name: 'Company name',
            //     element: $('#registrationCompanyName'),
            //     length: $.trim($('#registrationCompanyName').val()).length,
            //     minLength: 4,
            //     maxLength: 50,
            //     pattern: /[a-zA-Z0-9\s\.]/g
            // },
            // {
            //     name: 'Email address',
            //     element: $('#registrationEmail'),
            //     length: $.trim($('#registrationEmail').val()).length,
            //     minLength: 4,
            //     maxLength: 50,
            //     pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            // },
            // {
            //     name: 'Email address',
            //     element: $('#registrationEmail'),
            //     length: $.trim($('#registrationEmail').val()).length,
            //     minLength: 4,
            //     maxLength: 50,
            //     pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            // },
            // {
            //     name: 'Username',
            //     element: $('#registrationUsername'),
            //     length: $.trim($('#registrationUsername').val()).length,
            //     minLength: 4,
            //     maxLength: 15,
            //     pattern: /^(?![0-9_])\w+$/g
            // }
        ];

        let validationResult = {
            result: true
        }

        $.each(inputRules, function (key, inputRule) {
            if (inputRule.length < inputRule.minLength) {
                validationResult = {
                    result: false,
                    msg: inputRule.name + ' must be minimum of ' + inputRule.minLength + ' characters.'
                };
                return false;
            }
            if (inputRule.length > inputRule.maxLength) {
                validationResult = {
                    result: false,
                    msg: inputRule.name + ' must be maximum of ' + inputRule.maxLength + ' characters.'
                };
                return false;
            }
        });

        console.log(validationResult);

        return;

        // Check password input min length.
        if ($.trim($('#password').val()).length === 0) {
            // Return an object that contains the result and the error message.
            return {
                result: false,
                msg: 'Password cannot be empty.'
            };
        }

        // Return true if no errors on input validations.

    }

});
