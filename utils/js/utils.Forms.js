var oForms = (() => {

    function prepareDomEvents() {
        // Allow only alphabetical characters and a period on first, middle, and last name via RegExp.
        $(document).on('keyup keydown', '#registrationFname, #registrationMname, #registrationLname, .quoteFname, .quoteMname, .quoteLname, #emailFname, #emailMname, #emailLname', function () {
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

        $(document).on('keyup keydown', '#registrationContactNum, .quoteContactNum', function () {
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
        $(document).on('focusout', '#registrationFname, #registrationMname, #registrationLname, #registrationCompany, .quoteFname, .quoteMname, .quoteLname, .quoteCompanyName', function () {
            $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\.+/g, '.').trim());
        });

        // Remove red border on focus event on any input.
        $(document).on('focus', 'input, select', function () {
            $(this).css('border', '1px solid #ccc');
        });

        prepareCourseEvents();
        prepareVenueEvents();
        prepareInstructorEvents();
    }

    /**
     * prepareCourseEvents
     * jQuery event handlers for courses.php
     */
    function prepareCourseEvents() {
        // Trim excess spaces and dots on specific inputs via RegExp on focusout event.
        $(document).on('focusout', '.courseCode, .courseTitle, .courseDetails', function () {
            $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\.+/g, '.').trim());
        });

        $(document).on('keyup keydown', '.courseCode, .courseTitle, .courseDetails', function () {
            // Input must always start by an numeric character.
            if (this.value.length === 1 && this.value.match(/[^a-zA-Z0-9]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^a-zA-Z0-9&\-\s\.]/g, '');
        });

        $(document).on('keyup keydown', '.courseAmount', function () {
            // Input must always start by a numeric character.
            if (this.value.length === 1 && this.value.match(/[^1-9]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    /**
     * prepareVenueEvents
     * jQuery event handlers for courses.php
     */
    function prepareVenueEvents() {
        // Trim excess spaces and dots on specific inputs via RegExp on focusout event.
        $(document).on('focusout', '.branch, .branchAddress, .branchContact', function () {
            $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\.+/g, '.').trim());
        });
    }

    // Toggle disabled state of the form.
    function disableFormState(formName, state) {
        $(formName).find('div[class="modal-footer"] button').prop('disabled', state);
        $(formName).prop('disabled', state);
    }

    // Remove existing red borders on inputs.
    function resetInputBorders(formName) {
        $(formName).find('input, select').css('border', '1px solid #ccc');
    }

    // Clone courseAndScheduleDiv based on the count fetched from DB.
    function cloneDivElements(iCount) {
        for (let i = 1; i < iCount; i++) {
            let oCourseScheduleDiv = $('.courseAndScheduleDiv:last').clone();
            oCourseScheduleDiv.insertAfter('.courseAndScheduleDiv:last').css('display', 'none');

            let oCourseScheduleDivNew = $('.courseAndScheduleDiv-new:last').clone();
            oCourseScheduleDivNew.insertAfter('.courseAndScheduleDiv-new:last').css('display', 'none');
        }
    }

    /**
     * prepareInstructorEvents
     * jQuery event handlers for instructors.php
     */
    function prepareInstructorEvents() {
        // Allow only alphabetical characters and a period on first, middle, and last name via RegExp.
        $(document).on('keyup keydown', '.firstName, .middleName, .lastName', function () {
            // Input must not start by a period.
            if (this.value.length === 1 && this.value.match(/[^a-zA-Z]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^a-zA-Z\s\.]/g, '');
        });

        $(document).on('keyup keydown', '.contactNum', function () {
            return this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Trim excess spaces and dots on specific inputs via RegExp on focusout event.
        $(document).on('focusout', '.firstName, .middleName, .lastName, .email', function () {
            $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\.+/g, '.').trim());
        });

        // Trim excess spaces and dots on certification title input via RegExp on focusout event.
        $(document).on('focusout', '.certificationTitle', function () {
            // Input must not start by a period.
            if (this.value.length === 1 && this.value.match(/[^,]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            $(this).val($(this).val().replace(/\s+/g, ' ').replace(/\,+/g, ',').replace(/\,$/g, '').trim());
        });
    }

    // Return public pointers.
    return {
        prepareDomEvents,
        disableFormState,
        resetInputBorders,
        cloneDivElements
    };

})();