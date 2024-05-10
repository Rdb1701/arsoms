<?php include '../header.php'; ?>
<?php include 'paids/collection_view.php'; ?>

<div class="page-heading">
    <a href="paid"><i class="fa fa-arrow-left"></i> BACK</a>
</div><br>
<div class="page-heading">
    <h3 class="">Payment Collections</h3>
</div>
<br>
<div>
    <div class="page-content ttable">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th ></th>
                                <th></th>
                            </tr>
                           
                        </thead>
                        <tbody>
                        <tr class="text-left">
                                <td class="text-left font-weight-bold">Organization</td>
                                <td class="text-left"><?php echo $org_description; ?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="text-left font-weight-bold">Event</td>
                                <td class="text-left"><?php echo $event_name; ?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="text-left font-weight-bold">Total Paid Payments</td>
                                <td class="text-left">₱ <?php echo number_format($total_paid_payments); ?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="text-left font-weight-bold">No. of Paid Students</td>
                                <td class="text-left"><?php echo $num_students_paid; ?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="text-left font-weight-bold">Unpaid Amount</td>
                                <td class="text-left">₱ <?php echo number_format($unpaid_amount); ?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="text-left font-weight-bold">No. of Unpaid Students</td>
                                <td class="text-left"><?php echo $num_students_unpaid; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include '../footer.php'; ?>

    <script type="text/javascript">
   $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            "ordering": false,
            buttons: [{
                    extend: "pageLength",
                    className: "btn-sm btn-success",
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn btn-success',
                },
                {
                    extend: "print",
                    className: "btn-sm btn-success",
                    title: '.',
                    message: '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>\
            <h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>\
            <h6></h6>\
            </center><br>\
            <center>PAYMENT COLLECTIONS</center><br>\
            ',
                    customize: function(win) {
                        $(win.document.body).find('table').append('<br><br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');
                    }
                }
            ],
        });
    });
    </script>
</div>
