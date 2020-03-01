var oUnpaidStudents = (() => {

    function init() {
        $('#tbl_unpaidStudents').DataTable()
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oUnpaidStudents.initialize();
});

