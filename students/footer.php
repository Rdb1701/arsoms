</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span> ASSCAT Registered Student Organization Management System 2023</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- MODAL -->
<div class="modal fade" id="change_password_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_change_password">
        <div class="modal-body mx-4">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION['student']['username']; ?>" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="new_password" autocomplete="off">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="re_new_password" autocomplete="off">
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><?php ?> are you sure do you want to logout?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="../../includes/logout_student">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- EDIT MEMBER -->
<?php

?>

<!---------------------------- EDIT MEMBER ----------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="list_edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update">
                <div class="modal-body">
                    <div class="md-form">
                    <input type="hidden" class="form-control validate" id="edit_student_id" disabled>
                        <label data-error="wrong" data-success="right">ID Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_username" disabled>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_fname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_lname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="edit_gender" required>
                            <option value="" selected hidden>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
                        <select class='form-control' id="edit_year" required>
                            <option value="" selected hidden>Select year</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email</label>
                        <input type="email" class="form-control validate" id="edit_email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<!-- <script src="../../assets/vendor/jquery/jquery.min.js"></script> -->
<script src="../../assets/includes/vendor/js/jquery-3.7.0.min.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/includes/metismenu/js/metisMenu.min.js"></script>

<!-- Core plugin JavaScript-->
<!-- <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script> -->
<!-- Custom scripts for all pages-->
<script src="../../assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../assets/includes/vendor/js/jquery.dataTables.min.js"></script>
<script src="../../assets/includes/vendor/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/includes/vendor/js/dataTables.buttons.min.js"></script>
<script src="../../assets/includes/vendor/js/buttons.bootstrap4.min.js"></script>

<!-- PRINTING -->
<script src="../../assets/includes/vendor/js/buttons.html5.min.js"></script>
<script src="../../assets/includes/vendor/js/buttons.colVis.min.js"></script>
<script src="../../assets/includes/vendor/js/buttons.print.min.js"></script>
<script src="../../assets/includes/vendor/js/pdfmake.min.js"></script>
<script src="../../assets/includes/vendor/js/vfs_fonts.js"></script>
<script src="../../assets/includes/vendor/js/jszip.min.js"></script>


<!-- Page level custom scripts -->

<script src="../../assets/js/demo/datatables-demo.js"></script>
<script src="../../assets/js/city.js"></script>



</body>

</html>
<script>

function edit_student(student_id) {
      $.ajax({
        url: 'profile/student_edit',
        type: 'POST',
        data: {
          student_id: student_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {

        $("#edit_gender").val(res.gender);
        $("#edit_student_id").val(res.student_id);
        $("#edit_username").val(res.username);
        $("#edit_lname").val(res.lname);
        $("#edit_fname").val(res.fname);
        $("#edit_email").val(res.email);
        $("#edit_year").val(res.year_level);
        $('#list_edit_modal').modal('show');

      }).fail(function() {
        console.log("FAIL");
      })
    }


  function change_password() {
    
    $('#change_password_modal').modal('show');

  }

  $(function() {

    "use strict";

    $(".mobile-toggle-menu").on("click", function() {
        $(".wrapper").addClass("toggled")
      }),

      $(".toggle-icon").click(function() {
        $(".wrapper").hasClass("toggled") ? ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
          $(".wrapper").addClass("sidebar-hovered")
        }, function() {
          $(".wrapper").removeClass("sidebar-hovered")
        }))
      }),

      $(document).ready(function() {
        $(window).on("scroll", function() {
          $(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
        }), $(".back-to-top").on("click", function() {
          return $("html, body").animate({
            scrollTop: 0
          }, 600), !1
        })
      }),

      $(function() {
        for (var e = window.location, o = $(".metismenu li a").filter(function() {
            return this.href == e
          }).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
      }),

      $(function() {
        $("#menu").metisMenu()
      })



  });

  

  $(document).ready(function() {
    $('#form_change_password').submit(function(e) {
      e.preventDefault();

      let new_password = $('#new_password').val();
      let re_new_password = $('#re_new_password').val();

      if (new_password == re_new_password && new_password != '') {
        $.ajax({
          url: 'changepass/changepass',
          type: 'POST',
          data: {
            password: new_password
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          console.log('Done!');
          $('#change_password_modal').modal('hide');
          alert('Password Changed!');
        }).fail(function() {
          console.log('Fail!');
        });
      } else {
        alert("Invalid password!");
      }

    });

    //--------------------------------------------UPDATE Student---------------------------------------//
    $('#form_update').on('submit', function(e) {
        e.preventDefault();

        let student_id = $('#edit_student_id').val();
        let lname      = $('#edit_lname').val();
        let fname      = $('#edit_fname').val();
        let gender     = $('#edit_gender').val();
        let year_level = $('#edit_year').val();
        let email      = $('#edit_email').val();


        $.ajax({
          url: 'profile/student_update',
          type: 'POST',
          data: {
            student_id: student_id,
            fname: fname,
            lname: lname,
            gender: gender,
            year_level: year_level,
            email: email,
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Update Information');

            $('#list_edit_modal').modal('hide');
          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })
      })

  });

  const popupCenter = ({
    url,
    title,
    w,
    h
  }) => {
    // Fixes dual-screen position                             Most browsers      Firefox
    const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
    const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

    const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    const systemZoom = width / window.screen.availWidth;
    const left = (width - w) / 2 / systemZoom + dualScreenLeft
    const top = (height - h) / 2 / systemZoom + dualScreenTop
    const newWindow = window.open(url, title,
      `
      			scrollbars=yes,
      			width=${w / systemZoom}, 
      			height=${h / systemZoom}, 
      			top=${top}, 
      			left=${left}
      			`
    )

    if (window.focus) newWindow.focus();
  }
</script>