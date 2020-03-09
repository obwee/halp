var oSalesReport = (() => {

    function init() {
        $('#tbl_sales').DataTable({
        	"scrollX": true
        });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oSalesReport.initialize();
});

