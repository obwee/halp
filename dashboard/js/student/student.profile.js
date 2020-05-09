let oProfile = (() => {

    let oAdminDetails = {};

    let oPersonalDetailsForm = $('#personalDetailsForm');

    let oLoginCredentialsForm = $('#loginCredentialsForm');

    /**
     * init
     * Constructor-like method to be called on document ready.
     */
    function init() {
        fetchDetails();
        setEvents();
    }

    /**
     * setEvents
     * Prepares DOM events.
     */
    function setEvents() {

        oForms.prepareProfileEvents();

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oInputForms = {
                '#personalDetailsForm': {
                    'validationMethod': oValidations.validateUpdateProfileDetails(sFormId),
                    'requestClass': 'Student',
                    'requestAction': 'updateProfileDetails',
                    'alertTitle': 'Update personal details?',
                    'alertText': 'This will update your personal details.'
                },
                '#loginCredentialsForm': {
                    'validationMethod': oValidations.validateUpdateLoginCredentials(sFormId),
                    'requestClass': 'Student',
                    'requestAction': 'updateLoginCredentials',
                    'alertTitle': 'Update credentials?',
                    'alertText': 'This will update your login credentials.'
                }
            }

            // Validate the inputs of the submitted form and store the result inside oValidateInputs variable.
            let oValidateInputs = oInputForms[sFormId].validationMethod;

            if (oValidateInputs.result === true) {
                Swal.fire({
                    title: oInputForms[sFormId].alertTitle,
                    text: oInputForms[sFormId].alertText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((bIsConfirm) => {
                    if (bIsConfirm.value === true) {
                        executeSubmit(sFormId, oInputForms[sFormId].requestClass, oInputForms[sFormId].requestAction);
                    }
                });
            } else {
                oLibraries.displayErrorMessage(sFormId, oValidateInputs.msg, oValidateInputs.element);
            }
            // Enable the form.
            oForms.disableFormState(sFormId, false);
        });
    }

    /**
     * executeSubmit
     * @param {string} sFormId
     * @param {string} sRequestClass
     * @param {string} sRequestAction
     */
    function executeSubmit(sFormId, sRequestClass, sRequestAction) {
        const oFormData = new FormData($(sFormId)[0])
        // Execute AJAX.
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=${sRequestClass}&action=${sRequestAction}`,
            type: 'POST',
            data: oFormData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.spinner').css('display', 'block');
            },
            success: (oResponse) => {
                if (oResponse.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    fetchDetails();
                } else {
                    oLibraries.displayErrorMessage(sFormId, oResponse.sMsg, oResponse.sElement);
                }
            },
            complete: () => {
                $('.spinner').css('display', 'none');
            }
        });
    }

    function populateDetails() {
        oPersonalDetailsForm.find('input').val('');
        oPersonalDetailsForm.find('#firstName').val(oAdminDetails.firstName);
        oPersonalDetailsForm.find('#middleName').val(oAdminDetails.middleName);
        oPersonalDetailsForm.find('#lastName').val(oAdminDetails.lastName);
        oPersonalDetailsForm.find('#contactNum').val(oAdminDetails.contactNum);
        oPersonalDetailsForm.find('#email').val(oAdminDetails.email);
        oPersonalDetailsForm.find('#companyName').val(oAdminDetails.companyName);

        oLoginCredentialsForm.find('input').val('');
        oLoginCredentialsForm.find('#username').val(oAdminDetails.username);
    }

    /**
     * fetchDetails
     */
    function fetchDetails() {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Student&action=fetchStudentCredentials',
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                oAdminDetails = oResponse;
                populateDetails();
            }
        });
    }

    /**
     * Return public pointers
     */
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oProfile.initialize();
});