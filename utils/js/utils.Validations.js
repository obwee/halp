class Validations {
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
                element: '.quoteFname',
                length: $.trim($('.quoteFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.quoteLname',
                length: $.trim($('.quoteLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '.quoteContactNum',
                length: $.trim($('.quoteContactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '.quoteEmail',
                length: $.trim($('.quoteEmail').val()).length,
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
        if ($.trim($('.quoteMname').val()).length !== 0) {
            quoteInputRules.push(
                {
                    name: 'Middle name',
                    element: '.quoteMname',
                    length: $.trim($('.quoteMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Check if company name has a value.
        if ($.trim($('.quoteCompanyName').val()).length !== 0) {
            quoteInputRules.push(
                {
                    name: 'Company name',
                    element: '.quoteCompanyName',
                    length: $.trim($('.quoteCompanyName').val()).length,
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

        let iBillToCompany = $('.quoteBillToCompany').is(':checked') ? 1 : 0;
        $('.quoteBillToCompany').val(iBillToCompany);

        if (iBillToCompany === 1 && $('.quoteCompanyName').val() === '') {
            return {
                result: false,
                element: '.quoteCompanyName',
                msg: 'Please specify company name if billing to company.'
            };
        }

        if ($('.quoteCourse').val() === '') {
            return {
                result: false,
                element: '.quoteCourse',
                msg: 'Please select a course.'
            };
        }

        let numPaxRegex = /^(?!-\d+|0)\d+$/g;

        if ($('.numPax').val() < 1 || $('.numPax').val() > 100 || numPaxRegex.test($('.numPax').val()) === false) {
            return {
                result: false,
                element: '.numPax',
                msg: 'Invalid value for number of persons.'
            }
        }

        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for quotation.
    validateQuoteRequestInputs(sFormId) {

        let validationResult = {
            result: true
        }

        let quoteInputRules = [];

        // Check if company name has a value.
        if ($.trim($(`form[id="${sFormId}"]`).find('.quoteCompanyName').val()).length !== 0) {
            quoteInputRules.push(
                {
                    name: 'Company name',
                    element: $(`form[id="${sFormId}"]`).find('.quoteCompanyName'),
                    length: $.trim($(`form[id="${sFormId}"]`).find('.quoteCompanyName').val()).length,
                    minLength: 4,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9\s\.]+$/g
                },
            );

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
                if (inputRule.pattern.test(inputRule.element.val()) === false) {
                    validationResult = {
                        result: false,
                        element: inputRule.element,
                        msg: inputRule.name + ' input is invalid.'
                    };
                    return false;
                }
            });

        }

        let iBillToCompany = $(`form[id="${sFormId}"]`).find('.quoteBillToCompany').is(':checked') ? 1 : 0;
        $(`form[id="${sFormId}"]`).find('.quoteBillToCompany').val(iBillToCompany);

        if (iBillToCompany === 1 && $(`form[id="${sFormId}"]`).find('.quoteCompanyName').val() === '') {
            return {
                result: false,
                element: '.quoteCompanyName',
                msg: 'Please specify company name if billing to company.'
            };
        }

        if ($(`form[id="${sFormId}"]`).find('.quoteCourse').val() === '') {
            return {
                result: false,
                element: '.quoteCourse',
                msg: 'Please select a course.'
            };
        }

        let numPaxRegex = /^(?!-\d+|0)\d+$/g;

        if ($('.numPax').val() < 1 || $('.numPax').val() > 100 || numPaxRegex.test($('.numPax').val()) === false) {
            return {
                result: false,
                element: '.numPax',
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
                length: $.trim($('#emailLname').val()).length,
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

    // This method validates the inputs of the user before submission for course addition.
    validateAddUpdateCourseInputs() {
        // Declare an object with properties related to inputs that need to be validated.
        let addCourseRules = [
            {
                name: 'Course code',
                element: '.courseCode',
                length: $.trim($('.courseCode').val()).length,
                minLength: 2,
                maxLength: 10,
                pattern: /^[a-zA-Z0-9&\-\s\.]+$/g,
            },
            {
                name: 'Course title',
                element: '.courseTitle',
                length: $.trim($('.courseTitle').val()).length,
                minLength: 2,
                maxLength: 50,
                pattern: /^[a-zA-Z0-9&\-\s\.]+$/g,
            },
            {
                name: 'Course details',
                element: '.courseDetails',
                length: $.trim($('.courseDetails').val()).length,
                minLength: 0,
                maxLength: 50,
                pattern: /^[a-zA-Z0-9&\-\s\.]+$/g,
            }
        ];

        // Declare initially the validation result to be returned by the function.
        let validationResult = {
            result: true
        }

        // Loop thru each emailInputRules and if there are rules violated, return false and the error message.
        $.each(addCourseRules, function (key, inputRule) {
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

        if (validationResult.result === true) {
            if ($('.courseAmount').val() == '' || $('.courseAmount').val() <= 0) {
                return {
                    result: false,
                    element: '.courseAmount',
                    msg: 'Course amount cannot be empty/zero.'
                };
            }

            if (/^[0-9]+$/g.test($('.courseAmount').val()) === false) {
                return {
                    result: false,
                    element: '.courseAmount',
                    msg: 'Invalid course amount.'
                };
            }
        }

        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for schedule addition/alteration.
    validateScheduleInputs(sFormName) {
        sFormName = sFormName.substr(1);
        // Declare an object with properties related to inputs that need to be validated.
        const aScheduleRules = [
            {
                name: 'Course title',
                element: '.courseTitle',
                length: $.trim($(`form[id="${sFormName}"]`).find('.courseTitle option:selected').text()).length,
                minLength: 2,
                maxLength: 100,
                pattern: /^[\d]+$/g,
            },
            {
                name: 'Venue',
                element: '.courseVenue',
                length: $.trim($(`form[id="${sFormName}"]`).find('.courseVenue option:selected').text()).length,
                minLength: 2,
                maxLength: 50,
                pattern: /^[\d]+$/g,
            },
            {
                name: 'Start date',
                element: '.fromDate',
                length: $.trim($(`form[id="${sFormName}"]`).find('.fromDate').val()).length,
                minLength: 10,
                maxLength: 10,
                pattern: /^\d{4}-\d{2}-\d{2}/g,
            },
            {
                name: 'End date',
                element: '.toDate',
                length: $.trim($(`form[id="${sFormName}"]`).find('.toDate').val()).length,
                minLength: 10,
                maxLength: 10,
                pattern: /^\d{4}-\d{2}-\d{2}/g,
            },
            {
                name: 'Instructor name',
                element: '.courseInstructor',
                length: $.trim($(`form[id="${sFormName}"]`).find('.courseInstructor option:selected').text()).length,
                minLength: 2,
                maxLength: 50,
                pattern: /^[\d]+$/g,
            }
        ];

        // Declare initially the validation result to be returned by the function.
        let validationResult = {
            result: true
        }

        // Loop thru each emailInputRules and if there are rules violated, return false and the error message.
        $.each(aScheduleRules, function (key, inputRule) {
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
            if (inputRule.pattern.test($(`form[id="${sFormName}"]`).find(inputRule.element).val()) === false) {
                validationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' input is invalid.'
                };
                return false;
            }
        });

        let sNumSlotsRegex = /^(?!-\d+|0)\d+$/g;

        if ($('.numSlots').val() < 1 || $('.numSlots').val() > 100 || sNumSlotsRegex.test($('.numSlots').val()) === false) {
            return {
                result: false,
                element: '.numSlots',
                msg: 'Invalid value for number of slots.'
            }
        }

        // Return the result of the validation.
        return validationResult;
    }

    // This method validates the inputs of the user before submission for instructor addition/alteration.
    validateInstructorInputs(sFormName) {
        sFormName = sFormName.substr(1);

        // Declare an object with properties related to inputs that need to be validated.
        let instructorInputRules = [
            {
                name: 'First name',
                element: '.firstName',
                length: $.trim($(`form[id="${sFormName}"]`).find('.firstName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.lastName',
                length: $.trim($(`form[id="${sFormName}"]`).find('.lastName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '.contactNum',
                length: $.trim($(`form[id="${sFormName}"]`).find('.contactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '.email',
                length: $.trim($(`form[id="${sFormName}"]`).find('.email').val()).length,
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
        if ($.trim($('.middleName').val()).length !== 0) {
            instructorInputRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '.middleName',
                    length: $.trim($(`form[id="${sFormName}"]`).find('.middleName').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Check if certification title has a value.
        if ($.trim($('.certificationTitle').val()).length !== 0) {
            instructorInputRules.splice(1, 0,
                {
                    name: 'Certification title',
                    element: '.certificationTitle',
                    length: $.trim($(`form[id="${sFormName}"]`).find('.certificationTitle').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z0-9,-\s]+$/g
                },
            );
        }

        // Loop thru each instructorInputRules and if there are rules violated, return false and the error message.
        $.each(instructorInputRules, function (key, inputRule) {
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
            if (inputRule.pattern.test($(`form[id="${sFormName}"]`).find(inputRule.element).val()) === false) {
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