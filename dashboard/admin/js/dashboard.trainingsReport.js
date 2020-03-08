var oTrainingsReport = (() => {

    function init() {
        $('#tbl_trainings').DataTable({
        	"scrollX": true
        })
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oTrainingsReport.initialize();
});

