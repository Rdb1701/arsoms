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
    <h3 class="">Monetary Sanctioned</h3>
</div>
<br>
<div>
    <button onclick="add_sanction()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-user-times"></i> Sanctioned a Student</button>
    <a href="services" class="btn" style="float: right; border: 1px solid gray;">Services</a>
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
    function paid_search() {
        let event = $('#add_eventt').val()
        let rso = $('#add_organizationn').val();
        let year_level = $('#year_leveel').val();

        let data = '';
        data += 'year_level=' + year_level + '&';
        data += 'rso=' + rso + '&';
        data += 'event=' + event;

        if (year_level != '' && rso != '' && event != '') {
            window.location.href = "sanction_search?" + data;
        } else {
            alert("Please Input Filter")
        }
    }

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
            ajax: 'sanction/sanction_view', // API endpoint to fetch data
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
            buttons: [

                {
                    extend: "pageLength",
                    className: "btn-sm btn-success"
                },
                {
                    extend: "copy",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: "csv",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: "excel",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: "print",
                    className: "btn-sm btn-success",
                    title: '.',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    message: '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>\
							<h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>\
							</center><br>\
              <center>SANCTIONED STUDENTS</center><br>',
                    customize: function(win) {
                        $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

                    }
                }
            ]
        });
        // $('#add_organizationn').on('change', function() {
        //     let organization_id = $("#add_organizationn option:selected").val();
        //     $.ajax({
        //       type: "POST",
        //       url: "payments/payment_change_org",
        //       dataType: 'html',
        //       data: {
        //         organization_id: organization_id
        //       }
        //     }).done(function(data) {
        //       $('#add_eventt').html(data);
        //     });
        //   });

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



        //ADD Payment
        $('#form_payment_pr').on('submit', function(e) {
            e.preventDefault();

            if ($('.checkItem:checked').length > 0) {

                $.ajax({
                    url: 'sanction/sanction_add_fee',
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