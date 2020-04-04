var oOngoingSched = (() => {

    function init() {
        $('#tbl_ongoing').DataTable(	);
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oOngoingSched.initialize();
});

