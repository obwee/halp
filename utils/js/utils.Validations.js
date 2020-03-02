class Validations
{
    // This method validates the inputs of the user before submission for registration.
    validateRegisterInputs() {

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
    validateQuoteInputs() {

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

        let numPaxRegex = /^(?!-\d+|0)\d+$/g;
        
        if ($('#numPax').val() < 1 || $('#numPax').val() > 100 || numPaxRegex.test($('#numPax').val()) === false) {
            return {
                result: false,
                element: '#numPax',
                msg: 'Invalid value for number of persons.'
            }
        }

        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for emailing.
    validateEmailUsInputs() {
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

};

let oValidations = new Validations();