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
     * @var {array} aVenues
     * Holder of fetched venues from the database.
     */
    let aVenues = [];

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
                    <button class="btn btn-danger btn-sm" data-toggle="modal" id="deleteVenue" data-id="${oRow.id}">
                        <i class="fa fa-trash"></i>
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

        $(document).on('submit', 'form', function (oEvent) {
            oEvent.preventDefault();

            const sFormName = `#${$(this).attr('id')}`;

            // Disable the form.
            oForms.disableFormState(sFormName, true);

            // Invoke the resetInputBorders method inside oForms utils for that form.
            oForms.resetInputBorders(sFormName);

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
                }
            }

            Swal.fire({
                title: oInputForms[sFormName].alertTitle,
                text: oInputForms[sFormName].alertText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((bIsConfirm) => {
                if (bIsConfirm.value !== true) {
                    return false;
                } else {
                    // Get the request class of the form submitted.
                    let sRequestClass = oInputForms[sFormName].requestClass;

                    // Get the request action of the form submitted.
                    let sRequestAction = oInputForms[sFormName].requestAction;

                    // Check if input validation result is true.
                    const oFormData = $(sFormName).serializeArray();
                    executeSubmit(oFormData, sRequestClass, sRequestAction);
                }
            });
            // Enable the form.
            oForms.disableFormState(sFormName, false);
        });

        $(document).on('click', '#deleteVenue', function () {
            Swal.fire({
                title: 'Delete the venue?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((bResult) => {
                if (bResult.value === true) {
                    const oVenueId = {
                        'venueId' : parseInt($(this).attr('data-id'), 10)
                    }
                    executeDelete(oVenueId);
                }
            });
        });
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
     * executeDelete
     * @param {object} oVenueId
     */
    function executeDelete(oVenueId) {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Venue&action=deleteVenue',
            type: 'POST',
            data: oVenueId,
            dataType: 'json',
            success: function (oResponse) {
                oLibraries.displayAlertMessage(
                    (oResponse.bResult === true) ? 'success' : 'error', oResponse.sMsg
                );
                fetchVenues();
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
