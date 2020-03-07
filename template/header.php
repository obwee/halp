<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nexus IT Training Center</title>
  

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../CDNs/dashboard/font-awesome/css/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../CDNs/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../CDNs/dist/css/skins/skin-blue.min.css"> 
   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- Datatables -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

   <!-- <link rel="stylesheet" type="text/css" href="../CDNs/admin.css"> -->

   <style type="text/css">
   .dropdown-menu{
    max-height:300px;
    overflow-y: scroll;
  }
</style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>NXS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Nexus ITTC</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top"> <!-- OR navbar fixed-top -->
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <span class="hidden-xs" style="color:white;">Hello,!</span>

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
            <i class="fas fa-file-invoice"></i>
            <span>&emsp;  Quotations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="quotationRequest.php"><i class="fas fa-mail-bulk"></i>&emsp;Quotation Requests</a></li>
            <li><a href="sentQuotations.php"><i class="fas fa-paper-plane"></i>&emsp;Sent Quotations</a></li>
          </ul>
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
            <li><a href="payment.php"><i class="fas fa-cash-register"></i>&emsp;Payment</a></li>
            <li><a href="reservations.php"><i class="fas fa-check"></i>&emsp;Reservations</a></li>
            <li><a href="unpaidStudents.php"><i class="fas fa-user-times"></i>&emsp;Unpaid Students</a></li>
            <li><a href="cancelledReservations.php"><i class="fas fa-times"></i>&emsp;  Cancelled Reservations</a></li>
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
            <li><a href="salesReport.php"><i class="fas fa-money-check"></i>&emsp;Sales</a></li>
            <li><a href="masterList.php"><i class="fas fa-user-graduate"></i>&emsp;  Students</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#.php">
            <i class="fas fa-users"></i> 
            <span>&emsp;Trainings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="editCourse.php"><i class="fas fa-book"></i>&emsp;Courses</a></li>
            <li><a href="schedule.php"><i class="far fa-calendar-alt"></i>&emsp;  Schedule</a></li>
          </ul>
        </li>
        <li>
         <li class="treeview">
          <a href="">
            <i class="fa fa-cog"></i> 
            <span>&emsp;Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="venue.php"><i class="fas fa-map-marked-alt"></i>&emsp; Venue</a></li>
            <li><a href="instructors.php"><i class="fas fa-chalkboard-teacher"></i>&emsp;Instructors </a></li>
            <li><a href="credentials.php"><i class="fas fa-user-edit"></i>&emsp;Credentials </a></li>
            <li><a href="paymentMode.php"><i class="fas fa-hand-holding-usd"></i>&emsp; Payment Mode </a></li>
          </ul>
        </li>
        <li>
          <a href="" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>&emsp;   Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- START OF PAGE CONTENTS (MAIN) -->

  <div class="content-wrapper">