<?php require 'app/database.php';
include('includes/announcements.php');
include('includes/events.php');
include('includes/organization.php');
include('includes/past_events.php');
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
  <link rel="stylesheet" href="src/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="src/fontawesome/css/all.min.css">

  <title>ARSOMS</title>

  <style media="screen">
    .nav-item {
      margin-right: 40px;
      cursor: pointer;
    }

    .nav-item:hover {
      background-color: #355764;
      color: white;
    }
  </style>

</head>

<body class="bg-light" style="font-family: 'Uchen', serif;">
  <div class="text-center p-1 bg-dark">
    <h2 class="text-white">ARS<i class="fa fa-globe"></i>MS</h2>
    <p class="text-white"><?php echo date("F d,Y"); ?> | <a href="#" onclick="register_org()" class="text-white" style="text-decoration:none;">Register</a> | <a href="#" onclick="login()" class="text-white" style="text-decoration:none;">Sign In</a></p>
  </div>

  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center" style="margin: auto;">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="index"><i class="fas fa-home"></i> HOME</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link active" href="article"><i class="fa fa-book"></i> ARTICLES</a>
          </li>
          <!-- <li class="nav-item ">
            <a class="nav-link active" href="aboutus"><i class="fa fa-angle-up"></i> ABOUT US</a>
          </li> -->
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <style>
    body {
      background-color: #EFF8FF;
    }

    .main-section {
      padding: 15px;
      background-color: #fff;
    }

    .list-inline-item {
      border-right: 1px solid black;
      padding-right: 6px;
      line-height: 0.4em;
    }

    .list-inline-item:last-child {
      border: none;
    }

    .post-detail ul {
      margin-top: 15px;
    }
  </style>

  <body>
    <div class="container main-section border">
      <div class="row">
      <?php
            if ($organization) {
              foreach ($organization as $org) {
            ?>
        <div class="col-lg-12 col-sm-12 col-12">
          <div class="row">
                <div class="col-lg-2 col-sm-2 col-5">
                  <img src="admin_organization/modules/organization/logo/<?php echo $org['logo']; ?>" class="img-thumbnail" width="150px">
                </div>
                <div class="col-lg-10 col-sm-10 col-7">
                  <h4 class="text-primary"><?php echo $org['org_name']; ?></h4>
                  <p>
                    <?php echo $org['description']; ?>
                  </p>
                  <button class="btn btn-sm btn-dark" onclick="readMore(<?php echo $org['organization_id'] ?>)">Read more</button>
                </div>
          </div>
          <div class="row post-detail">
            <div class="col-lg-12 col-sm-12 col-12">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <img src="admin_organization/modules/organization/logo/<?php echo $org['logo']; ?>" class="rounded-circle" width="20px"> <span>by</span> <span class="text-info"><?php echo $org['fname']; ?> <?php echo $org['lname']; ?></span>
                </li>
                <li class="list-inline-item">
                  <i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo $org['date_inserted']; ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <hr>
      <?php
              }
            } else {
      ?>

    <?php
            }
    ?>

</div>


      <!-- SIGN IN MODAL -->

      <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header text-center">
              <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Sign In Your Account</h3>
              <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
            </div>
            <form id="form1">
              <div class="modal-body mx-4">
                <div class="md-form">
                  <label data-error="wrong" data-success="right">Login Type<span class="text-danger">*</span></label>
                  <select name="" id="options" class="form-control" style="width: 50%; " required>
                    <option value="" selected hidden>Log in As</option>
                    <option value="1">OSA</option>
                    <option value="3">Student</option>
                    <option value="2">Admin Organization</option>
                    <option value="4">Admin Organization Officer</option>
                  </select>
                  <label data-error="wrong" data-success="right">Username<span class="text-danger">*</span></label>
                  <input type="text" class="form-control validate" id="username" required>
                </div>
                <div class="md-form">
                  <label data-error="wrong" data-success="right">Password<span class="text-danger">*</span></label>
                  <input type="password" class="form-control validate" id="password" required>
                </div>
              </div>

              <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="signinbtn">Sign In</button>
              </div>
            </form>
            <a href="#forgot_pass" data-bs-toggle="modal" class="form-control" style="text-decoration: none;">Forgot password?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- MODALS REGISTER -->
    <div class="modal fade" tabindex="-1" role="dialog" id="registerModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Register (Admin Organization)</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form_register">
            <div class="modal-body">
              <div class="md-form">
                <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control validate" id="add_username">
              </div>
              <div class="md-form">
                <label data-error="wrong" data-success="right">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control validate" id="add_password">
              </div>
              <div class="md-form">
                <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control validate" id="add_fname">
              </div>
              <div class="md-form">
                <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control validate" id="add_lname">
              </div>
              <div class="md-form">
                <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                <select class='form-control' id="add_gender">
                  <option value="" selected hidden>Select Gender</option>
                  <option value="1">Male</option>
                  <option value="0">Female</option>
                </select>
              </div>
              <div class="md-form">
                <label data-error="wrong" data-success="right">Email</label>
                <input type="email" class="form-control validate" id="add_email">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
      </div>
    </div>
    </div>

      <!------------------------------------- Forgot Password------------------------------------------------->
  <div class="modal fade" id="forgot_pass">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
                 <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form id="forgot_pass">
                 <div class="modal-body">
                 <div class="form-group">
                    <br>
                   <input type="email" id="forgot_pass_email" class="form-control" placeholder="Enter your Email" required>
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary" id='btn_forgot'>Submit</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="src/bootstrap/bootstrap.bundle.min.js" charset="utf-8"></script>
  </body>

