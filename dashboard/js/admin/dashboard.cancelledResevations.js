var oCancelledReservations = (() => {

    function init() {
        $('#tbl_requests').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oCancelledReservations.initialize();
});