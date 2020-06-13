var oCourses = (() => {

    function init() {
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Forms&action=renderCourses',
            type: 'GET',
            dataType: 'html',
            success: function (sResponse) {
                $('.coursesOffered').html(sResponse)
            }
        });
    }

    return {
        initialize: init
    }
})();

$(() => {
    oCourses.initialize();
});