</html>

<script>
  function readMore(organization_id) {

    let data = '';
    data += 'orgID=' + organization_id;

    window.location.href = "profile?" + data;
  }

  function register_org() {
    $('#registerModal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#registerModal').modal("show")
  }

  function login() {
    $('#loginModal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#loginModal').modal('show')
  }

  $(document).ready(function() {


    //-------------------------------------------- REGISTER SUMBIT ---------------------------------------//
    $('#form_register').on('submit', function(e) {
      e.preventDefault();

      let username = $('#add_username').val();
      let password = $('#add_password').val();
      let lname = $('#add_lname').val();
      let fname = $('#add_fname').val();
      let gender = $('#add_gender').val();
      let email = $('#add_email').val();

      let errors = new Array();
      let input = "Please Input";

      if (username == '') {
        errors.push('Username');
      }
      if (password == '') {
        errors.push('Password');
      }
      if (lname == '') {
        errors.push('Last Name');
      }
      if (fname == '') {
        errors.push('First Name');
      }
      if (gender == '') {
        errors.push('Gender');
      }
      if (email == '') {
        errors.push('Email');
      }
      if (errors.length > 0) {
        let error = '';
        $.each(errors, function(key, value) {
          if (error == '') {
            error += '• ' + value;
          } else {
            error += '\n• ' + value;
          }
        });
        alert(input + '\n' + error);
      } else {

        $.ajax({
          url: 'includes/register',
          type: 'POST',
          data: {
            username: username,
            password: password,
            fname: fname,
            lname: lname,
            gender: gender,
            email: email

          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Registered');
            window.location.reload();
          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })

      }
    })

    //-------------------------- LOG IN -----------------------------------//

    $('#form1').submit(function(e) {
      e.preventDefault();

      let username = $('#username').val();
      let password = $('#password').val();
      let options = $('#options').val();

      if (username == "") {
        alert('Please Enter Username');
      } else if (username == "" && password == "") {
        alert('Please Enter Username & Password');
      } else if (password == "") {
        alert('Please Enter Password');
      } else if (options == '') {
        alert('Please Select Login Type');
      } else {

        $.ajax({
          url: 'includes/login',
          type: 'POST',
          data: {
            username: username,
            password: password,
            options: options
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {

          if (res.res_success == 1) {

            if (options == '1') {
              window.location = 'osa/modules/dashboard';
            }

            if (options == '2') {

              window.location = 'admin_organization/modules/org';
            }

            if (options == '3') {

              window.location = 'students/modules/org';
            }
            if (options == '4') {

              window.location = 'admin_officer/modules/payment';
            }


          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('FAIL!');
        })


      }


    })

    $('#forgot_pass').submit(function(e){
      e.preventDefault();

    let email =   $('#forgot_pass_email').val()

    $.ajax({
          url: 'includes/forgot_pass',
          type: 'POST',
          data: {
              email : email
          },
          dataType: 'JSON',
          beforeSend: function() {
          }
        }).done(function(res) {

          if (res.res_success == 1) {
            swal("We have sent and email!", "please check you email", "success");
            $('#forgot_pass').modal('hide')
          } else {
            swal("Oops...", res.res_message, "error");
          }

        }).fail(function() {
          console.log('FAIL!');
        })

    })




  })
</script>