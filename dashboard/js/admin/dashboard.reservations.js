var oReservations = (() => {

    function init() {
        $('#tbl_reserved').DataTable({
        	"scrollX": true
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oReservations.initialize();
});

