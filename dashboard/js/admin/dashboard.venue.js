/**
 * oVenue
 * Revealing module for venue-related functionalities.
 */
var oVenue = (() => {

    /**
     * @var {object} oTblVenue
     * The table.
     */
    let oTblVenue = $('#tbl_venue');

    /**
     * @var {object} oTemplate
     * Template holder for cloning elements.
     */
    let oTemplate = {};

    /**
     * @var {array} aVenues
     * Holder of fetched venues from the database.
     */
    let aVenues = [];

    /**
     * @var {object} oVenueDetails
     * Holder of selected venue details.
     */
    let oVenueDetails = {};

    /**
     * @var {object} oColumns
     * Holder of columns to be displayed by the datatable.
     */
    let oColumns = {
        aVenues: [
            {
                title: 'Branch', className: 'text-center', data: 'venue'
            },
            {
                title: 'Address', className: 'text-center no-sort', data: 'address'
            },
            {
                title: 'Contact No.', className: 'text-center no-sort', data: 'contactNum'
            },
            {
                title: 'Actions', className: 'text-center no-sort', render: (aData, oType, oRow) =>
                    `<button class="btn btn-warning btn-sm" data-toggle="modal" id="editVenue" data-id="${oRow.id}">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-${(oRow.status === 'Active') ? 'danger' : 'success'} btn-sm" data-toggle="modal" id="${(oRow.status === 'Active') ? 'disableVenue' : 'enableVenue'}" data-id="${oRow.id}">
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
        fetchVenues();
        setEvents();
    }

    /**
     * setEvents
     */
    function setEvents() {
        oForms.prepareDomEvents();

        $(document).on('click', '#editVenue', function () {
            let iVenueId = $(this).attr('data-id');
            let oVenueDetails = aVenues.filter(oVenue => oVenue.id == iVenueId)[0];
            proceedToEditVenue(oVenueDetails);
        });

        $('.modal').on('hidden.bs.modal', function () {
            let sFormName = `#${$(this).find('form').attr('id')}`;
            $(sFormName)[0].reset();
            $('.error-msg').css('display', 'none').html('');
        });

        $(document).on('click', '#disableVenue', function () {
            const iVenueId = parseInt($(this).attr('data-id'), 10);
            const oVenueData = aVenues.filter(oVenue => oVenue.id == iVenueId)[0];

            Swal.fire({
                title: 'Disable the venue?',
                text: `This will mark the venue of ${oVenueData.methodName} as 'Inactive'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'venueId': iVenueId,
                        'venueAction': 'disable'
                    }
                    toggleEnableDisableVenue(oDetails);
                }
            });
        });

        $(document).on('click', '#enableVenue', function () {
            const iVenueId = parseInt($(this).attr('data-id'), 10);
            const oVenueData = aVenues.filter(oVenue => oVenue.id == iVenueId)[0];

            Swal.fire({
                title: 'Enable the venue?',
                text: `This will mark the status of ${oVenueData.methodName} as 'Active'.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oDetails = {
                        'venueId': iVenueId,
                        'venueAction': 'enable'
                    }
                    toggleEnableDisableVenue(oDetails);
                }
            });
        });

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormId = `#${$(this).attr('id')}`;

            const aFormData = $(sFormId).serializeArray();

            for (const iKey in aFormData) {
                if (aFormData[iKey].value === '') {
                    oLibraries.displayAlertMessage('error', 'Please fill-in all the inputs.');
                    return false;
                }
            }

            // Disable the form.
            oForms.disableFormState(sFormId, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormId);

            // Create an object with key names of forms and its corresponding validation and request action as its value.
            const oInputForms = {
                '#addVenueForm': {
                    'requestClass': 'Venue',
                    'requestAction': 'addVenue',
                    'alertTitle': 'Add venue?',
                    'alertText': 'This will insert a new venue.'
                },
                '#editVenueForm': {
                    'requestClass': 'Venue',
                    'requestAction': 'updateVenue',
                    'alertTitle': 'Update venue?',
                    'alertText': 'This will update the venue details.'
                },
                '#changeVenueForm': {
                    'validationMethod': oValidations.validateChangeVenueInputs(aFormData),
                    'requestClass': 'Venue',
                    'requestAction': 'changeVenues',
                    'alertTitle': 'Change venues?',
                    'alertText': 'This will change the venues of the schedules above.'
                }
            }

            if (oInputForms[sFormId].hasOwnProperty('validationMethod') === true && oInputForms[sFormId].validationMethod.result === false) {
                oLibraries.displayErrorMessage(sFormId, oInputForms[sFormId].validationMethod.msg, oInputForms[sFormId].validationMethod.element);
                oForms.disableFormState(sFormId, false);
                return false;
            }

            Swal.fire({
                title: oInputForms[sFormId].alertTitle,
                text: oInputForms[sFormId].alertText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value === true) {
                    executeSubmit(aFormData, oInputForms[sFormId].requestClass, oInputForms[sFormId].requestAction);
                }
            });
            // Enable the form.
            oForms.disableFormState(sFormId, false);
        });
    }

    /**
     * proceedToChangeVenue
     * @param {object} oDetails
     * @param {int} iVenueId
     */
    function proceedToChangeVenue(oDetails, iVenueId) {
        oLibraries.displayAlertMessage('warning', 'Please update the venues for the following schedules.');

        loadTemplate();

        $('.box')
            .empty()
            .find('div[class!="template"]')
            .remove();

        $.each(oDetails, (iKey, oVal) => {
            let oRow = oTemplate.clone().attr({
                'hidden': false,
                'class': 'clonedTpl',
            });

            oRow.find('.courseCode span').text(oVal.courseCode);
            oRow.find('.courseSchedule span').text(oVal.fromDate + ' - ' + oVal.toDate);
            oRow.find('.courseInstructor span').text(oVal.instructorName);

            cloneVenueDropdown(oRow.find('.venues'), oVal.scheduleId, iVenueId);
            insertVenueToBeDisabled($('.venue'), iVenueId);

            $('.box').append(oRow);
        });

        $('.clonedTpl hr').last().remove();
        $('#changeVenueModal').find('.venueId').val(iVenueId);
        $("#changeVenueModal").modal('show');
    }

    /**
     * loadTemplate
     * Loads the template.
     */
    function loadTemplate() {
        if ($.isEmptyObject(oTemplate) === true) {
            oTemplate = $('.template').clone();
        }
    }

    /**
     * cloneVenueDropdown
     * Clonses the venue dropdown inside the template.
     */
    function cloneVenueDropdown(oElement, iScheduleId, iVenueId) {
        let aFilteredVenues = aVenues.filter((oVenue) => {
            return oVenue.id !== iVenueId && oVenue.status === 'Active';
        });

        oElement.empty().attr('name', `venues[${iScheduleId}]`).append($('<option selected disabled hidden>Select Venue</option>'));
        $.each(aFilteredVenues, (iKey, oVal) => {
            oElement.append($('<option />').val(oVal.id).text(`${oVal.venue}`));
        });
    }

    /**
     * insertVenueToBeDisabled
     * Inserts the name of the venue to be disabled.
     */
    function insertVenueToBeDisabled(oElement, iVenueId) {
        let oVenueData = aVenues.filter((oVenue) => {
            return oVenue.id === iVenueId;
        })[0];

        oElement.val(`${oVenueData.venue} (${oVenueData.address})`);
    }

    /**
     * proceedToEditVenue
     * @param {object} oDetails
     */
    function proceedToEditVenue(oDetails) {
        $('#editVenueModal').find('.venueId').val(oDetails.id);
        $('#editVenueModal').find('.branch').val(oDetails.venue);
        $('#editVenueModal').find('.branchAddress').val(oDetails.address);
        $('#editVenueModal').find('.branchContact').val(oDetails.contactNum);
        $('#editVenueModal').modal('show');
    }

    /**
     * executeSubmit
     * @param {object} oData
     * @param {string} sRequestClass
     * @param {string} sRequestAction
     */
    function executeSubmit(oData, sRequestClass, sRequestAction) {
        // Execute AJAX.
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=${sRequestClass}&action=${sRequestAction}`,
            type: 'POST',
            data: oData,
            dataType: 'json',
            success: function (oResponse) {
                oLibraries.displayAlertMessage(
                    (oResponse.bResult === true) ? 'success' : 'error', oResponse.sMsg
                );
                fetchVenues();
                $('.modal').modal('hide');
            }
        });
    }

    /**
     * toggleEnableDisableVenue
     * @param {object} oVenueData
     */
    function toggleEnableDisableVenue(oVenueData) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Venue&action=enableDisableVenue',
            type: 'POST',
            data: oVenueData,
            dataType: 'json',
            success: function (oResponse) {
                if (oResponse.bResult === true) {
                    oLibraries.displayAlertMessage('success', oResponse.sMsg);
                    fetchVenues();
                } else {
                    // If there are pending venues for the venue to be disabled.
                    if (typeof (oResponse.aSchedules) !== 'undefined') {
                        oVenueDetails = oVenueData;
                        proceedToChangeVenue(oResponse.aSchedules, oVenueDetails.venueId);
                        return;
                    }
                    oLibraries.displayAlertMessage('error', oResponse.sMsg);
                }
            }
        });
    }

    /**
     * fetchVenues
     */
    function fetchVenues() {
        let oAjax = {
            url: `/Nexus/utils/ajax.php?class=Venue&action=fetchVenues`,
            type: 'GET',
            dataType: 'JSON',
            dataSrc: function (oData) {
                aVenues = oData;
                return aVenues;
            },
            async: false
        };

        let aColumnDefs = [
            { targets: [1, 2, 3], orderable: false }
        ];

        loadTable(oTblVenue.attr('id'), oAjax, oColumns.aVenues, aColumnDefs);
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
    oVenue.initialize();
});
