var oReservations = (() => {

    function init() {
        $('#tbl_reserved').DataTable({
        	"scrollX": true,
        	"scrollY": "300px",
        	"scrollCollapse": true
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oReservations.initialize();
});

