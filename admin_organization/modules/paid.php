<?php
include('../header.php');
?>

<div class="page-heading">
  <h3 class="">Paid Payments</h3>
</div>
<br>
<button onclick="collections()" data-toggle="modal" class="btn btn-warning" type="button"><i class="fa fa-print"></i> Paid Collections</button>
<button onclick="sanction_collections()" data-toggle="modal" class="btn btn-warning" type="button"><i class="fa fa-print"></i> Sanction Collections</button>
<div>
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
              <th class="text-center">Receipt No.</th>
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
include('../footer.php');
?>

<script>
  function collections() {

    popupCenter({
      url: 'collections/download',
      title: 'Print Collections',
      w: 900,
      h: 500
    });

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
							</center><br>\
              <center>PAID PAYMENTS</center>',
          customize: function(win) {
            $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

          }
        }
      ]
    });


  })
</script>