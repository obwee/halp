<?php
session_start();

if(isset($_SESSION['submit']) === true) {
    header("Location:../dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nexus ITTC Admin Login</title>

    <script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="Img/Untitled-1.png" alt="logo">
        </div>
        <div class="login-container">
            <form method="post" name="login">
                <img class="avatar" src="Img/undraw_profile_pic_ic5t.svg" alt="avatar">
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <input class="input" type="text" name="username" id="username">
                    </div>                    
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input class="input" type="password" name="password" id="password">
                    </div>
                </div>
                <a href="#">Forgot Password?</a>
                <input type="submit" class="btn" value="Login" name="login" id="login">
                <div id="error"></div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {

            // If button with an ID of 'login' is clicked...
            $(document).on('click', '#login', function(event) {
                // Prevent defaults. Let javascript submit data instead of HTML.
                event.preventDefault();

                // Assign inputs to variables.
                var username = $('#username').val();
                var password = $('#password').val();

                // Check if above declared variables is not empty.
                if($.trim(username).length > 0 && $.trim(password).length > 0)
                {
                    // Perform AJAX request.
                    $.ajax({
                        method: 'post',              // POST is for sending data to server.
                        url: 'checkLogin.php',       // This is where the request will go.
                        data: {
                            username:username,
                            password:password
                        },                           // These are the data to be sent on the URL.
                        cache: false,                // Prevent caching the entered values. Can be removed.
                        dataType: 'json',            // JSON since we need to receive the response back.
                        success:function(data) {
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

    </script> 

</body> 
</html>