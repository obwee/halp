var oEnrollment = (() => {

    function init() {
        $('#tbl_quotations').DataTable();
    }
	
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oEnrollment.initialize();
});



