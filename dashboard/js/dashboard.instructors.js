var oInstructors = (() => {

    function init() {
        $('#tbl_instructors').DataTable();
    }

    return {
        initialize: init
    }

})();

$(document).ready(function () {
    oInstructors.initialize();
});


// Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });