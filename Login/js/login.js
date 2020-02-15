$(document).ready(function () {

    // Add input text effect on focus event.
    $(document).on('focus', '.input', function() {
        this.parentNode.parentNode.classList.add('focus');
    });

    // Add input text effect on focusout event.
    $(document).on('focusout', '.input', function() {
        if(this.value === ''){
            this.parentNode.parentNode.classList.remove('focus');
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

    // Check if ENTER key is pressed.
    $(document).keypress(function (event) {
        if ((event.keyCode ? event.keyCode : event.which) === 13) {
            $('#login').click();
        }
    });

    // If button with an ID of 'login' is clicked...
    $(document).on('click', '#login', function () {

        // Check first if inputs are valid using the validateInputs() function.
        if (validateInputs().result === true) {
            // Perform AJAX request.
            $.ajax({
                method : 'post',              // POST is for sending data to server.
                url    : 'checkLogin.php',       // This is where the request will go.
                data : {
                    username : $('#username').val(),
                    password : $('#password').val()
                },                           // These are the data to be sent on the URL.
                cache    : false,                // Prevent caching the entered values. Can be removed.
                dataType : 'json',            // JSON since we need to receive the response back.
                success  : function (data) {
                    // If data sent back by the request is true.
                    if (data.result === true) {
                        // Redirect to dashboard 
                        $(location).attr('href', '../dashboard')
                    } else {
                        // Else, display error message.
                        $('#error').html("<span class='text-danger'>" + data.msg + "</span>");

                        // Remove the error message after 2000 milliseconds.
                        setTimeout(function () {
                            $('#error').html('');
                        }, 2000);
                    }
                }
            });
        }
        else { // This means that there's an error while validating inputs.
            // Display error message.
            $('#error').html("<span class='text-danger'>" + validateInputs().msg + "</span>");

            // Remove the error message after 2000 milliseconds.
            setTimeout(function () {
                $('#error').html('');
            }, 2000);
        }
    });

    // This method validates the inputs of the user before submission.
    function validateInputs() {

        // Check username input min length.
        if ($.trim($('#username').val()).length < 4) {
            // Return an object that contains the result and the error message.
            return {
                result : false,
                msg    : 'Username must be minimum of 4 characters.'
            };
        }

        // Check username input max length.
        if ($.trim($('#username').val()).length > 15) {
            // Return an object that contains the result and the error message.
            return {
                result : false,
                msg    : 'Username must be maximum of 15 characters.'
            };
        }

        // Check password input min length.
        if ($.trim($('#password').val()).length === 0) {
            // Return an object that contains the result and the error message.
            return {
                result : false,
                msg    : 'Password cannot be empty.'
            };
        }

        // Return true if no errors on input validations.
        return {
            result : true
        };
    }

});