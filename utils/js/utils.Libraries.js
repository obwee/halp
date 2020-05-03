var oLibraries = (() => {

    function displayAlertMessage(sType, sMsg) {
        let oSwal = {
            'error': {
                title: 'Error.',
                text: sMsg,
                icon: 'error',
                confirmButtonText: 'OK'
            },
            'success': {
                title: 'Success.',
                text: sMsg,
                icon: 'success',
                confirmButtonText: 'OK'
            },
            'warning': {
                title: 'Warning.',
                text: sMsg,
                icon: 'warning',
                confirmButtonText: 'OK'
            }
        };

        Swal.fire(oSwal[sType]);
    }

    function displayErrorMessage(formName, msg, element, isModal = true) {
        if (isModal === true) {
            // Scroll to div that displays the error message.
            $(formName).parents().find('div.modal').animate({
                scrollTop: $('.error-msg').offset().top
            } /* speed */);
        }

        // Display error message.
        $('.error-msg')
            .css('display', 'block')
            .html("<span class='text-danger'><i class='fas fa-exclamation-triangle'></i> " + msg + "</span>");

        // Highlight the input that has an error.
        $(element).css('border', '1px solid red');

        // Remove the error message after 2000 milliseconds.
        setTimeout(function () {
            $('.error-msg').css('display', 'none').html('');
        }, 3000);
    }

    function formatCurrency(iValue) {
        return parseInt(iValue, 10).toLocaleString();
    }

    // Return public pointers.
    return {
        displayAlertMessage: displayAlertMessage,
        displayErrorMessage: displayErrorMessage,
        formatCurrency: formatCurrency
    }

})();