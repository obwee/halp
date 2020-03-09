var oCredentials = (() => {

    function init() {
        $('#tbl_users').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oCredentials.initialize();
});

