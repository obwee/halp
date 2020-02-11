$(document).ready(function () {

    // If button with an ID of 'login' is clicked...
    $(document).on('click', '#login', function (event) {
        // Prevent defaults. Let javascript submit data instead of HTML.
        event.preventDefault();

        // Assign inputs to variables.
        var username = $('#username').val();
        var password = $('#password').val();

        // Check if above declared variables is not empty.
        if ($.trim(username).length > 0 && $.trim(password).length > 0) {
            // Perform AJAX request.
            $.ajax({
                method: 'post',              // POST is for sending data to server.
                url: 'checkLogin.php',       // This is where the request will go.
                data: {
                    username: username,
                    password: password
                },                           // These are the data to be sent on the URL.
                cache: false,                // Prevent caching the entered values. Can be removed.
                dataType: 'json',            // JSON since we need to receive the response back.
                success: function (data) {
                    // If data sent back by the request is true.
                    if (data.result === true) {
                        // Alert the message.
                        alert(data.msg);
                        // Redirect to dashboard.php 
                        window.location.href = '../dashboard.php';
                    } else {
                        // Else, throw error.
                        alert(data.msg)
                        $('#error').html("<span class='text-danger'>Invalid credentials.</span>");
                    }
                }
            });
        }
        else { // This means that username or password is empty.
            alert('Username/password must not be blank.');
        }
    });
});