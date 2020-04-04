var oRefundRequests = (() => {

    function init() {
        $('#tbl_requests').DataTable(	);
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oRefundRequests.initialize();
});

