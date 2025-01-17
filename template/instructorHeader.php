<?php
//echo $_SESSION["LOA"] !== 'Student' ? "<script type='text/javascript'>window.history.back();</script>" : '';
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nexus IT Training Center | INSTRUCTOR</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Nexus/CDNs/dashboard/font-awesome/css/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/Nexus/CDNs/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/Nexus/CDNs/dist/css/skins/skin-yellow.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="../CDNs/admin.css"> -->

    <style type="text/css">
        .dropdown-menu {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>

</head>

<body class="hold-transition skin-yellow sidebar-mini">


    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>NXS</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Nexus - Instructor</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- OR navbar fixed-top -->
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <span class="hidden-xs" style="color:white;">Hello, <?php echo Session::get('fullName'); ?>!</span>

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
                        <a href="index.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>&emsp;Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-chalkboard-teacher"></i>
                            <span>&emsp;Class</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href=""><i class="fas fa-calendar"></i>&emsp;Schedule</a></li>
                            <li><a href=""><i class="fas fa-list"></i>&emsp;Class List</a></li>
                        </ul>
                    </li>
                    <li>
                    <li>
                        <a href="profile.php"><i class="fas fa-user-edit"></i>&emsp;Profile </a>
                    </li>   
                    <li>
                        <a href="" class="logout">

                            <i class="fas fa-sign-out-alt"></i>
                            <span>&emsp; Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- START OF PAGE CONTENTS (MAIN) -->

        <div class="content-wrapper">