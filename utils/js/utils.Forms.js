var oForms = (() => {

    function prepareDomEvents() {
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

    // Return public pointers.
    return {
        prepareDomEvents,
        disableFormState,
        resetInputBorders,
        cloneDivElements
    };

})();