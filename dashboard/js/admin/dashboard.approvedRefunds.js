var oApprovedRefunds = (() => {

    function init() {
        $('#tbl_requests').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oApprovedRefunds.initialize();
});

