<?php 
include '../header.php';
include 'paids/unpaid_search_print.php';
?>

<div class="page-heading">
    <a href="paid"><i class="fa fa-arrow-left"></i> BACK</a>
</div><br>
<div class="">
    <h6 class="font-weight-bold">FILTER:</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center fw-bold bg-success text-white" style="width: 130px;">Event</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th id=""> <?php echo $event; ?></th>
            </tr>
            <tr>
                <th class="text-center fw-bold bg-success text-white">Date of Event</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th id=""><?php echo $date_of_event; ?></th>
            </tr>
            <tr>
                <th class="text-center fw-bold bg-success text-white">Obligation Fee</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th id="">P <?php echo number_format($fee); ?></th>
            </tr>
            
            <tr>
                <th class="text-center fw-bold bg-success text-white">Year Level</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th id=""><?php echo $year_level; ?></th>
            </tr>
            <tr>
                <th class="text-center fw-bold bg-success text-white">Due Date</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th id=""><?php echo $due_date; ?></th>
            </tr>
        </thead>
    </table>
</div>
<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-start">Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($payments) {
                            foreach ($payments as $pay) {
                        ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-start"><?php echo $pay['lname']; ?> <?php echo $pay['fname']; ?></td>
                                    <td class="text-center"></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td class="text-center text-danger" colspan="3">No Data Available</td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
include '../footer.php';
?>
<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            columns: [{
                    data: null,
                    "className": "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: [1],
                    "className": "text-center"
                },
                {
                    data: [2],
                    "className": "text-center"
                }
            ],
            dom: "Bfrtip",
            "ordering": false,
            lengthMenu: [
                [10, 25, 50, 100, 500, -1],
                [10, 25, 50, 100, 500, 'All']
            ],
            buttons: [{
                    extend: "pageLength",
                    className: "btn-sm btn-success"
                },
                {
                    extend: "copy",
                    className: "btn-sm btn-success",

                },
                {
                    extend: "csv",
                    className: "btn-sm btn-success",

                },
                {
                    extend: "excel",
                    className: "btn-sm btn-success",

                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm btn-success",

                },
                {
                    extend: "print",
                    className: "btn-sm btn-success",
                    title: '.',
                    message: function() {
                        var message = '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;">';
                        message += '<center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>';
                        message += '<h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>';
                        message += '<h6></h6></center><br>';
                        message += '<h6><center>UNPAID PAYMENTS</center><h6><br><br><br><br>';
                        message += '<span class="font-weight-bold">FILTER:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></span><br>';
                        message += '<span class="font-weight-bold">Organization:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="event_iddd"><?php echo $org_name ? $org_name : 'No Data Found'; ?></span><br>';
                        message += '<span class="font-weight-bold">Event:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="event_iddd"><?php echo $event ? $event : 'No Data Found'; ?></span><br>';
                        message += '<span class="font-weight-bold">Date of Event:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="date_event_iddd"><?php echo $date_of_event ? $date_of_event : 'No Data Found'; ?></span><br>';
                        message += '<span class="font-weight-bold">Year Level:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="year_level_iddd"><?php echo $year_level ? $year_level : 'No Data Found'; ?></span><br>';
                        message += '<span class="font-weight-bold">Payment:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="payment_iddd">₱ <?php echo $fee ? $fee : 'No Data Found'; ?></span><br>';
                        message += '<span class="font-weight-bold">Due Date:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="payment_idsdd">₱ <?php echo $due_date ? $due_date : 'No Data Found'; ?></span><br><br>';
                        return message;
                    },

                    customize: function(win) {
                        $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');
                    }
                }
            ],

        });

        // // Handle AJAX success
        // table.on('xhr', function(e, settings, json) {
        //     // Assuming the response JSON has keys 'event', 'date_of_event', 'year_level', and 'fee'
        //     $('#event_idd').html(json.event);
        //     $('#date_event_idd').html(json.date_of_event);
        //     $('#payment_idd').html('₱ ' + json.fee);
        //     $('#year_level_idd').html(json.year_level);

        //     $('#event_iddd').html(json.event);
        //     $('#date_event_iddd').html(json.date_of_event);
        //     $('#payment_iddd').html('₱ ' + json.fee);
        //     $('#year_level_iddd').html(json.year_level);



        // });
    });
</script>