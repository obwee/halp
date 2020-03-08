var oDashboardIndex = (() => {

    function init() {
        $('#tbl_upcoming').DataTable();
        $('#tbl_ongoing').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function() {
    oDashboardIndex.initialize();
});