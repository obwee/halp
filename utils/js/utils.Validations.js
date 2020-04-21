class Validations {

    /**
     * validateRegisterInputs
     * Validates the inputs of the user before submission for registration.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateRegisterInputs(sFormId) {

        // Declare an object with properties related to inputs that need to be validated.
        let aRegisterInputRules = [
            {
                name: 'First name',
                element: '#registrationFname',
                length: $.trim($(sFormId).find('#registrationFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '#registrationLname',
                length: $.trim($(sFormId).find('#registrationLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '#registrationContactNum',
                length: $.trim($(sFormId).find('#registrationContactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '#registrationEmail',
                length: $.trim($(sFormId).find('#registrationEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Username',
                element: '#registrationUsername',
                length: $.trim($(sFormId).find('#registrationUsername').val()).length,
                minLength: 4,
                maxLength: 15,
                pattern: /^(?![0-9_])\w+$/g
            },
            {
                name: 'Password',
                element: '#registrationPassword',
                length: $.trim($(sFormId).find('#registrationPassword').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
            {
                name: 'Password',
                element: '#registrationConfirmPassword',
                length: $.trim($(sFormId).find('#registrationConfirmPassword').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
        ];

        // Check if middle name has a value.
        if ($.trim($(sFormId).find('#registrationMname').val()).length !== 0) {
            aRegisterInputRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '#registrationMname',
                    length: $.trim($(sFormId).find('#registrationMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }
        // Check if company name has a value.
        if ($.trim($(sFormId).find('#registrationCompanyName').val()).length !== 0) {
            aRegisterInputRules.splice(4, 0,
                {
                    name: 'Company name',
                    element: '#registrationCompanyName',
                    length: $.trim($(sFormId).find('#registrationCompanyName').val()).length,
                    minLength: 4,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9\s\.]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aRegisterInputRules, sFormId);

        if (oValidationResult.result === true) {
            // Check if passwords are equal.
            if ($(sFormId).find('#registrationPassword').val() !== $(sFormId).find('#registrationConfirmPassword').val()) {
                oValidationResult = {
                    result: false,
                    element: '#registrationPassword, #registrationConfirmPassword',
                    msg: 'Passwords do not match.'
                };
            }
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateQuoteInputs
     * Validates the inputs of the user before submission for quotation.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateQuoteInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aQuoteInputRules = [
            {
                name: 'First name',
                element: '.quoteFname',
                length: $.trim($(sFormId).find('.quoteFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.quoteLname',
                length: $.trim($(sFormId).find('.quoteLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '.quoteContactNum',
                length: $.trim($(sFormId).find('.quoteContactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '.quoteEmail',
                length: $.trim($(sFormId).find('.quoteEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            }
        ];

        // Check if middle name has a value.
        if ($.trim($(sFormId).find('.quoteMname').val()).length !== 0) {
            aQuoteInputRules.push(
                {
                    name: 'Middle name',
                    element: '.quoteMname',
                    length: $.trim($(sFormId).find('.quoteMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Check if company name has a value.
        if ($.trim($(sFormId).find('.quoteCompanyName').val()).length !== 0) {
            aQuoteInputRules.push(
                {
                    name: 'Company name',
                    element: '.quoteCompanyName',
                    length: $.trim($(sFormId).find('.quoteCompanyName').val()).length,
                    minLength: 4,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9\s\.]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aQuoteInputRules, sFormId);

        if (oValidationResult.result === true) {
            let iBillToCompany = $(sFormId).find('.quoteBillToCompany').is(':checked') ? 1 : 0;
            $(sFormId).find('.quoteBillToCompany').val(iBillToCompany);

            if (iBillToCompany === 1 && $(sFormId).find('.quoteCompanyName').val() === '') {
                return {
                    result: false,
                    element: '.quoteCompanyName',
                    msg: 'Please specify company name if billing to company.'
                };
            }

            if ($(sFormId).find('.quoteCourse').val() === '') {
                return {
                    result: false,
                    element: '.quoteCourse',
                    msg: 'Please select a course.'
                };
            }

            let numPaxRegex = /^(?!-\d+|0)\d+$/g;

            if ($(sFormId).find('.numPax').val() < 1 || $(sFormId).find('.numPax').val() > 100 || numPaxRegex.test($(sFormId).find('.numPax').val()) === false) {
                return {
                    result: false,
                    element: '.numPax',
                    msg: 'Invalid value for number of persons.'
                }
            }
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateQuoteRequestInputs
     * Validates the inputs of the user before submission for quotation.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateQuoteRequestInputs(sFormId) {

        let aQuoteInputRules = [];

        // Check if company name has a value.
        if ($.trim($(sFormId).find('.quoteCompanyName').val()).length !== 0) {
            aQuoteInputRules.push(
                {
                    name: 'Company name',
                    element: $(sFormId).find('.quoteCompanyName'),
                    length: $.trim($(sFormId).find('.quoteCompanyName').val()).length,
                    minLength: 4,
                    maxLength: 50,
                    pattern: /^[a-zA-Z0-9\s\.]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aQuoteInputRules, sFormId);

        if (oValidationResult.result === true) {
            let iBillToCompany = $(sFormId).find('.quoteBillToCompany').is(':checked') ? 1 : 0;
            $(sFormId).find('.quoteBillToCompany').val(iBillToCompany);

            if (iBillToCompany === 1 && $(sFormId).find('.quoteCompanyName').val() === '') {
                return {
                    result: false,
                    element: '.quoteCompanyName',
                    msg: 'Please specify company name if billing to company.'
                };
            }

            if ($(sFormId).find('.quoteCourse').val() === '') {
                return {
                    result: false,
                    element: '.quoteCourse',
                    msg: 'Please select a course.'
                };
            }

            let numPaxRegex = /^(?!-\d+|0)\d+$/g;

            if ($(sFormId).find('.numPax').val() < 1 || $(sFormId).find('.numPax').val() > 100 || numPaxRegex.test($(sFormId).find('.numPax').val()) === false) {
                return {
                    result: false,
                    element: '.numPax',
                    msg: 'Invalid value for number of persons.'
                }
            }
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateEmailUsInputs
     * Validates the inputs of the user before submission for emailing.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateEmailUsInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aEmailInputRules = [
            {
                name: 'First name',
                element: '#emailFname',
                length: $.trim($(sFormId).find('#emailFname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '#emailLname',
                length: $.trim($(sFormId).find('#emailLname').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Email address',
                element: '#emailAddress',
                length: $.trim($(sFormId).find('#emailAddress').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Email title',
                element: '#emailTitle',
                length: $.trim($(sFormId).find('#emailTitle').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
            {
                name: 'Email message',
                element: '#emailMsg',
                length: $.trim($(sFormId).find('#emailMsg').val()).length,
                minLength: 4,
                maxLength: 255
            }
        ];

        // Check if middle name has a value.
        if ($.trim($('#emailMname').val()).length !== 0) {
            aEmailInputRules.push(
                {
                    name: 'Middle name',
                    element: '#emailMname',
                    length: $.trim($(sFormId).find('#emailMname').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aEmailInputRules, sFormId);

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateAddUpdateCourseInputs
     * Validates the inputs of the user before submission for course addition.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateAddUpdateCourseInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aAddCourseRules = [
            {
                name: 'Course code',
                element: '.courseCode',
                length: $.trim($(sFormId).find('.courseCode').val()).length,
                minLength: 2,
                maxLength: 10,
                pattern: /^[a-zA-Z0-9&\-\s\.]+$/g,
            },
            {
                name: 'Course title',
                element: '.courseTitle',
                length: $.trim($(sFormId).find('.courseTitle').val()).length,
                minLength: 2,
                maxLength: 50,
                pattern: /^[a-zA-Z0-9&\-\s\.]+$/g,
            },
            {
                name: 'Course details',
                element: '.courseDetails',
                length: $.trim($(sFormId).find('.courseDetails').val()).length,
                minLength: 0,
                maxLength: 50,
                pattern: /^[a-zA-Z0-9&\-\s\.]+$/g,
            }
        ];

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aAddCourseRules, sFormId);

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateScheduleInputs
     * Validates the inputs of the user before submission for schedule addition/alteration.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateScheduleInputs(sFormId) {        // Declare an object with properties related to inputs that need to be validated.
        const aScheduleRules = [
            {
                name: 'Course title',
                element: '.courseTitle',
                length: $.trim($(sFormId).find('.courseTitle option:selected').text()).length,
                minLength: 2,
                maxLength: 100,
                pattern: /^[\d]+$/g,
            },
            {
                name: 'Venue',
                element: '.courseVenue',
                length: $.trim($(sFormId).find('.courseVenue option:selected').text()).length,
                minLength: 2,
                maxLength: 50,
                pattern: /^[\d]+$/g,
            },
            {
                name: 'Start date',
                element: '.fromDate',
                length: $.trim($(sFormId).find('.fromDate').val()).length,
                minLength: 10,
                maxLength: 10,
                pattern: /^\d{4}-\d{2}-\d{2}/g,
            },
            {
                name: 'End date',
                element: '.toDate',
                length: $.trim($(sFormId).find('.toDate').val()).length,
                minLength: 10,
                maxLength: 10,
                pattern: /^\d{4}-\d{2}-\d{2}/g,
            },
            {
                name: 'Instructor name',
                element: '.courseInstructor',
                length: $.trim($(sFormId).find('.courseInstructor option:selected').text()).length,
                minLength: 2,
                maxLength: 50,
                pattern: /^[\d]+$/g,
            }
        ];

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aScheduleRules, sFormId);

        if (oValidationResult.result === true) {

            let sCoursePriceRegex = /^(?!-\d+|0)\d+$/g;

            if ($(sFormId).find('.coursePrice').val() < 1 || sCoursePriceRegex.test($(sFormId).find('.coursePrice').val()) === false) {
                return {
                    result: false,
                    element: '.coursePrice',
                    msg: 'Invalid value for course price.'
                }
            }

            let sNumSlotsRegex = /^(?!-\d+|0)\d+$/g;

            if ($('.numSlots').val() < 1 || $('.numSlots').val() > 100 || sNumSlotsRegex.test($('.numSlots').val()) === false) {
                return {
                    result: false,
                    element: '.numSlots',
                    msg: 'Invalid value for number of slots.'
                }
            }
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateInstructorInputs
     * Validates the inputs before inserting instructor.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateInstructorInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aInstructorInputRules = [
            {
                name: 'First name',
                element: '.firstName',
                length: $.trim($(sFormId).find('.firstName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.lastName',
                length: $.trim($(sFormId).find('.lastName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '.contactNum',
                length: $.trim($(sFormId).find('.contactNum').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '.email',
                length: $.trim($(sFormId).find('.email').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            }
        ];

        // Check if middle name has a value.
        if ($.trim($('.middleName').val()).length !== 0) {
            aInstructorInputRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '.middleName',
                    length: $.trim($(sFormId).find('.middleName').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Check if certification title has a value.
        if ($.trim($('.certificationTitle').val()).length !== 0) {
            aInstructorInputRules.splice(1, 0,
                {
                    name: 'Certification title',
                    element: '.certificationTitle',
                    length: $.trim($(sFormId).find('.certificationTitle').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z0-9,-\s]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aInstructorInputRules, sFormId);

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateChangeInstructorInputs
     * Validates the inputs before changing instructors.
     * @param {string} oFormData (The data.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateChangeInstructorInputs(oFormData) {
        // Declare initially the validation result to be returned by the function.
        let oValidationResult = {
            result: true
        }

        // Get instructor dropdowns without values.
        const oElementWithNoValue = $('.courseInstructors').filter(function () {
            return $(this).val() === null
        })[0];

        if (oElementWithNoValue === undefined) {
            // Get instructor dropdowns with invalid values.
            const oElementWithInvalidValue = $('.courseInstructors').filter(function () {
                return /^[^\d]+$/.test($(this).val()) === true;
            })[0];

            $.each(oFormData, (iKey, oData) => {
                if (/^[0-9]+$/.test(oData.value) === false) {
                    oValidationResult = {
                        result: false,
                        element: oElementWithInvalidValue,
                        msg: 'Invalid instructor.'
                    };
                    return false;
                }
            });
        } else {
            oValidationResult = {
                result: false,
                element: oElementWithNoValue,
                msg: 'Please fill-up all the instructor fields.'
            };
        }

        return oValidationResult;
    }

    /**
     * validateMessageInstructorInputs
     * Validates the inputs before messaging the instructor.
     * @param {string} sFormId (Form ID.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateMessageInstructorInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aEmailInputRules = [
            {
                name: 'Email title',
                element: '.title',
                length: $.trim($('.title').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
            {
                name: 'Email message',
                element: '.msg',
                length: $.trim($('.msg').val()).length,
                minLength: 4,
                maxLength: 255,
                pattern: /.+/g
            }
        ];

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aEmailInputRules, sFormId);
        let oFile = $('.file').prop('files')[0];

        if (oValidationResult.result === true && oFile !== undefined) {
            oValidationResult = this.validateFileForMessagingInstructor(oFile);
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateChangeVenueInputs
     * Validates the inputs before changing venues.
     * @param {string} oFormData (The data.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateChangeVenueInputs(oFormData) {
        // Declare initially the validation result to be returned by the function.
        let oValidationResult = {
            result: true
        }

        // Get venue dropdowns without values.
        const oElementWithNoValue = $('.venues').filter(function () {
            return $(this).val() === null
        })[0];

        if (oElementWithNoValue === undefined) {
            // Get venue dropdowns with invalid values.
            const oElementWithInvalidValue = $('.venues').filter(function () {
                return /^[^\d]+$/.test($(this).val()) === true;
            })[0];

            $.each(oFormData, (iKey, oData) => {
                if (/^[0-9]+$/.test(oData.value) === false) {
                    oValidationResult = {
                        result: false,
                        element: oElementWithInvalidValue,
                        msg: 'Invalid venue.'
                    };
                    return false;
                }
            });
        } else {
            oValidationResult = {
                result: false,
                element: oElementWithNoValue,
                msg: 'Please fill-up all the venue fields.'
            };
        }
        return oValidationResult;
    }

    /**
     * validateChangeCourseInputs
     * Validates the inputs before changing venues.
     * @param {string} oFormData (The data.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateChangeCourseInputs(oFormData) {
        // Declare initially the validation result to be returned by the function.
        let oValidationResult = {
            result: true
        }

        // Get course dropdowns without values.
        const oElementWithNoValue = $('.courses').filter(function () {
            return $(this).val() === null
        })[0];

        if (oElementWithNoValue === undefined) {
            // Get course dropdowns with invalid values.
            const oElementWithInvalidValue = $('.courses').filter(function () {
                return /^[^\d]+$/.test($(this).val()) === true;
            })[0];

            $.each(oFormData, (iKey, oData) => {
                if (/^[0-9]+$/.test(oData.value) === false) {
                    oValidationResult = {
                        result: false,
                        element: oElementWithInvalidValue,
                        msg: 'Invalid course.'
                    };
                    return false;
                }
            });
        } else {
            oValidationResult = {
                result: false,
                element: oElementWithNoValue,
                msg: 'Please fill-up all the course fields.'
            };
        }
        return oValidationResult;
    }

    /**
     * validateFileForMessagingInstructor
     * Validates the file uploaded for messaging instructor.
     * @param {object} oFile (The file object.)
     * @return {object} oFileValidation (Result of the validation.)
     */
    validateFileForMessagingInstructor(oFile) {
        let oFileValidation = {
            result: true
        };

        let aFileInputRules = [
            {
                name: 'File',
                element: '.file',
                maxSize: 10485760,
                pattern: /(\.pdf)$/i
            },
        ];

        $.each(aFileInputRules, function (iKey, oInputRule) {
            // Test if file is a PDF file.
            if (!oInputRule.pattern.exec(oFile.name)) {
                oFileValidation = {
                    result: false,
                    element: oInputRule.element,
                    msg: 'File must be PDF.'
                };
                return false;
            }

            // Test if file size exceeds 10 MB.
            if (oFile.size > oInputRule.maxSize) {
                oFileValidation = {
                    result: false,
                    element: '.file',
                    msg: 'File must not exceed 10 MB.'
                };
            }
            return false;
        });

        return oFileValidation;
    }

    /**
     * validateEditAdminInputs
     * Validates the inputs before editing the admin details.
     * @param {string} sFormId (Form ID.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateEditAdminInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aEditAdminRules = [
            {
                name: 'First name',
                element: '.adminFirstName',
                length: $.trim($(sFormId).find('.adminFirstName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.adminLastName',
                length: $.trim($(sFormId).find('.adminLastName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '.adminContact',
                length: $.trim($(sFormId).find('.adminContact').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '.adminEmail',
                length: $.trim($(sFormId).find('.adminEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Username',
                element: '.adminUsername',
                length: $.trim($(sFormId).find('.adminUsername').val()).length,
                minLength: 4,
                maxLength: 15,
                pattern: /^(?![0-9_])\w+$/g
            }
        ];

        // Check if middle name has a value.
        if ($.trim($('.adminMiddleName').val()).length !== 0) {
            aEditAdminRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '.adminMiddleName',
                    length: $.trim($(sFormId).find('.adminMiddleName').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Return the result of the validation.
        return this.loopThruRulesForErrors(aEditAdminRules, sFormId);
    }

    /**
     * validateAddAdminInputs
     * Validates the inputs of the user before submission for adding admin.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateAddAdminInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aAddAdminRules = [
            {
                name: 'First name',
                element: '.adminFirstName',
                length: $.trim($(sFormId).find('.adminFirstName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.adminLastName',
                length: $.trim($(sFormId).find('.adminLastName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Contact number',
                element: '.adminContact',
                length: $.trim($(sFormId).find('.adminContact').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            },
            {
                name: 'Email address',
                element: '.adminEmail',
                length: $.trim($(sFormId).find('.adminEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Username',
                element: '.adminUsername',
                length: $.trim($(sFormId).find('.adminUsername').val()).length,
                minLength: 4,
                maxLength: 15,
                pattern: /^(?![0-9_])\w+$/g
            },
            {
                name: 'Password',
                element: '.adminPassword',
                length: $.trim($(sFormId).find('.adminPassword').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
            {
                name: 'Password',
                element: '.adminConfirmPassword',
                length: $.trim($(sFormId).find('.adminConfirmPassword').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            }
        ];

        // Check if middle name has a value.
        if ($.trim($(sFormId).find('.adminMiddleName').val()).length !== 0) {
            aAddAdminRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '.adminMiddleName',
                    length: $.trim($(sFormId).find('.adminMiddleName').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aAddAdminRules, sFormId);

        if (oValidationResult.result === true) {
            // Check if passwords are equal.
            if ($(sFormId).find('.adminPassword').val() !== $(sFormId).find('.adminConfirmPassword').val()) {
                oValidationResult = {
                    result: false,
                    element: '.adminPassword, .adminConfirmPassword',
                    msg: 'Passwords do not match.'
                };
            }
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateEditPersonalDetailsInputs
     * Validates the inputs of the user before submission for editing personal details.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateEditPersonalDetailsInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aAddAdminRules = [
            {
                name: 'First name',
                element: '.adminFirstName',
                length: $.trim($(sFormId).find('.adminFirstName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Last name',
                element: '.adminLastName',
                length: $.trim($(sFormId).find('.adminLastName').val()).length,
                minLength: 2,
                maxLength: 30,
                pattern: /^[a-zA-Z\s\.]+$/g
            },
            {
                name: 'Email address',
                element: '.adminEmail',
                length: $.trim($(sFormId).find('.adminEmail').val()).length,
                minLength: 4,
                maxLength: 50,
                pattern: /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g
            },
            {
                name: 'Contact number',
                element: '.adminContact',
                length: $.trim($(sFormId).find('.adminContact').val()).length,
                minLength: 7,
                maxLength: 12,
                pattern: /^[0-9]+$/g
            }
        ];

        // Check if middle name has a value.
        if ($.trim($(sFormId).find('.adminMiddleName').val()).length !== 0) {
            aAddAdminRules.splice(1, 0,
                {
                    name: 'Middle name',
                    element: '.adminMiddleName',
                    length: $.trim($(sFormId).find('.adminMiddleName').val()).length,
                    minLength: 2,
                    maxLength: 30,
                    pattern: /^[a-zA-Z\s\.]+$/g
                },
            );
        }

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aAddAdminRules, sFormId);

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validateEditOwnCredentialsInputs
     * Validates the inputs of the user before submission for editing login credentials.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateEditOwnCredentialsInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aAddAdminRules = [
            {
                name: 'Username',
                element: '.adminUsername',
                length: $.trim($(sFormId).find('.adminUsername').val()).length,
                minLength: 4,
                maxLength: 15,
                pattern: /^(?![0-9_])\w+$/g
            },
            {
                name: 'Password',
                element: '.adminPassword',
                length: $.trim($(sFormId).find('.adminPassword').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
            {
                name: 'Password',
                element: '.adminConfirmPassword',
                length: $.trim($(sFormId).find('.adminConfirmPassword').val()).length,
                minLength: 4,
                maxLength: 30,
                pattern: /.+/g
            },
        ];

        // Loop thru each rules to check if there are rules violated.
        let oValidationResult = this.loopThruRulesForErrors(aAddAdminRules, sFormId);

        if (oValidationResult.result === true) {
            // Check if passwords are equal.
            if ($(sFormId).find('.adminPassword').val() !== $(sFormId).find('.adminConfirmPassword').val()) {
                oValidationResult = {
                    result: false,
                    element: '.adminPassword, .adminConfirmPassword',
                    msg: 'Passwords do not match.'
                };
            }
        }

        // Return the result of the validation.
        return oValidationResult;
    }

    /**
     * validatePaymentModeInputs
     * Validates the inputs of the user before submission for adding/editing payment modes.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validatePaymentModeInputs(sFormId) {
        // Declare an object with properties related to inputs that need to be validated.
        let aPaymentModeInputs = [
            {
                name: 'Payment method',
                element: '.paymentMode',
                length: $.trim($(sFormId).find('.paymentMode').val()).length,
                minLength: 2,
                maxLength: 20,
                pattern: /^[a-zA-Z\s\.\-]+$/g
            }
        ];

        // Loop thru each rules to check if there are rules violated and return the result.
        return this.loopThruRulesForErrors(aPaymentModeInputs, sFormId);
    }

    /**
     * validateEnrollmentInputs
     * Validates the inputs of the user before submission for enrolling a new schedule.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateEnrollmentInputs(sFormId) {
        // Declare initially the validation result to be returned by the function.
        let oValidationResult = {
            result: true
        }

        if ($(sFormId).find('.courses').val() === null) {
            return {
                result: false,
                element: '.courses',
                msg: 'Please select a course.'
            };
        }

        if ($(sFormId).find('.schedules').val() === null) {
            return {
                result: false,
                element: '.schedules',
                msg: 'Please select a schedule.'
            };
        }

        $.each($(sFormId).serializeArray(), (iKey, oElement) => {
            if (/^[0-9]+$/.test(oElement.value) === false) {
                oValidationResult = {
                    result: false,
                    element: `.${oElement.name}`,
                    msg: `Invalid ${(oElement.value === 'courses') ? 'course' : 'schedule'}.`
                };
                return false;
            }
        });
        return oValidationResult;
    }

    /**
     * validateFileForPayment
     * Validates the file uploaded for payment.
     * @param {string} sFormId (The form id.)
     * @return {object} oFileValidation (Result of the validation.)
     */
    validateFileForPayment(sFormId) {
        let oFile = $('.paymentFile').prop('files')[0];

        if (oFile === undefined) {
            return {
                result: false,
                element: '.paymentFile',
                msg: 'Please select a file as proof of payment.'
            }
        }

        let oFileValidation = {
            result: true
        };

        let aFileInputRules = [
            {
                name: 'File',
                element: '.paymentFile',
                maxSize: 10485760,
                pattern: /(\.jpg)|(\.jpeg)|(\.png)$/i
            },
        ];

        $.each(aFileInputRules, function (iKey, oInputRule) {
            // Test if file is a PDF file.
            if (!oInputRule.pattern.exec(oFile.name)) {
                oFileValidation = {
                    result: false,
                    element: oInputRule.element,
                    msg: 'File must be JPEG/JPG, or PNG.'
                };
                return false;
            }

            // Test if file size exceeds 10 MB.
            if (oFile.size > oInputRule.maxSize) {
                oFileValidation = {
                    result: false,
                    element: oInputRule.element,
                    msg: 'File must not exceed 10 MB.'
                };
            }
            return false;
        });

        return oFileValidation;
    }

    /**
     * validateApprovePaymentInputs
     * Validates the payment inputs before approval.
     * @param {string} sFormId (The form id.)
     * @return {object} oValidation (Result of the validation.)
     */
    validateApprovePaymentInputs(sFormId) {
        // Declare initially the validation result to be returned by the function.
        let oValidationResult = {
            result: true
        }

        let aApprovePaymentRules = [
            {
                name: 'mode of payment',
                element: '.modeOfPayment',
                value: $(sFormId).find('.modeOfPayment').val(),
                pattern: /^[0-9]+$/
            },
            {
                name: 'payment amount',
                element: '.paymentAmount',
                value: $(sFormId).find('.paymentAmount').val(),
                pattern: /^[0-9]+$/
            },
            {
                name: 'old balance',
                element: '.oldBalance',
                value: $(sFormId).find('.oldBalance').val().replace(',', ''),
                pattern: /^[0-9]+$/
            },
            {
                name: 'new balance',
                element: '.newBalance',
                value: $(sFormId).find('.newBalance').val().replace(',', ''),
                pattern: /^[0-9]+$/
            },
        ];

        if (/^[0-9]+$/.test($(sFormId).find('.paymentId').val()) === false) {
            return {
                result: false,
                element: '.paymentId',
                msg: `Invalid payment.`
            }
        }

        const aNotAllowedValues = [null, '', 0];

        $.each(aApprovePaymentRules, function (key, inputRule) {
            // Check if payment amount is greater than the original balance.
            if (key === 1) {
                if (parseInt(inputRule.value, 10) > parseInt(aApprovePaymentRules[key + 1].value, 10)) {
                    oValidationResult = {
                        result: false,
                        element: inputRule.element,
                        msg: `Invalid payment amount.`
                    };
                    return false;
                }
            }

            if (aNotAllowedValues.includes(inputRule.value) === true) {
                oValidationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: `Please indicate the ${inputRule.name}.`
                };
                return false;
            }
            if (inputRule.pattern.test(inputRule.value) === false) {
                oValidationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: `Invalid value for ${inputRule.name}.`
                };
                return false;
            }
        });

        return oValidationResult;
    }

    /**
     * validateCancelReservationForm
     * Validates the cancel reservation inputs before submission.
     * @param {string} sFormId (The form id.)
     * @return {object} oValidation (Result of the validation.)
     */
    validateCancelReservationForm(sFormId) {
        if ($(sFormId).find('.refundReason').val() === '') {
            return {
                result: false,
                element: '.refundReason',
                msg: `Please state your reason for refunding.`
            };
        }
        if ($(sFormId).find('.agreementCheckbox').is(':checked') === false) {
            return {
                result: false,
                element: '.agreementCheckbox',
                msg: `Please confirm if you agree to the terms and conditions.`
            };
        }
        return { result: true };
    }

    /**
     * validateAddWalkInInputs
     * Validates the inputs of the user before submission for adding walk-in.
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    validateAddWalkInInputs(sFormId) {
        // Declare initially the validation result to be returned by the function.
        let oValidationResult = {
            result: true
        }

        let aAddWalkInElements = [
            {
                name: 'student name',
                value: $(sFormId).find('.studentId').val(),
                class: '.studentId',
                elementToHighlight: '.studentName'
            },
            {
                name: 'course',
                value: $(sFormId).find('.courseDropdown').val(),
                class: '.courseDropdown',
                elementToHighlight: '.courseDropdown'
            },
            {
                name: 'schedule',
                value: $(sFormId).find('.scheduleDropdown').val(),
                class: '.scheduleDropdown',
                elementToHighlight: '.scheduleDropdown'
            }
        ];

        const aNotAllowedValues = [null, '', 0];

        $.each(aAddWalkInElements, (iKey, oProperty) => {
            if (aNotAllowedValues.includes(oProperty.value) === true) {
                oValidationResult = {
                    result: false,
                    element: oProperty.elementToHighlight,
                    msg: `Please indicate ${oProperty.name}.`
                };
                return false;
            }
            if (/^[0-9]+$/.test(oProperty.value) === false) {
                oValidationResult = {
                    result: false,
                    element: oProperty.elementToHighlight,
                    msg: `Invalid ${oProperty.name}.`
                };
                return false;
            }
        });

        return oValidationResult;
    }

    /**
     * loopThruRulesForErrors
     * @param {array} aRules (Array of rules.)
     * @param {string} sFormId (The id of the form.)
     * @return {object} oValidationResult (Result of the validation.)
     */
    loopThruRulesForErrors(aRules, sFormId) {
        let oValidationResult = {
            result: true
        }

        $.each(aRules, function (key, inputRule) {
            if (inputRule.length < inputRule.minLength) {
                oValidationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be minimum of ' + inputRule.minLength + ' characters.'
                };
                return false;
            }
            if (inputRule.length > inputRule.maxLength) {
                oValidationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' must be maximum of ' + inputRule.maxLength + ' characters.'
                };
                return false;
            }
            if (inputRule.pattern.test($(sFormId).find(inputRule.element).val()) === false) {
                oValidationResult = {
                    result: false,
                    element: inputRule.element,
                    msg: inputRule.name + ' input is invalid.'
                };
                return false;
            }
        });

        return oValidationResult;
    }
};

const oValidations = new Validations();