<?php
include("../header.php");
?>

<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '" . $_SESSION['admin_org']['user_id'] . "' AND (status = '1' OR status = '4')";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='btn btn-outline-success' name='type' id = 'rso_1' required>";
$opt1 .= "<option value='' selected hidden>Select RSO</option>";
while ($row = mysqli_fetch_assoc($result)) {
  $opt1 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt1 .= "</select>";
?>
<div class="page-heading">
  <h3 class="">Members</h3>
</div>
<br>
<div>
  <button onclick="add_member()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Member</button>
  <button onclick="add_excel()" data-toggle="modal" class="btn btn-success" type="button"><i class="fa fa-file-excel"></i> Excel File</button>
  <a href="../../assets/template/member.xlsx" class="btn btn-success"><i class="fa fa-file-excel"></i> Excel Template</a>
  <br><br>
  <span>FILTER:</span>
  <div class="d-flex">
    <form id="form_select">
      <?php echo $opt1; ?>
      <select class='btn btn-outline-success' id="year_levell" required>
        <option value="" selected hidden>Select year</option>
        <option value="1">1st Year</option>
        <option value="2">2nd Year</option>
        <option value="3">3rd Year</option>
        <option value="4">4th Year</option>
      </select>
      <button type="button" class="btn btn-primary" onclick="member_search()"><i class="fa fa-magnifying-glass"></i> Search</button>
    </form>
    <br><br>
  </div>
  <div class="page-content ttable">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                <th class="text-center">ID Number</th>
                <th class="text-center">Member Name</th>
                <th class="text-center">Organization</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Year Level</th>
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

  ?>

  <?php
  include("modal/modal_member.php");
  include("../footer.php");
  ?>


  <script>
    function member_search(subject_id) {
      let year_level = $('#year_levell').val()
      let rso = $('#rso_1').val();

      let data = '';
      data += 'year_level=' + year_level + '&';
      data += 'rso=' + rso;

      if (year_level != '' && rso != '') {
        window.location.href = "member_search?" + data;
      } else {
        alert("Please Input Filter")
      }
    }



    function add_excel() {
      $('#upload_excel_modal').modal({
        backdrop: 'static',
        keyboard: false
      })
      $('#upload_excel_modal').modal('show')
    }

    function member_change(student_id, username) {

      $('#cp_id').val(student_id);
      $('#cp_username').val(username);
      $('#changepassword_modal').modal('show');

    }

    function delete_member(orgnization_id, username) {
      $('#delete_id').val(orgnization_id);
      $('#usern').val(username);
      $('#delete_modal').modal('show');
    }


    function add_member() {
      $('#list_add_modal').modal({
        backdrop: 'static',
        keyboard: false
      })
      $('#list_add_modal').modal('show')
    }

    function edit_member(student_id) {
      $.ajax({
        url: 'members/member_edit',
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
        $("#edit_rso").val(res.rso);
        $("#edit_year").val(res.year_level);
        $('#list_edit_modal').modal('show');

      }).fail(function() {
        console.log("FAIL");
      })
    }

    $(document).ready(function() {

      // $('#myTable thead tr')
      //   .clone(true)
      //   .addClass('filters')
      //   .appendTo('#myTable thead');

      var table = $('#myTable').DataTable({
        ajax: 'members/member_view', // API endpoint to fetch data
        columns: [{
            data: null,
            className: "text-center",
            render: function(data, type, row, meta) {
              // Calculate the index based on the current page and page length
              var page = table.page.info().page;
              var length = table.page.info().length;
              var index = (page * length) + meta.row + 1;
              return index;
            }
          },
          {
            data: [0],
            className: "text-center"
          },
          {
            data: [1],
            className: "text-center"
          },
          {
            data: [2],
            className: "text-center"
          },
          {
            data: [3],
            className: "text-center"
          },
          {
            data: [4],
            className: "text-center"
          },
          {
            data: [5],
            className: "text-center"
          },
          {
            data: [6],
            className: "text-center"
          },

        ],
        // dom: "Bfrtip",
        // buttons: [{
        //     extend: "pageLength",
        //     className: "btn-sm btn-success",
        //   },
        //   {
        //     extend: "copy",
        //     className: "btn-sm btn-success",
        //     exportOptions: {
        //       columns: [0, 1, 2, 3, 4, 5, 6]
        //     }
        //   },
        //   {
        //     extend: "csv",
        //     className: "btn-sm btn-success",
        //     exportOptions: {
        //       columns: [0, 1, 2, 3, 4, 5, 6]
        //     }
        //   },
        //   {
        //     extend: "excel",
        //     className: "btn-sm btn-success",
        //     exportOptions: {
        //       columns: [0, 1, 2, 3, 4, 5, 6]
        //     }
        //   },
        //   {
        //     extend: "pdfHtml5",
        //     className: "btn-sm btn-success",
        //     exportOptions: {
        //       columns: [0, 1, 2, 3, 4, 5, 6]
        //     }
        //   },
        //   {
        //     extend: "print",
        //     className: "btn-sm btn-success",
        //     title: '.',
        //     exportOptions: {
        //       columns: [0, 1, 2, 3, 4, 5, 6]
        //     },
        //     message: '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>\
        //     <h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>\
        //     <h6>BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</h6>\
        //     </center><br>\
        //     <center>STUDENT ORGANIZATION MEMBERS</center><br>\
        //     ',
        //     customize: function(win) {
        //       $(win.document.body).find('table').append('<br><br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');
        //     }

        //   }
        // ]
      });

      // Event listener for when the table is redrawn
      table.on('draw', function() {
        // Update the first column to display dynamic values
        table.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      });


      // <---------------------------- ADD MEMBER SUMBIT ------------------------------------->
      $('#form_add').on('submit', function(e) {
        e.preventDefault();

        let username = $('#add_username').val();
        let lname = $('#add_lname').val();
        let fname = $('#add_fname').val();
        let gender = $('#add_gender').val();
        let year_level = $('#add_year').val();
        let email = $('#add_email').val();
        let rso = $('#add_rso').val();

        $.ajax({
          url: 'members/member_add',
          type: 'POST',
          data: {
            username: username,
            fname: fname,
            lname: lname,
            gender: gender,
            year_level: year_level,
            email: email,
            rso: rso
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('The ID Number is the Username and Password!');
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

        let student_id = $('#edit_student_id').val();
        let lname = $('#edit_lname').val();
        let fname = $('#edit_fname').val();
        let gender = $('#edit_gender').val();
        let year_level = $('#edit_year').val();
        let email = $('#edit_email').val();
        let rso = $('#edit_rso').val();

        $.ajax({
          url: 'members/member_update',
          type: 'POST',
          data: {
            student_id: student_id,
            fname: fname,
            lname: lname,
            gender: gender,
            year_level: year_level,
            email: email,
            rso: rso
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

        let organization_id = $('#delete_id').val()
        let username = $('#usern').val()

        $.ajax({
          url: 'members/member_delete',
          type: 'POST',
          data: {
            organization_id: organization_id,
            username: username

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

      // -----------------------------FIRST EXCEL-------------------------------------------//

      $("#upload_excel").on("submit", function(e) {
        e.preventDefault();

        var fd = new FormData($("#upload_excel")[0]);
        var files = $("#excel_1")[0].files;

        for (item of fd) {
          console.log(item[0], item[1]);
        }
        // Check file selected or not
        if (files.length > 0) {
          fd.append('excel_1', files[0]);

          $.ajax({
            url: 'members/member_excel_upload',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(res) {

              if (res == 1) {
                alert("Successfully Added");
                var currentPageIndex = table.page.info().page;
                table.ajax.reload(function() {
                  table.page(currentPageIndex).draw(false);
                }, false);
                $('#upload_excel_modal').modal('hide');
              } else if (res == 2) {
                alert("Has Exists ID Number");
                $('#upload_excel_modal').modal('hide');
              } else {
                alert('file not uploaded');
              }
            },
          });
        } else {
          alert("Please select a file.");
        }
      })


      // -----------------------CHANGE PASSWORD ----------------------------- //
      $('#d_form_cp').on('submit', function(e) {
        e.preventDefault();

        let student_id = $('#cp_id').val();
        let new_password = $('#cp_new_password').val()
        let re_new_password = $('#cp_re_new_password').val()

        if (new_password == '' || re_new_password == '') {
          alert('Please input Password')
        } else if (new_password != re_new_password) {
          alert('Password do not match!')

        } else if (new_password == re_new_password) {

          $.ajax({
            url: 'members/member_changepass',
            type: 'POST',
            data: {
              student_id: student_id,
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


      //document ready
    })
  </script>