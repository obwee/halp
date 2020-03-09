var oEditCourse = (() => {

    function init() {
        $('#tbl_courses').DataTable();
    }
	
    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oEditCourse.initialize();
});
