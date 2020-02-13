<?php
session_start();
session_destroy();

// Check if user is currently logged-in by checking if isLoggedIn session is set and has a value.
if (isset($_SESSION['isLoggedIn']) === true && $_SESSION['isLoggedIn'] === true) {
    header("Location:/dashboard");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nexus ITTC Login</title>

    <script src="https://kit.fontawesome.com/be76a30cc4.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>

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
                <input type="button" class="btn" value="Login" name="login" id="login">
                <div id="error" style="color: red;"></div>
            </form>
        </div>
    </div>



</body>

</html>