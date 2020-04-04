var oUpcomingSched = (() => {

    function init() {
        $('#tbl_upcoming').DataTable(	);
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oUpcomingSched.initialize();
});

