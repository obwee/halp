let oLoginModule = (() => {

    function init() {
        setDomEvents();
    }

    function setDomEvents() {
        $(document).on('click', '#forgotPasswordBtn', () => {
            toggleForms(true);
        });

        $(document).on('click', '#backToLoginBtn', () => {
            toggleForms(false);
        });

        // Add input text effect on focus event.
        $(document).on('focus', '.input', function () {
            $(this).closest('.input-div').addClass('focus');
        });

        // Add input text effect on focusout event.
        $(document).on('focusout', '.input', function () {
            if ($(this).val() === '') {
                $(this).closest('.input-div').removeClass('focus');
            }
        });

        // Allow only alphanumeric characters and an underscore on username input via RegExp.
        $(document).on('keyup keydown', '#username', function (event) {
            // Input must not start by a number or any special character.
            if (this.value.length === 1 && this.value.match(/[^a-zA-Z]/)) {
                return this.value = this.value.replace(this.value, '');
            }
            return this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '');
        });

        $(document).keypress(function (event) {
            if ((event.keyCode ? event.keyCode : event.which) === 13) {
                event.preventDefault();
                // const sElement = $('#login').length < 1 ? '#resetPassword' : '#login';
                // $(sElement).click();
            }
        });

        // If button with an ID of 'login' is clicked...
        $(document).on('click', '#login', function () {
            // Check first if inputs are valid using the validateInputs() function.
            if (validateInputs().result === true) {
                const oData = {
                    username: $('#username').val(),
                    password: $('#password').val()
                };

                // Perform AJAX request.
                const oResponse = executeRequest('checkLogin', oData);

                // If data sent back by the request is true.
                if (oResponse.result === true) {
                    // Redirect to dashboard 
                    $(location).attr('href', oResponse.url)
                } else {
                    // Else, display error message.
                    $('#loginError').html("<span class='text-danger'>" + oResponse.msg + "</span>");

                    // Remove the error message after 2000 milliseconds.
                    setTimeout(function () {
                        $('#loginError').html('');
                    }, 2000);
                }
            }
            else { // This means that there's an error while validating inputs.
                // Display error message.
                $('#loginError').html("<span class='text-danger'>" + validateInputs().msg + "</span>");

                // Remove the error message after 2000 milliseconds.
                setTimeout(function () {
                    $('#loginError').html('');
                }, 2000);
            }
        });

        $(document).on('click', '#resetPassword', function() {
            const oData = {email: $('#email').val()};
            const oResponse = executeRequest('resetPassword', oData);

            $('#resetPasswordError').html("<span class='text-danger'>" + oResponse.msg + "</span>");

                // Remove the error message after 2000 milliseconds.
            setTimeout(function () {
                $('#resetPasswordError').html('');
            }, 2000);
        });
    }

    function executeRequest(sEndpoint, oData) {
        let oResponse = {};
        
        $.ajax({
            method: 'post',          // POST is for sending data to server.
            url: `${sEndpoint}.php`, // This is where the request will go.
            data: oData,             // These are the data to be sent on the URL.
            cache: false,            // Prevent caching the entered values. Can be removed.
            dataType: 'json',        // JSON since we need to receive the response back.
            async: false,            // Turn off asynchronous mode.
            success: (data) => {
                oResponse = data;
            }
        });

        return oResponse;
    }

    function toggleForms(bDisplay) {
        $('form[name="forgotPassword"]').css('display', bDisplay === true ? 'block' : 'none');
        $('form[name="login"]').css('display', bDisplay === true ? 'none' : 'block');
    }

    // This method validates the inputs of the user before submission.
    function validateInputs() {

        // Check username input min length.
        if ($.trim($('#username').val()).length < 4) {
            // Return an object that contains the result and the error message.
            return {
                result: false,
                msg: 'Username must be minimum of 4 characters.'
            };
        }

        // Check username input max length.
        if ($.trim($('#username').val()).length > 15) {
            // Return an object that contains the result and the error message.
            return {
                result: false,
                msg: 'Username must be maximum of 15 characters.'
            };
        }

        // Check password input min length.
        if ($.trim($('#password').val()).length === 0) {
            // Return an object that contains the result and the error message.
            return {
                result: false,
                msg: 'Password cannot be empty.'
            };
        }

        // Return true if no errors on input validations.
        return {
            result: true
        };
    }

    return { init }
})();

$(() => {
    oLoginModule.init();
});