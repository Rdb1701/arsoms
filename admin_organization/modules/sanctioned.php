<?php
include('../header.php');
?>

<div class="page-heading">
    <h3 class="">Sanctioned</h3>
</div>
<br>
<div>
    <button onclick="add_sanction()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-user-times"></i> Sanctioned a Student</button>

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
                            <th class="text-center">Sanction Fee</th>
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


<?php
include('modal/modal_sanction.php');
include('../footer.php');
?>


<script>
    function add_sanction() {
        $('#add_pmodal').modal({
            backdrop: 'static',
            keyboard: false
        })

        $('#add_pmodal').modal('show')

    }

    function send_receipt(payemnt_id) {
        $('#send_id').val(payemnt_id);
        $('#send_modal').modal('show');
    }

    function delete_payment(payment_id) {
        $('#delete_id').val(payment_id);
        $('#delete_modal').modal('show');
    }


    function change_event() {
        let event = $('#add_event_p').val();
        let table = "<label data-error='wrong' data-success='right'>Student Name<span class='text-danger'>*</span></label>";

        table += "<select class='form-control' name='type' id = 'add_student' required>" +
            "<option value='' selected hidden>Select Student</option>";

        $.ajax({
            url: 'sanction/sanction_change',
            type: 'POST',
            data: {
                event: event

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                $.each(res.users, function(key, value) {

                    table += "<option value=" + value.student_id + ">" + value.fname + " " + value.lname + "</option>";

                    $('#users_data').html(table)
                })


            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log('Fail!');
        });

    }

    $(document).ready(function() {

        var table = $('#myTable').DataTable({
            ajax: 'sanction/sanction_view', // API endpoint to fetch data
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
							</center><br>\
              <center>SANCTIONED STUDENTS</center><br>',
                    customize: function(win) {
                        $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

                    }
                }
            ]
        });


        //ADD Sanction
        $('#form_payment_p').on('submit', function(e) {
            e.preventDefault();

            let event = $('#add_event_p').val();
            let student_id = $('#add_student').val();
            let fee = $('#add_fee_p').val();
            let remarks = $('#add_remark').val();

            $.ajax({
                url: 'sanction/sanction_add',
                type: 'POST',
                data: {
                    remarks: remarks,
                    event: event,
                    fee: fee,
                    student_id: student_id,

                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('#s_fee').prop('disabled', true);
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
                    $('#add_pmodal').modal('hide');

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
                url: 'sanction/sanction_send',
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