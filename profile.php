<?php require 'app/database.php';
// include('includes/announcements.php');
// include('includes/events.php');
// include('includes/organization.php');
// include('includes/past_events.php');
date_default_timezone_set('Asia/Manila');

$organization_id         = mysqli_real_escape_string($db, trim($_GET['orgID']));
include('includes/organization_profile.php');
include('includes/organization_reports.php');
include('includes/organization_accomplishments.php');
include('includes/announcement_per_post.php');
include('includes/events_per_post.php');
include('includes/past_events_per_post.php');
include('includes/organization_officers.php');
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

        body {

            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
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

    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->
            <!-- <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
        </nav> -->
            <!-- /Breadcrumb -->
            <?php
            if ($organization_profile) {
                foreach ($organization_profile as $prof) {
            ?>
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="admin_organization/modules/organization/logo/<?php echo $prof['logo']; ?>" alt="Admin" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4><?php echo $prof['org_name']; ?></h4>
                                            <p class="text-secondary mb-1">By: <?php echo $prof['fname']; ?> <?php echo $prof['lname']; ?></p>
                                            <p class="text-muted font-size-sm">Date Created: <?php echo $prof['date_logo']; ?></p>
                                            <!-- <button class="btn btn-outline-primary">Message</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                } else {
                        ?>

                        <span class="text-danger">No Data Found</span>

                    <?php
                }
                    ?>

                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0 fw-bold">REPORTS</h6>
                            </li>
                            <?php
                            if ($reports) {
                                foreach ($reports as $rep) {
                            ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0 text-dark"><a href="admin_organization/modules/organization_profile/uploads_reports/<?php echo $rep['reports_file']; ?>"><?php echo $rep['reports_file']; ?></a></h6>
                                    </li>
                                <?php
                                }
                            } else {
                                ?>

                                <span class="text-danger">No Data Found</span>

                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                        </div>

                        <?php
                        if ($organization_profile) {
                            foreach ($organization_profile as $prof) {
                        ?>
                                <div class="col-md-8">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Organization Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <?php echo $prof['org_name']; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <?php echo $prof['email']; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Phone</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <?php echo $prof['number']; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Organization Type</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <?php echo $prof['type']; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Address</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <?php echo $prof['address']; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row gutters-sm">
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h6 class="d-flex align-items-center mb-3 fw-bold"><i class="material-icons text-info mr-2"></i>DESCRIPTION</h6>
                                                    <h6><?php echo $prof['description']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h6 class="d-flex align-items-center mb-3 fw-bold"><i class="material-icons text-info mr-2"></i>MISSION</h6>
                                                    <h6><?php echo $prof['mission']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h6 class="d-flex align-items-center mb-3 fw-bold"><i class="material-icons text-info mr-2"></i>VISION</h6>
                                                    <h6><?php echo $prof['vision']; ?></h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h6 class="d-flex align-items-center mb-3 fw-bold"><i class="material-icons text-info mr-2"></i>GOALS</h6>
                                                    <h6><?php echo $prof['goals']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }
                        } else {
                                ?>

                                <span class="text-danger">No Data Found</span>

                            <?php
                        }
                            ?>

                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="d-flex align-items-center mb-3 fw-bold"><i class="material-icons text-info mr-2"></i>OFFICERS</h6>
                                        <?php
                                        if ($officers) {
                                            foreach ($officers as $off) {
                                        ?>
                                                <div class="row">
                                                    <div class="col-sm-3 ">
                                                        <h6 class="mb-0"><?php echo $off['role']; ?></h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <?php echo $off['name']; ?>
                                                    </div>
                                                </div>
                                                <hr>
                                            <?php
                                            }
                                        } else {
                                            ?>

                                            <span class="text-danger">No Data Found</span>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>



                                </div>
                                <div class="row gutters-sm">
                                    <h6 class="d-flex align-items-center mb-3 fw-bold"><i class="material-icons text-info mr-2"></i>ACCOMPLISHMENTS</h6>
                                    <?php
                                    if ($accomplishment) {
                                        foreach ($accomplishment as $acc) {
                                    ?>
                                            <div class="col-sm-6 mb-3">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <?php if (substr($acc['accomplishment_file'], -4) == ".mp4") { ?>
                                                            <video width="100%" height="300px" controls>
                                                                <source src="admin_organization/modules/organization_profile/uploads_accomplishment/<?php echo $acc['accomplishment_file']; ?>"" type=" video/mp4">
                                                            </video>

                                                        <?php } else if (substr($acc['accomplishment_file'], -5) == ".jpeg" || substr($acc['accomplishment_file'], -4) == ".jpg" || substr($acc['accomplishment_file'], -4) == ".png") { ?>
                                                            <img src="admin_organization/modules/organization_profile/uploads_accomplishment/<?php echo $acc['accomplishment_file']; ?>" alt="No Image" width="100%" height="300px">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php  }
                                    } else {
                                        ?>

                                        <span class="text-danger">No Data Found</span>

                                    <?php
                                    }
                                    ?>
                                </div>

                                <hr>
                                <!-- Page content-->
                                <div class="container mt-5">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <!-- Post content-->
                                            <?php
                                            if ($announcements) {
                                                foreach ($announcements as $ann) {
                                            ?>
                                                    <article>
                                                        <!-- Post header-->
                                                        <header class="mb-4">
                                                            <!-- Post title-->
                                                            <h1 class="fw-bolder mb-1"><?php echo $ann['title']; ?></h1>
                                                            <!-- Post meta content-->
                                                            <div class="text-muted fst-italic mb-2">Posted on <?php echo $ann['date_inserted']; ?> by <?php echo $ann['org_name']; ?></div>
                                                            <!-- Post categories-->

                                                            <?php if ($ann['date_created'] == date("Y-m-d")) { ?>
                                                                <span class="badge text-bg-success">New Announcement!</span>
                                                            <?php } else { ?>
                                                                <!-- BLANK -->
                                                            <?php } ?>

                                                        </header>
                                                        <!-- Preview image figure-->
                                                        <figure class="mb-4"><img class="img-fluid rounded" src="admin_organization/modules/announcements/uploads/<?php echo $ann['photo']; ?>" alt="No Photo" /></figure>
                                                        <!-- Post content-->
                                                        <section class="mb-5">
                                                            <p class="fs-5 mb-4"><?php echo $ann['announcement_desc']; ?></p>

                                                        </section>
                                                    </article>
                                                    <hr>
                                                <?php
                                                }
                                            } else {
                                                ?>

                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <!-- Side widgets-->
                                        <div class="col-lg-4">
                                            <!-- Categories widget-->
                                            <div class="card mb-4">
                                                <div class="card-header  fw-bold">Upcoming Events</div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <?php
                                                        if ($events) {
                                                            foreach ($events as $eve) {
                                                        ?>
                                                                <div class="col-sm-12">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li>
                                                                            <p style="color: blue">
                                                                                <?php if ($eve['event_date_compare'] >= date("Y-m-d")) { ?>
                                                                                    <span class="badge text-bg-success">New Event!</span>
                                                                                <?php } else { ?>
                                                                                    <!-- BLANK -->
                                                                                <?php } ?>
                                                                                <?php echo $eve['event_desc']; ?> [<?php echo $eve['org_name']; ?>] - ( <?php echo $eve['event_date']; ?> - <?php echo $eve['last_event_date']; ?> )
                                                                            </p>
                                                                            <hr>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <span class="text-danger text center fw-bold">No Upcoming Events Yet</span>

                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Categories widget-->
                                            <div class="card mb-4">
                                                <div class="card-header fw-bold">Past Events</div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <?php
                                                        if ($past_events) {
                                                            foreach ($past_events as $ev) {
                                                        ?>
                                                                <div class="col-sm-12">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li>
                                                                            <p style="color:blue"> <?php echo $ev['event_desc']; ?> [<?php echo $ev['org_name']; ?>] - ( <?php echo $ev['event_date']; ?> - <?php echo $ev['last_event_date']; ?> )</p>
                                                                            <hr>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <!-- BLANK -->

                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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



        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="src/bootstrap/bootstrap.bundle.min.js" charset="utf-8"></script>
</body>

</html>

<script>
    function readMore(organization_id) {

        let data = '';
        data += 'orgID=' + organization_id;

        window.location.href = "article?" + data;
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



    })
</script>