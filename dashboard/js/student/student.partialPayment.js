var oFullyPaidStudents = (() => {

    function init() {
        $('#tbl_partialPayment').DataTable()
        $('#tbl_paymentDetails').DataTable()
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oFullyPaidStudents.initialize();
});

