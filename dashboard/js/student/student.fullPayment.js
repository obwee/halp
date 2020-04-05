var oFullyPaidStudents = (() => {

    function init() {
        $('#tbl_fullPayment').DataTable()
        $('#tbl_paymentDetails').DataTable()
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oFullyPaidStudents.initialize();
});

