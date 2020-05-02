var oCommon = (() => {

    let oTemplate = {};

    let aNotifications = [];

    let iLimit = 0;

    let iNotifCount = 0;

    let bHasOpenedNotifications = false;

    function init() {
        fetchNotifications();
        insertNotifCount();
        setEvents();
    }

    function setEvents() {
        $('.logout').on('click', doLogout);

        $('.notif-menu').on('scroll', function () {
            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                fetchNotifications();
            }
        });

        $('.dropdown-toggle').click(function () {
            if (bHasOpenedNotifications === false) {
                updateNotifCount();
            }
        });

        $('.clonedTpl > a').click(function (oEvent) {
            oEvent.preventDefault();
            const iNotifId = $(this).attr('data-id');
            const sHref = $(this).attr('href');

            axios.post('/Nexus/utils/ajax.php?class=Notification&action=updateStatus', { iNotifId })
                .then(function (oResponse) {
                    if (oResponse.data.bResult === false) {
                        return oLibraries.displayAlertMessage('error', oResponse.data.sMsg);
                    }
                    location.href = sHref;
                })
                .catch(function (oError) {
                    return oError;
                });
        });
    }

    function getUrlEndpoint(sProp) {
        const oUsers = {
            'admin': {
                'fetchNotifications': 'fetchAdminNotifications',
                'updateNotifCount': 'updateAdminNotifCount',
            },
            'student': {
                'fetchNotifications': 'fetchStudentNotifications',
                'updateNotifCount': 'updateStudentNotifCount',
            }
        };

        for ([sUser, oAction] of Object.entries(oUsers)) {
            if (location.href.includes(sUser) === true) {
                return oAction[sProp];
            }
        }
    }

    function insertNotifCount() {
        if (iNotifCount !== 0) {
            $('.notif-count').text(iNotifCount);
        } else {
            deleteNotifCount();
        }
    }

    function deleteNotifCount() {
        $('.notif-count').remove();
    }

    function updateNotifCount() {
        // Execute AJAX request.
        $.ajax({
            url: `/Nexus/utils/ajax.php?class=Notification&action=${getUrlEndpoint('updateNotifCount')}`,
            type: 'GET',
            async: false,
            dataType: 'json',
            success: function () {
                insertNotifCount();
                deleteNotifCount();
                bHasOpenedNotifications = true;
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
            url: `/Nexus/utils/ajax.php?class=Notification&action=${getUrlEndpoint('fetchNotifications')}`,
            type: 'POST',
            data: { iLimit: iLimit },
            async: false,
            dataType: 'json',
            success: function (oResponse) {
                aNotifications = oResponse.aNotifs;
                iNotifCount = oResponse.iNotifCount;
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

            oRow.find('a').attr({
                'href': oVal.notifLink,
                'data-id': oVal.notifId
            });
            oRow.find('.notifIcon').addClass(oVal.notifIcon);
            oRow.find('.notifText').text(oVal.notifText);
            oRow.find('.notifDate').attr('title', oVal.notifDate);

            if (oVal.notifStatus === 1) {
                oRow.find('.notifDate').prev().remove();
            }

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
            oTemplate = $('.notifs-template').clone();
        }
    }

    return {
        initialize: init
    }
})();

$(document).ready(function () {
    oCommon.initialize();
});
