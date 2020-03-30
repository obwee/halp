var oCredentials = (() => {

    /**
     * @var {object} oTblAdmin
     * The table.
     */
    let oTblAdmin = $('#tbl_admin');

    /**
     * @var {array} aAdmins
     * Holder of fetched admins from the database.
     */
    let aAdmins = [];

    /**
     * @var {object} oColumns
     * Holder of columns to be displayed by the datatable.
     */
    let oColumns = {
        aInstructor: [
            {
                title: 'Full Name', className: 'text-center no-sort', render: (aData, oType, oRow) =>
                    [oRow.firstName, oRow.lastName].join(' ')
            },
            {
                title: 'Username', className: 'text-center no-sort', data: 'username'
            },
            {
                title: 'Account Type', className: 'text-center no-sort', data: 'position'
            },
            {
                title: 'Email Address', className: 'text-center no-sort', data: 'email'
            },
            {
                title: 'Contact No.', className: 'text-center no-sort', data: 'contactNum'
            },
            {
                title: 'Actions', className: 'text-center no-sort', render: (aData, oType, oRow) =>
                    `<button class="btn btn-warning btn-sm" data-toggle="modal" id="editAdmin" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-secondary btn-sm" data-toggle="modal" id="resetPassword" data-id="${oRow.id}">
                        <i class="fa fa-redo"></i>
                    </button>
                    <button class="btn btn-${(oRow.status === 'Active') ? 'danger' : 'success'} btn-sm" data-toggle="modal" id="${(oRow.status === 'Active') ? 'disableAdmin' : 'enableAdmin'}" data-id="${oRow.id}">
                        <i class="fa fa-user${(oRow.status === 'Active') ? '-slash' : ''}"></i>
                    </button>`
            },
        ]
    };

    /**
     * init
     * Constructor-like method to be called on document ready.
     */
    function init() {
        fetchAdmins();
        setEvents();
    }

    /**
     * setEvents
     * Prepares DOM events.
     */
    function setEvents() {

        oForms.prepareDomEvents();

        $('.modal').on('hidden.bs.modal', function () {
            let sFormName = `#${$(this).find('form').attr('id')}`;
            $(sFormName)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#editAdmin', function () {
            const oAdminData = aAdmins.filter(oAdmin => oAdmin.id == $(this).attr('data-id'))[0];
            proceedToEditDetails(`#${$(this).attr('id')}Modal`, oAdminData);
        });

        $(document).on('click', '#editPersonalDetails', function () {
            proceedToEditDetails(`#${$(this).attr('id')}Modal`, fetchOwnCredentials());
        });

        $(document).on('click', '#editOwnCredentials', function () {
            proceedToEditDetails(`#${$(this).attr('id')}Modal`, fetchOwnCredentials());
        });

        $(document).on('click', '#disableAdmin', function () {
            const iAdminId = parseInt($(this).attr('data-id'), 10);
            const aAdminDetails = aAdmins.filter((oAdminDetails) => oAdminDetails.id === iAdminId)[0];

            Swal.fire({
                title: 'Disable the admin?',
                text: `This will mark the status of ${aAdminDetails.fullName} as 'Inactive'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'adminId': iAdminId,
                        'adminAction': 'disable'
                    }
                    toggleEnableDisableAdmin(oDetails);
                }
            });
        });

        $(document).on('click', '#enableAdmin', function () {
            const iAdminId = parseInt($(this).attr('data-id'), 10);
            const aAdminDetails = aAdmins.filter((oAdminDetails) => oAdminDetails.id === iAdminId)[0];

            Swal.fire({
                title: 'Enable the admin?',
                text: `This will mark the status of ${aAdminDetails.fullName} as 'Active'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'adminId': iAdminId,
                        'adminAction': 'enable'
                    }
                    toggleEnableDisableAdmin(oDetails);
                }
            });
        });

        $(document).on('click', '#resetPassword', function () {
            const iAdminId = parseInt($(this).attr('data-id'), 10);
            const aAdminDetails = aAdmins.filter((oAdminDetails) => oAdminDetails.id === iAdminId)[0];

            Swal.fire({
                title: 'Reset the password?',
                text: `This will reset the password of ${aAdminDetails.fullName}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                preConfirm: () => {
                    const oDetails = {
                        'adminId': iAdminId,
                        'adminEmail': aAdminDetails.email,
                        'adminFullName': aAdminDetails.fullName
                    }
                    return resetPassword(oDetails);
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((oResponse) => {
                oLibraries.displayAlertMessage((oResponse.value.bResult === true) ? 'success' : 'error', oResponse.value.sMsg);
            });
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oInputForms = {
                '#addNewAdminForm': {
                    'validationMethod': oValidations.validateAddAdminInputs(sFormId),
                    'requestClass': 'Admins',
                    'requestAction': 'addAdmin',
                    'alertTitle': 'Add admin?',
                    'alertText': 'This will insert a new admin.'
                },
                '#editAdminForm': {
                    'validationMethod': oValidations.validateEditAdminInputs(sFormId),
                    'requestClass': 'Admins',
                    'requestAction': 'updateAdmin',
                    'alertTitle': 'Update admin?',
                    'alertText': 'This will update the admin details.'
                },
                '#editPersonalDetailsForm': {
                    'validationMethod': oValidations.validateEditPersonalDetailsInputs(sFormId),
                    'requestClass': 'Admins',
                    'requestAction': 'updateSuperAdminDetails',
                    'alertTitle': 'Update own details?',
                    'alertText': 'This will update your own personal details.'
                },
                '#editOwnCredentialsForm': {
                    'validationMethod': oValidations.validateEditOwnCredentialsInputs(sFormId),
                    'requestClass': 'Admins',
                    'requestAction': 'updateSuperAdminCredentials',
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
                    if (bIsConfirm.value !== true) {
                        return false;
                    } else {
                        // Get the request class of the form submitted.
                        let sRequestClass = oInputForms[sFormId].requestClass;

                        // Get the request action of the form submitted.
                        let sRequestAction = oInputForms[sFormId].requestAction;

                        executeSubmit(sFormId, sRequestClass, sRequestAction);
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
                    fetchAdmins();
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    $('.modal').modal('hide');
                    if (sRequestAction === 'updateSuperAdminDetails') {
                        // Change greeting text on the header.
                        $('.hidden-xs').text(`Hello, ${oFormData.get('adminFirstName')} ${oFormData.get('adminLastName')}!`);
                    }
                } else {
                    oLibraries.displayErrorMessage(sFormId, oResponse.sMsg, oResponse.sElement);
                }
            },
            complete: () => {
                $('.spinner').css('display', 'none');
            }
        });
    }

    /**
     * proceedToEditDetails
     * @param {object} oDetails
     */
    function proceedToEditDetails(sModalName, oDetails) {
        $(sModalName).find('.adminId').val(oDetails.id);
        $(sModalName).find('.adminFirstName').val(oDetails.firstName);
        $(sModalName).find('.adminMiddleName').val(oDetails.middleName);
        $(sModalName).find('.adminLastName').val(oDetails.lastName);
        $(sModalName).find('.adminEmail').val(oDetails.email);
        $(sModalName).find('.adminContact').val(oDetails.contactNum);
        $(sModalName).find('.adminUsername').val(oDetails.username);
        $(sModalName).modal('show');
    }

    /**
     * fetchOwnCredentials
     */
    function fetchOwnCredentials() {
        let oDetails = {};
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Admins&action=fetchOwnCredentials',
            type: 'get',
            dataType: 'json',
            async: false,
            success: function (oResponse) {
                oDetails = oResponse;
            }
        });
        return oDetails;
    }

    /**
     * toggleEnableDisableAdmin
     * @param {object} oAdminData
     */
    function toggleEnableDisableAdmin(oAdminData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Admins&action=enableDisableAdmin',
            type: 'POST',
            data: oAdminData,
            dataType: 'json',
            success: function (oResponse) {
                if (oResponse.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    fetchAdmins();
                } else {
                    oLibraries.displayAlertMessage('error', oResponse.sMsg);
                }
            }
        });
    }

    /**
     * resetPassword
     */
    function resetPassword(oData) {
        return axios.post('/Nexus/utils/ajax.php?class=Admins&action=resetPassword', oData)
            .then(function (oResponse) {
                return oResponse.data;
            })
            .catch(function (oError) {
                return oError;
            });
    }

    /**
     * fetchAdmins
     */
    function fetchAdmins() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Admins&action=fetchAdmins`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                aAdmins = oData;
                return aAdmins;
            },
            async: false
        };

        let aColumnDefs = [
            { targets: [1, 2, 3, 4], orderable: false }
        ];

        loadTable(oTblAdmin.attr('id'), oAjax, oColumns.aInstructor, aColumnDefs);
    }

    /**
     * loadTable
     * Loads the datatable.
     * @param {string} sTableName
     * @param {object} oData
     * @param {array} aColumns
     * @param {array} aColumnDefs
     */
    function loadTable(sTableName, oData, aColumns, aColumnDefs) {
        $(`#${sTableName} > tbody`).empty().parent().DataTable({
            destroy: true,
            deferRender: true,
            ajax: oData,
            responsive: true,
            pagingType: 'first_last_numbers',
            pageLength: 4,
            ordering: true,
            searching: true,
            lengthChange: true,
            lengthMenu: [[4, 8, 12, 16, 20, 24, -1], [4, 8, 12, 16, 20, 24, 'All']],
            info: true,
            columns: aColumns,
            columnDefs: aColumnDefs
        });
    }

    /**
     * Return public pointers.
     */
    return {
        initialize: init
    }

})();

$(() => {
    oCredentials.initialize();
});

