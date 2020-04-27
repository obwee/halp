var oCommon = (() => {

    let oTemplate = {};

    let aNotifications = [];

    let iLimit = 0;

    function init() {
        fetchNotifications();
        setEvents();
    }

    function setEvents() {
        $('.logout').on('click', doLogout);

        $('.notif-menu').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                fetchNotifications();
            }
        });
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
            type: 'POST',
            data: { iLimit: iLimit },
            dataType: 'json',
            success: function (oResponse) {
                aNotifications = oResponse;
                iLimit += 5;
                populateNotifications();
            }
        });
    }

    /**
     * populateNotifications
     */
    function populateNotifications() {
        loadTemplate();

        if (aNotifications.length === 0 && $('.empty').not(':visible')) {
            let oEmptyTpl = $('.empty').clone().attr('hidden', false);
            $('.empty').remove();
            $('.notif-menu').append(oEmptyTpl);
            iLimit -= 5;
            return false;
        }

        $.each(aNotifications, (iKey, oVal) => {
            let oRow = oTemplate.clone().attr({
                'hidden': false,
                'class': 'clonedTpl'
            });

            oRow.find('a').attr('href', oVal.notifLink);
            oRow.find('.notifIcon').addClass(oVal.notifIcon);
            oRow.find('.notifText').text(oVal.notifText);
            oRow.find('.notifDate').attr('title', oVal.notifDate);

            $('.notif-menu').append(oRow);
        });

        $('.notifDate').timeago();
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
