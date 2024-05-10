<?php
include('../header.php');
?>

<?php
$sql = "SELECT * FROM tbl_organization
WHERE user_id = '" . $_SESSION['admin_org']['user_id'] . "'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt_1 = "<select class='btn btn-outline-success' id = 'add_organizationn' name='add_organizationn' required>";
$opt_1 .= "<option value='' selected hidden>Select Organization</option>";
while ($row = mysqli_fetch_assoc($result)) {
  $opt_1 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt_1 .= "</select>";
?>

<div class="page-heading">
  <h3 class="">Paid Payments</h3>
</div>
<br>
<button onclick="collections()" data-toggle="modal" class="btn btn-warning" type="button"><i class="fa fa-print"></i> Payment Collections</button>
<!-- <button onclick="sanction_collections()" data-toggle="modal" class="btn btn-warning" type="button"><i class="fa fa-print"></i> Sanction Collections</button> -->
<div><br>
  <span>FILTER:</span>
  <div class="d-flex">
    <form id="form_select">
      <?php echo $opt_1; ?>

      <select class="btn btn-outline-success" id="add_eventt" required name="add_event">
        <option value='' selected hidden>Select Event</option>
      </select>
      <select class='btn btn-outline-success' id="year_leveel" required>
        <option value="" selected hidden>Select year</option>
        <option value="1">1st Year</option>
        <option value="2">2nd Year</option>
        <option value="3">3rd Year</option>
        <option value="4">4th Year</option>
      </select>
      <button type="button" class="btn btn-primary" onclick="paid_search()"><i class="fa fa-magnifying-glass"></i> Search</button>
    </form>

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
                <th class="text-center">Payment</th>
                <th class="text-center">Date of Event</th>
                <!-- <th class="text-center">Obligation Fees</th> -->
                <th class="text-center"> Invoice No.</th>
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

  $sql = "SELECT ev.event_id, ev.organization_id, ev.event_desc, org.org_name FROM tbl_events as ev
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '" . $_SESSION['admin_org']['user_id'] . "' AND ev.isActive = '1'";
  $result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

  $opt2 = "<select class='form-control' name='add_event_pp' id = 'add_event_pp' required>";
  $opt2 .= "<option value='' selected hidden>Select Event</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['event_id'] . "'>" . $row['event_desc'] . " - " . $row['org_name'] . "</option>";
  }
  $opt2 .= "</select>";


  ?>



  <!--------------------------- Per Sanction -------------------------->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal_collection">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">Paid Collections</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form_payment_pr">
          <div class="modal-body">
            <div class="md-form">
              <label data-error="wrong" data-success="right">Event<span class="text-danger">*</span></label>
              <?php echo $opt2; ?>
            </div>
          </div>
          <div class="modal-footer">
            <!-- Image loader -->
            <div id='loader' style='display: none;'>
              <img src='../../assets/img/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
            </div>
            <div class='response'></div>
            <button type="submit" class="btn btn-primary" id="s_feee">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include('../footer.php');
?>

<script>
  function paid_search() {
    let event = $('#add_eventt').val()
    let rso = $('#add_organizationn').val();
    let year_level = $('#year_leveel').val();

    let data = '';
    data += 'year_level=' + year_level + '&';
    data += 'rso=' + rso + '&';
    data += 'event=' + event;

    if (year_level != '' && rso != '' && event != '') {
      window.location.href = "paid_search?" + data;
    } else {
      alert("Please Input Filter")
    }
  }

  function collections() {


    $('#modal_collection').modal('show')

  }

  function sanction_collections() {

    popupCenter({
      url: 'collections/download_sanction',
      title: 'Print Collections',
      w: 900,
      h: 500
    });

  }



  $(document).ready(function() {
        var table = $('#myTable').DataTable({
          ajax: 'paids/paid_view', // API endpoint to fetch data
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
            }


          ],
          // dom: "Bfrtip",
          // buttons: [{
          //     extend: "pageLength",
          //     className: "btn-sm btn-success"
          //   },
          //   {
          //     extend: "copy",
          //     className: "btn-sm btn-success",
          //     exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5]
          //     }
          //   },
          //   {
          //     extend: "csv",
          //     className: "btn-sm btn-success",
          //     exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5]
          //     }
          //   },
          //   {
          //     extend: "excel",
          //     className: "btn-sm btn-success",
          //     exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5]
          //     }
          //   },
          //   {
          //     extend: "pdfHtml5",
          //     className: "btn-sm btn-success",
          //     exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5]
          //     }
          //   },
          //   {
          //     extend: "print",
          //     className: "btn-sm btn-success",
          //     title: '.',
          //     exportOptions: {
          //       columns: [0, 1, 2, 3, 4, 5]
          //     },
          //     message: '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>\
          // 			<h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>\
          // 			<h6>BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</h6>\
          // 			</center><br>\
          //       <center>PAID PAYMENTS</center>',
          //     customize: function(win) {
          //       $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

          //     }
          //   }
          // ]
        });

        $('#s_feee').click(function(e) {
            e.preventDefault();
            let event_id = $('#add_event_pp').val();

            let data = '';
            data += 'event_id=' + event_id;

              window.location.href = "collection?" + data;


            })

          $('#add_organizationn').on('change', function() {
            let organization_id = $("#add_organizationn option:selected").val();
            $.ajax({
              type: "POST",
              url: "payments/payment_change_org",
              dataType: 'html',
              data: {
                organization_id: organization_id
              }
            }).done(function(data) {
              $('#add_eventt').html(data);
            });
          });


        })
</script>