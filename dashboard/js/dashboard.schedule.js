var oSchedule = (() => {

    function init() {
        $('#tbl_schedule').DataTable()
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oSchedule.initialize();
});