var oMasterList = (() => {

    function init() {
        $('#tbl_students').DataTable();
    }
	
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oMasterList.initialize();
});
