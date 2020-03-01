var oEnrollment = (() => {

    function init() {
        $('#tbl_enrollment').DataTable();
    }
	
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oEnrollment.initialize();
});



