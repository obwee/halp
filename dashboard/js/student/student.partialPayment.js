var oFullyPaidStudents = (() => {

    function init() {
        $('#tbl_partialPayment').DataTable()
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oFullyPaidStudents.initialize();
});

