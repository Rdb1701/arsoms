<?php
include("../header.php");
?>
<div class="page-heading">
  <h3 class="">Members</h3>
</div>
<br>
<div>
  <button onclick="add_member()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Member</button>
</div><br>
<div class="page-content ttable">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
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
  function delete_member(student_id) {
    $('#delete_id').val(student_id);
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

        },
        {
          data: [5],
          "className": "text-center"
        },
        {
          data: [6],
          "className": "text-center"
        }
      ],
      dom: "Bfrtip",
      buttons: [{
          extend: "pageLength",
          className: "btn-sm btn-success",
        },
        
        {
          extend: "copy",
          className: "btn-sm btn-success",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: "csv",
          className: "btn-sm btn-success",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: "excel",
          className: "btn-sm btn-success",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: "pdfHtml5",
          className: "btn-sm btn-success",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          }
        },
        {
          extend: "print",
          className: "btn-sm btn-success",
          title: '.',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5]
          },
          message: '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>\
							<h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>\
							<h6>BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</h6>\
							</center><br>\
              <center>STUDENT ORGANIZATION MEMBERS</center>',
          customize: function(win) {
            $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

          }
        }
      ]

       // orderCellsTop: true,
      // fixedHeader: true,
      // initComplete: function() {
      //   var api = this.api();

      //   // For each column
      //   api
      //     .columns()
      //     .eq(0)
      //     .each(function(colIdx) {
      //       // Set the header cell to contain the input element
      //       var cell = $('.filters th').eq(
      //         $(api.column(colIdx).header()).index()
      //       );
      //       var title = $(cell).text();
      //       $(cell).html('<input type="text" placeholder="' + title + '" />');

      //       // On every keypress in this input
      //       $(
      //           'input',
      //           $('.filters th').eq($(api.column(colIdx).header()).index())
      //         )
      //         .off('keyup change')
      //         .on('change', function(e) {
      //           // Get the search value
      //           $(this).attr('title', $(this).val());
      //           var regexr = '({search})'; //$(this).parents('th').find('select').val();

      //           var cursorPosition = this.selectionStart;
      //           // Search the column for that value
      //           api
      //             .column(colIdx)
      //             .search(
      //               this.value != '' ?
      //               regexr.replace('{search}', '(((' + this.value + ')))') :
      //               '',
      //               this.value != '',
      //               this.value == ''
      //             )
      //             .draw();
      //         })
      //         .on('keyup', function(e) {
      //           e.stopPropagation();

      //           $(this).trigger('change');
      //           $(this)
      //             .focus()[0]
      //             .setSelectionRange(cursorPosition, cursorPosition);
      //         });
      //     });
      // },
    });




    // <---------------------------- ADD MEMBER SUMBIT ------------------------------------->
    $('#form_add').on('submit', function(e) {
      e.preventDefault();

      let username   = $('#add_username').val();
      let lname      = $('#add_lname').val();
      let fname      = $('#add_fname').val();
      let gender     = $('#add_gender').val();
      let year_level = $('#add_year').val();
      let email      = $('#add_email').val();
      let rso        = $('#add_rso').val();

      $.ajax({
        url: 'members/member_add',
        type: 'POST',
        data: {
          username  : username,
          fname     : fname,
          lname     : lname,
          gender    : gender,
          year_level: year_level,
          email     : email,
          rso       : rso
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

      let student_id    = $('#edit_student_id').val();
      let lname         = $('#edit_lname').val();
      let fname         = $('#edit_fname').val();
      let gender        = $('#edit_gender').val();
      let year_level    = $('#edit_year').val();
      let email         = $('#edit_email').val();
      let rso           = $('#edit_rso').val();

      $.ajax({
        url: 'members/member_update',
        type: 'POST',
        data: {
          student_id  : student_id,
          fname       : fname,
          lname       : lname,
          gender      : gender,
          year_level  : year_level,
          email       : email,
          rso         : rso
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

      let student_id = $('#delete_id').val()

      $.ajax({
        url: 'members/member_delete',
        type: 'POST',
        data: {
          student_id: student_id

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


    //document ready
  })
</script>