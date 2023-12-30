<?php
include '../header.php';
?>

<div class="page-heading">
  <h3 class="">Accounts</h3>
</div>
<br>
<div>
  <button onclick="add_account()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Account</button>

  <div class="page-content ttable">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center">Username</th>
                <th class="text-center">Name</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Email</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <!------------------------- CONTENT TABLE ------------------------------>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <?php
  include '../footer.php';
  include 'modal/user_modal.php';
  ?>

  <script>
    function delete_user(user_id) {
      $('#delete_id').val(user_id);
      $('#delete_modal').modal('show');
    }

    function member_change(user_id, username) {

      $('#cp_id').val(user_id);
      $('#cp_username').val(username);
      $('#changepassword_modal').modal('show');

    }

    function add_account() {
      $('#list_add_modal').modal({
        backdrop: 'static',
        keyboard: false
      })
      $('#list_add_modal').modal('show')
    }

    //EDIT OFFICER
    function edit_user(user_id) {
      $.ajax({
        url: 'user/user_edit',
        type: 'POST',
        data: {
          user_id: user_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {

        $("#edit_gender").val(res.gender);
        $("#edit_user_id").val(res.user_id);
        $("#edit_username").val(res.username);
        $("#edit_lname").val(res.lname);
        $("#edit_fname").val(res.fname);
        $("#edit_email").val(res.email);
        $('#list_edit_modal').modal('show');

      }).fail(function() {
        console.log("FAIL");
      })
    }

    $(document).ready(function() {

      var table = $('#myTable').DataTable({
        ajax: 'user/user_view', // API endpoint to fetch data
        columns: [{
            data: [0],
            "className": "text-center"
          },
          {
            data: [1],
            "className": "text-center"
          },
          {
            data: [2],
            "className": "text-center"
          },
          {
            data: [3],
            "className": "text-center"
          },
          {
            data: [4],
            "className": "text-center"
          }
        ]

      });

      // <---------------------------- ADD Officer SUMBIT ------------------------------------->
      $('#form_add').on('submit', function(e) {
        e.preventDefault();

        let username = $('#add_username').val();
        let lname = $('#add_lname').val();
        let fname = $('#add_fname').val();
        let gender = $('#add_gender').val();
        let year_level = $('#add_year').val();
        let email = $('#add_email').val();


        $.ajax({
          url: 'user/user_add',
          type: 'POST',
          data: {
            username: username,
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
            alert('The Username is the Username and Password!');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);

            $('#list_add_modal').modal('hide');
          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })
      })

      //--------------------------------------------UPDATE Student---------------------------------------//
      $('#form_update').on('submit', function(e) {
        e.preventDefault();

        let user_id = $('#edit_user_id').val();
        let username = $('#edit_username').val();
        let lname = $('#edit_lname').val();
        let fname = $('#edit_fname').val();
        let gender = $('#edit_gender').val();
        let year_level = $('#edit_year').val();
        let email = $('#edit_email').val();
        $.ajax({
          url: 'user/user_update',
          type: 'POST',
          data: {
            user_id: user_id,
            username: username,
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
            alert('Successfully Update Information');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);

            $('#list_edit_modal').modal('hide');
          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })
      })


      //DELETING STUDENTS INFORMATION
      $('#delete_form').submit(function(e) {
        e.preventDefault()

        let user_id = $('#delete_id').val()

        $.ajax({
          url: 'user/user_delete',
          type: 'POST',
          data: {
            user_id: user_id

          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Removed');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);
            $('#delete_modal').modal('hide');

          } else {
            alert()
            alert(res.res_message);
          }
        }).fail(function() {
          console.log("FAIL");
        })

      })

      // -----------------------CHANGE PASSWORD ----------------------------- //
      $('#d_form_cp').on('submit', function(e) {
        e.preventDefault();

        let user_id = $('#cp_id').val();
        let new_password = $('#cp_new_password').val()
        let re_new_password = $('#cp_re_new_password').val()

        if (new_password == '' || re_new_password == '') {
          alert('Please input Password')
        } else if (new_password != re_new_password) {
          alert('Password do not match!')

        } else if (new_password == re_new_password) {

          $.ajax({
            url: 'user/user_changepass',
            type: 'POST',
            data: {
              user_id: user_id,
              new_password: new_password,
              re_new_password: re_new_password,
            },
            dataType: 'JSON',
            beforeSend: function() {

            }
          }).done(function(res) {
            if (res.res_success == 1) {
              alert('Password Changed!');
              $('#changepassword_modal').modal('hide');
            } else {
              alert('Invalid Password!');

            }
          })

        }


      })




    })
  </script>