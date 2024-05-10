<?php
include('../../app/database.php');
if (!$_SESSION['student']) {
  header('location: ../../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
    #overlay {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 2;
      cursor: pointer;
    }

    #text {
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 50px;
      color: white;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
    }
  </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ARSOMS</title>
  <link rel="icon" href="../../img/logo.png">

  <!-- Custom fonts for this template-->
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link rel="stylesheet" href="../../assets/includes/vendor/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../assets/includes/vendor/css/dataTables.bootstrap4.min.css">

  <!-- METIS MENU -->
  <link rel="stylesheet" href="../../assets/includes/metismenu/css/metisMenu.min.css">
  <link rel="shortcut icon" href="../../assets/img/logo.png" type="image/x-icon">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion bg-dark" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i><img src="../../assets/img/logo.png" style="width: 50px;"></i>
        </div>
        <div class="sidebar-brand-text mx-3 ">ARSOMS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <ul class="metismenu" id="menu" style="list-style: none; padding-left: 0; ">
        <div class="sidebar-heading">
          STUDENT
        </div>
        <!-- Tables Buttons -->
        <li class="nav-item ">
          <a class="nav-link" href="org">
            <i class="fas fa-campground"></i>
            <span>Organization</span></a>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="payment">
            <i class="fas fa-money-bill"></i>
            <span>Obligation Fees</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="services">
            <i class="fas fa-cog"></i>
            <span>Services Sanction</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="resolution">
            <i class="fas fa-book"></i>
            <span>Resolution</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#" onclick="change_password()">
            <i class="fas fa-key"></i>
            <span>Changepass</span></a>
        </li>

        <!-- Logout -->
        <li class="nav-item">
          <a class="nav-link" href="../../includes/logout_osa">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
        </li>

      </ul>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['student']['fname'] ?> <?php echo $_SESSION['student']['lname'] ?></span>
                <img class="img-profile rounded-circle" src="../../assets/img/avatar.jpg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" onclick="edit_student(<?php echo $_SESSION['student']['student_id']; ?>)">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
            </div>
        </li>
    </ul>
</nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">