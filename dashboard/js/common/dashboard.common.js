var oCommon = (() => {

    let oTemplate = {};

    let aNotifications = [];

    function init() {
        $('.logout').on('click', doLogout);
        fetchNotifications();
    }
    
    function doLogout(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33',
            allowOutsideClick: false
        }).then((result) => {
            result.value === true ? window.location.href = "/nexus/dashboard/logout.php" : '';
        });
    }

    /**
     * fetchNotifications
     */
    function fetchNotifications() {
        // Execute AJAX request.
        $.ajax({
            url: '/Nexus/utils/ajax.php?class=Notification&action=fetchNotifications',
            type: 'GET',
            dataType: 'json',
            success: function (oResponse) {
                aNotifications = oResponse;
                populateNotifications();
            }
        });
    }

    /**
     * populateNotifications
     */
    function populateNotifications() {
        loadTemplate();

        $('.notif-menu')
            .empty()
            .find('div[class!="template"]')
            .remove();

        $.each(aNotifications, (iKey, oVal) => {
            let oRow = oTemplate.clone().attr({
                'hidden': false,
                'class': 'clonedTpl'
            });

            oRow.find('.notifIcon').addClass(oVal.notifIcon);
            oRow.find('.notifText').text(oVal.notifText);
            oRow.find('.notifDate').text(oVal.notifDate);

            $('.notif-menu').append(oRow);
        });
    }

    /**
     * loadTemplate
     * Loads the template.
     */
    function loadTemplate() {
        if ($.isEmptyObject(oTemplate) === true) {
            oTemplate = $('.template').clone();
        }
    }

    return {
        initialize: init
    }
})();

$(document).ready(function () {
    oCommon.initialize();
});
