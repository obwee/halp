<?php
session_start();
include_once 'utils/autoload.php';
require_once 'utils/vendor/autoload.php';

/**
 * This file is automatically prepended to any file via .htaccess file.
 * This also acts as a middleware that checks if a user is currently logged-in or not.
 * It also performs redirection. 
 */

// if (Session::isset('isLoggedIn') === true) {
//     if (preg_match('/\/homepage\/|\/login\//i', $_SERVER['REQUEST_URI'])) {
//         // Redirect to dashboard.
//         $_SESSION["LOA"] === 'Student' ? header('Location: /Nexus/dashboard/student/studentDashboard') : header('Location: /Nexus/dashboard');
//         exit();
//     }
// } else {
//     if (!preg_match('/\/homepage\/|\/login\//i', $_SERVER['REQUEST_URI'])) {
//         // Redirect to homepage.
//         header('Location: /Nexus/homepage/welcome');
//         exit();
//     }
// }
