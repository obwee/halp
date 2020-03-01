var oCancelledReservations = (() => {

    function init() {
        $('#tbl_refundRequests').DataTable({
        	"scrollY": true
        });
        $('#tbl_approvedRequests').DataTable({
        	"scrollY": true
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oCancelledReservations.initialize();
});

