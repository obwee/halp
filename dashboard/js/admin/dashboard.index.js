var oDashboardIndex = (() => {

    function init() {
        getStatistics();
    }

    function getStatistics() {
        axios.get('/Nexus/utils/ajax.php?class=Reports&action=getStatistics')
            .then(function (oResponse) {
                $('.emailed').text(oResponse.data.iQuotationCount);
                $('.partial').text(oResponse.data.iPartiallyPaidCount);
                $('.fully').text(oResponse.data.iFullyPaidCount);
                $('.unpaid').text(oResponse.data.iUnpaidCount);
            });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oDashboardIndex.initialize();
});