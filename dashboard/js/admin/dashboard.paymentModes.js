let oPaymentModes = (() => {

    /**
     * @var {object} oTblPayment
     * The table.
     */
    let oTblPayment = $('#tbl_mop');

    /**
     * @var {object} aPaymentModes
     * Holder of mode of payments fetched from the database.
     */
    let aPaymentModes = [];

    /**
     * @var {object} oColumns
     * Holder of columns to be displayed by the datatable.
     */
    let oColumns = {
        aPaymentModes: [
            {
                title: 'Payment Modes', className: 'text-center', data: 'methodName'
            },
            {
                title: 'Actions', className: 'text-center', render: (aData, oType, oRow) =>
                    `<button class="btn btn-warning btn-sm" data-toggle="modal" id="editPaymentMethod" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-${(oRow.status === 'Active') ? 'danger' : 'success'} btn-sm" data-toggle="modal" id="${(oRow.status === 'Active') ? 'disablePaymentMethod' : 'enablePaymentMethod'}" data-id="${oRow.id}">
                        <i class="fa fa-${(oRow.status === 'Active') ? 'times-circle' : 'check-circle'}"></i>
                    </button>`
            },
        ]
    };

    /**
     * init
     * Constructor-like method to be called on document ready.
     */
    function init() {
        fetchModeOfPayments();
        setEvents();
    }

    /**
     * setEvents
     * Prepares DOM events.
     */
    function setEvents() {

        oForms.prepareDomEvents();

        $('.modal').on('hidden.bs.modal', function () {
            const sFormId = `#${$(this).find('form').attr('id')}`;
            $(sFormId)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#editPaymentMethod', function () {
            const oPaymentMethod = aPaymentModes.filter(oPaymentMode => oPaymentMode.id == $(this).attr('data-id'))[0];
            proceedEditToPaymentMethod(`#${$(this).attr('id')}Modal`, oPaymentMethod);
        });

        $(document).on('click', '#disablePaymentMethod', function () {
            const iMethodId = parseInt($(this).attr('data-id'), 10);
            const oPaymentMethod = aPaymentModes.filter(oPaymentMode => oPaymentMode.id == iMethodId)[0];

            Swal.fire({
                title: 'Disable the payment mode?',
                text: `This will mark the payment mode of ${oPaymentMethod.methodName} as 'Inactive'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'methodId': iMethodId,
                        'methodAction': 'disable'
                    }
                    toggleEnableDisablePaymentMode(oDetails);
                }
            });
        });

        $(document).on('click', '#enablePaymentMethod', function () {
            const iMethodId = parseInt($(this).attr('data-id'), 10);
            const oPaymentMethod = aPaymentModes.filter(oPaymentMode => oPaymentMode.id === iMethodId)[0];

            Swal.fire({
                title: 'Enable the payment mode?',
                text: `This will mark the status of ${oPaymentMethod.methodName} as 'Active'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'methodId': iMethodId,
                        'methodAction': 'enable'
                    }
                    toggleEnableDisablePaymentMode(oDetails);
                }
            });
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            // Disable the form.
            // oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            const oInputForms = {
                '#addPaymentMethodForm': {
                    'validationMethod': oValidations.validatePaymentModeInputs(sFormId),
                    'requestClass': 'Payment',
                    'requestAction': 'addPaymentMethod',
                    'alertTitle': 'Add payment method?',
                    'alertText': 'This will insert a new payment method.'
                },
                '#editPaymentMethodForm': {
                    'validationMethod': oValidations.validatePaymentModeInputs(sFormId),
                    'requestClass': 'Payment',
                    'requestAction': 'updatePaymentMethod',
                    'alertTitle': 'Update payment method?',
                    'alertText': 'This will update the payment method.'
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
                    fetchModeOfPayments();
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    $('.modal').modal('hide');
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
     * proceedToEditPaymentMethod
     * @param {object} oDetails
     */
    function proceedEditToPaymentMethod(sModalName, oDetails) {
        $(sModalName).find('.methodId').val(oDetails.id);
        $(sModalName).find('.paymentMode').val(oDetails.methodName);
        $(sModalName).modal('show');
    }

    /**
     * toggleEnableDisablePaymentMode
     * @param {object} oPaymentMethodData
     */
    function toggleEnableDisablePaymentMode(oPaymentMethodData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Payment&action=enableDisablePaymentMethod',
            type: 'POST',
            data: oPaymentMethodData,
            dataType: 'json',
            success: function (oResponse) {
                if (oResponse.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    fetchModeOfPayments();
                } else {
                    oLibraries.displayAlertMessage('error', oResponse.sMsg);
                }
            }
        });
    }

    /**
     * fetchModeOfPayments
     */
    function fetchModeOfPayments() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Payment&action=fetchModeOfPayments`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                aPaymentModes = oData;
                return aPaymentModes;
            },
            async: false
        };

        let aColumnDefs = [
            { targets: [1], orderable: false }
        ];

        loadTable(oTblPayment.attr('id'), oAjax, oColumns.aPaymentModes, aColumnDefs);
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
     * Return public pointers
     */
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oPaymentModes.initialize();
});