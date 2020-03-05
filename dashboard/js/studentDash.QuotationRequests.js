var oStudentQuotationRequests = (() => {

    function init() {
        $('#tbl_quotations').DataTable();
    }
	
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oStudentQuotationRequests.initialize();
});



