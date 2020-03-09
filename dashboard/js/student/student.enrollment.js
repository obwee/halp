var oEnrollment = (() => {

    function init() {
        $('#tbl_enrollment').DataTable()
        fetchCourses();
    }

    function setEvents() {

    }

    function fetchCourses() {
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Courses&action=fetchCoursesToEnroll`,
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                // if (oResponse.result === true) {
                //     $(formName).parents().find('div.modal').modal('hide');
                //     populateRequestsTable();
                //     oLibraries.displayAlertMessage('success', response.msg);
                // } else {
                //     oLibraries.displayErrorMessage(formName, response.msg, response.element);
                // }
            },
            error: function () {
                oLibraries.displayAlertMessage('error', 'An error has occured. Please try again.');
            }
        });
    }

    return {
        initialize: init
    }

})();

$(() => {
    oEnrollment.initialize();
});
