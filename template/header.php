<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Nexus IT Training Center</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- AdminLTE CSS/Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="CDNs/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="CDNs/dist/css/skins/skin-blue.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>NXS</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Nexus ITTC</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- OR navbar fixed-top -->
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <span class="hidden-xs" style="color:white;">Hello,</span>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle notifsToggle" data-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="label label-warning count"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <ul class="notifsMenu">
                                </ul>
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->

                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">
                        <i class="fas fa-compass"></i>
                        <span>&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;NAVIGATION</span>
                    </li>
                    <li class="">
                        <a href="dashboard.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>&emsp;Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users-cog"></i>
                            <span>&emsp;Enrollment</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fas fa-mail-bulk"></i>&emsp;Quotation Requests</a></li>
                            <!-- <li><a href="pendingBookings.php"><i class="fas fa-exchange-alt"></i>&emsp;View Pending Bookings</a></li> -->
                            <li><a href="#"><i class="fas fa-check"></i>&emsp;Partially Paid Students</a></li>
                            <li><a href="#"><i class="fas fa-check-double"></i>&emsp;Fully Paid Students</a></li>
                            <li><a href="#"><i class="fas fa-times"></i>&emsp;Unpaid Students</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#.php">
                            <i class="fa fa-folder"></i>
                            <span>&emsp;Reports</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="Reports/trainingReport.php"><i class="fas fa-paper-plane"></i>&emsp;Trainings</a></li>
                            <li><a href="Reports/studentReport.php"><i class="fas fa-paper-plane"></i>&emsp;Student Report</a></li>
                            <li><a href="Reports/salesReport.php"><i class="fas fa-users"></i>&emsp;Sales Report</a></li>
                        </ul>
                    </li>
                    <li>
                    <li class="treeview">
                        <a href="#.php">
                            <i class="fa fa-cog"></i>
                            <span>&emsp;Settings</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="viewSuppliers1.php"><i class="fas fa-parachute-box"></i>&emsp;Course</a></li>
                            <li><a href="editDestinations.php"><i class="fas fa-map-marked-alt"></i>&emsp;Schedule</a></li>
                            <li><a href="editCredentials.php"><i class="fas fa-user-edit"></i>&emsp;Credentials </a></li>
                            <li><a href="editpaymentStatus.php"><i class="fas fa-hand-holding-usd"></i>&emsp;Payment Mode </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php" class="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>&emsp;Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- START OF PAGE CONTENTS (MAIN) -->

        <div class="content-wrapper">