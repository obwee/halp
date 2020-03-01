var oSentQuotations = (() => {

    function init() {
        $('#tbl_quotations').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oSentQuotations.initialize();
});