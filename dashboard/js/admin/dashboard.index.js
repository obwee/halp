var oDashboardIndex = (() => {

    function init() {
        getStatistics();
    }

    function getStatistics() {
        axios.get('/Nexus/utils/ajax.php?class=Reports&action=getStatistics')
            .then(function (oResponse) {
                console.log(oResponse)
            });
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oDashboardIndex.initialize();
});