var oVenue = (() => {

    let oTblVenue = $('#tbl_venue');

    let aVenues = [];

    let oColumns = {
        aCourses: [
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

    function init() {
        fetchVenues();
        setEvents();
    }

    function setEvents() {
        oForms.prepareDomEvents();

        $(document).on('click', '#editVenue', function () {
            let iVenueId = $(this).attr('data-id');
            let oVenueDetails = aVenues.filter(oVenue => oVenue.id == iVenueId)[0];
            proceedToEditVenue(oVenueDetails);
        });
    }

    function proceedToEditVenue(oDetails) {
        $('#editVenueModal').find('.branch').val(oDetails.venue);
        $('#editVenueModal').find('.branchAddress').val(oDetails.address);
        $('#editVenueModal').find('.branchContact').val(oDetails.contactNum);
        $('#editVenueModal').modal('show');
    }

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

        loadTable(oTblVenue.attr('id'), oAjax, oColumns.aCourses, aColumnDefs);
    }

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

    return {
        initialize: init
    }

})();

$(() => {
    oVenue.initialize();
});
