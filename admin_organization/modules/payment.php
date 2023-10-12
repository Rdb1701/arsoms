<?php
include('../header.php');
?>

<div class="page-heading">
  <h3 class="">Obligation Fee</h3>
</div>
<br>
<div>
  <button onclick="add_fee()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-users"></i><i class="fa fa-users"></i> Populate Obligation Fees</button>
  <?php
  $query = "SELECT * FROM tbl_payment";
  $result = mysqli_query($db, $query);

  if (!mysqli_num_rows($result)) {
  ?>
    <!-- <button onclick="add_one_fee()" data-toggle="modal" class="btn btn-primary" type="button" disabled><i class="fa fa-user-plus"></i> Add Obligation Fee</button> -->
  <?php } else { ?>
    <!-- <button onclick="add_one_fee()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-user-plus"></i> Add Obligation Fee</button> -->
  <?php } ?>

</div><br>
<div class="page-content ttable">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Student Name</th>
              <th class="text-center">Year Level</th>
              <th class="text-center">Event Name</th>
              <th class="text-center">Date of Event</th>
              <th class="text-center">Obligation Fees</th>
              <th class="text-center">Status</th>
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
include('modal/modal_payment.php');
include('../footer.php');
?>

<script>
  function send_receipt(payemnt_id) {
    $('#send_id').val(payemnt_id);
    $('#send_modal').modal('show');
  }

  function delete_payment(payment_id) {
    $('#delete_id').val(payment_id);
    $('#delete_modal').modal('show');
  }

  function add_fee() {
    $('#add_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#add_modal').modal('show');
  }


  function add_one_fee() {
    $('#add_pmodal').modal('show')
  }


  $(document).ready(function() {

    var table = $('#myTable').DataTable({
      ajax: 'payments/payment_view', // API endpoint to fetch data
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
          className: "btn-sm btn-success"
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
							</center><br>',
          customize: function(win) {
            $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

          }
        }
      ]
    });

    //ADD Student per Payment
    $('#form_payment_p').on('submit', function(e) {
      e.preventDefault();

      let event = $('#add_event_p').val();
      let student_id = $('#add_student').val();
      let fee = $('#add_fee_p').val();


      $.ajax({
        url: 'payments/payment_per_add',
        type: 'POST',
        data: {
          event : event,
          fee   : fee,
          student_id: student_id
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Added the Student!');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);
          $('#add_pmodal').modal('hide');

        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })

    })

    //ADD Payment
    $('#form_payment').on('submit', function(e) {
      e.preventDefault();

      let event = $('#add_event').val();
      let fee = $('#add_fee').val();

      $.ajax({
        url: 'payments/payment_add',
        type: 'POST',
        data: {
          event : event,
          fee   : fee
        },
        dataType: 'JSON',
        beforeSend: function() {
          $('#p_fee').prop('disabled', true);
          // Show image container
          $("#loader").show();
        }
      }).done(function(res) {
        if (res.res_success == 1) {
          $("#loader").hide();
          alert('Successfully Added!');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);
          $('#add_modal').modal('hide');

        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })

    })

    //DELETING Payment
    $('#delete_form').submit(function(e) {
      e.preventDefault()

      let payment_id = $('#delete_id').val()

      $.ajax({
        url: 'payments/payment_delete',
        type: 'POST',
        data: {
          payment_id: payment_id

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

    //SEND RECEIPT
    $('#send_form').submit(function(e) {
      e.preventDefault()

      let payment_id = $('#send_id').val()

      $.ajax({
        url: 'payments/payment_send',
        type: 'POST',
        data: {
          payment_id: payment_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Send the Receipt');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);
          $('#send_modal').modal('hide');

        } else {
          alert()
          alert(res.res_message);
        }
      }).fail(function() {
        console.log("FAIL");
      })

    })



  })
</script>