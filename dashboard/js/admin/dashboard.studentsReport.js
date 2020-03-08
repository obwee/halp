var oStudentsReport = (() => {

    function init() {
        $('#tbl_students').DataTable({
        	"scrollX": true
        })
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oStudentsReport.initialize();
});

