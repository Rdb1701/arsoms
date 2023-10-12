<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMS
  </title>
  <link rel="icon" href="assets/img/logo.png">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="assets/css/styles.css" rel="stylesheet" />
  <link rel="shortcut icon" href="assets/img/logo.php" type="image/x-icon">
</head>

<body class="bg-dark">
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="assets/img/logo.png" alt="" class="img-fluid" style="border-radius: 1rem 0 0 1rem; width:500%; margin-top: 35px; margin-left:5%;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form id="form1">

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <!-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> -->
                      <span class="h1 fw-bold mb-0"><img src="assets/img/asscat.jpeg" alt="" width="100%"></span>
                    </div>

                    <select name="" id="options" class="">
                      <option value="" selected hidden>Log in As</option>
                      <option value="1">OSA</option>
                      <option value="2">Admin Organization</option>
                      <option value="3">Student</option>
                    </select><br><br>


                    <div class="form-outline mb-4">
                      <input type="text" id="username" class="form-control form-control-lg" />
                      <label class="form-label" for="username">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="password" class="form-control form-control-lg" />
                      <label class="form-label" for="password">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
  $(document).ready(function() {

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

          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('FAIL!');
        })
      }
    })


    //document ready
  })
</script>