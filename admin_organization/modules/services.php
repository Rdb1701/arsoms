<?php
include('../header.php');
?>

<div class="page-heading">
    <h3 class="">Services Sanctioned</h3>
</div>
<br>
<div>
    <button onclick="add_sanction()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-user-times"></i> Sanctioned a Student</button>
    <a href="sanctioned" class="btn" style="float: right; border: 1px solid gray;">Monetary</a>
</div><br>

<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th class="text-center">No.</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Year Level</th>
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Service</th>
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


<?php
include('modal/modal_services.php');
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

    function send_receipt(service_id) {
        $('#send_id').val(service_id);
        $('#send_modal').modal('show');
    }

    function delete_payment(service_id) {
        $('#delete_id').val(service_id);
        $('#delete_modal').modal('show');
    }

    function clickMe() {

        $('.checkItem').prop("checked", true)
    }

    function notclickMe() {
        $('.checkItem').prop("checked", false)
    }


    function change_event() {
        let event = $('#add_event_p').val();
        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\"><button type='button' class ='btn btn-primary' onclick = 'clickMe()'>Select All</button> <button type='button' class ='btn btn-primary' onclick = 'notclickMe()'>Deselect</button></th>" +
            "<th class=\"text-center\">Student Name</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

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

                    table += '<tr>' +
                        '<td class="text-center"><input type="checkbox" class= "checkItem" value = "' + value.student_id + '" name="s_id[]"</td>' +
                        '<td class="text-center">' + value.fname + ' ' + value.lname + '</td>' +


                        '<tr>'


                    $('#sanction_table').html(table)
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
            ajax: 'sanction_service/sanction_service_view', // API endpoint to fetch data
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
        // $('#form_payment_p').on('submit', function(e) {
        //     e.preventDefault();

        //     let event = $('#add_event_p').val();
        //     let student_id = $('#add_student').val();
        //     let fee = $('#add_fee_p').val();
        //     let remarks = $('#add_remark').val();

        //     $.ajax({
        //         url: 'sanction/sanction_add',
        //         type: 'POST',
        //         data: {
        //             remarks: remarks,
        //             event: event,
        //             fee: fee,
        //             student_id: student_id,

        //         },
        //         dataType: 'JSON',
        //         beforeSend: function() {
        //             $('#s_fee').prop('disabled', true);
        //             // Show image container
        //             $("#loader").show();
        //         }
        //     }).done(function(res) {
        //         if (res.res_success == 1) {
        //             $("#loader").hide();
        //             alert('Successfully Added!');
        //             var currentPageIndex = table.page.info().page;
        //             table.ajax.reload(function() {
        //                 table.page(currentPageIndex).draw(false);
        //             }, false);
        //             $('#add_pmodal').modal('hide');

        //         } else {
        //             alert(res.res_message);
        //         }

        //     }).fail(function() {
        //         console.log('fail')
        //     })

        // })


        //DELETING Payment
        $('#delete_form').submit(function(e) {
            e.preventDefault()

            let payment_id = $('#delete_id').val()

            $.ajax({
                url: 'sanction_service/sanction_delete',
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
                url: 'sanction_service/sanction_approve',
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



        //ADD Payment
        $('#form_payment_pr').on('submit', function(e) {
            e.preventDefault();

            if ($('.checkItem:checked').length > 0) {

                $.ajax({
                    url: 'sanction_service/sanction_add_service',
                    type: 'POST',
                    data: $(this).serialize(),
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
                        $('#add_pmodal').modal('hide');

                    } else {
                        alert(res.res_message);
                    }

                }).fail(function() {
                    console.log('fail')
                })

            }

        })

    })
</script>