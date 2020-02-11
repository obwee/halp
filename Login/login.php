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
    <script type="text/javascript" src="js/login.js"></script>
    
</body> 
</html>