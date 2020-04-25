var oCommon = (() => {
    function init() {
        $('.logout').on('click', doLogout);
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

    function fetchNotifications() {
        
    }

    return {
        initialize: init
    }
})();

$(document).ready(function () {
    oCommon.initialize();
});
