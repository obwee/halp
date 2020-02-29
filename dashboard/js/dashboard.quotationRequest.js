var oQuotationRequests = (() => {

    function init() {
        $('#tbl_quotations').DataTable();
        $('#tbl_quotationDetails').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oQuotationRequests.initialize();
});