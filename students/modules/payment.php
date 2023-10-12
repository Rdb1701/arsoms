<?php
include('../header.php');
?>
<div class="page-heading">
    <h3 class="">Obligation Fee</h3>
</div><br>

<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Organization Name</th>
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Date of Event</th>
                            <th class="text-center">Obligation Fees</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Remarks</th>
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


<!---------------------------- Download MODAL --------------------------------->
<div class="modal fade" id="download_clearance">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Download Receipt</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="approved/downloadpdf.php" method="get">
                    <span class="fw-bold">Ready to Download?</span>
                    <input type="hidden" id="stud_id" name="stud_id">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="sumbit" class="btn btn-primary" id="download_c" onclick="download_cc()"><i class="fa-fa-download"></i>Download</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include('../footer.php');
?>

<script>
    function send_receipt(payment_id) {
        let stud_id = $('#stud_id').val(payment_id);
        $('#download_clearance').modal('show');

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

            ]
        });


        $(document).ready(function() {

            $('#download_c').click(function(e) {
                e.preventDefault();

                let stud_id = $('#stud_id').val();
                let data = '';

                console.log(stud_id);

                data = 'receipt_number=' + stud_id;
                // data += 'sms_id=' + smsss_id;

                popupCenter({
                    url: 'receipt/download?' + data,
                    title: 'Print Receipt',
                    w: 900,
                    h: 500
                });
                $('#download_clearance').modal('hide');

            })

        })


        //DOCUMENT READY
    })
</script>