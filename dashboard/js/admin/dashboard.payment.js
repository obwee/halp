var oPayment = (() => {

    function init() {
        $('#tbl_payment').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oPayment.initialize();
});

