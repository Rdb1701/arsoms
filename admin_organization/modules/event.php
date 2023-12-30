<?php
include('../header.php');
?>
<div class="page-heading">
    <h3 class="">Events / Activities</h3>
</div>
<br>
<div>

    <button onclick="add_event()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Events / Activities</button>
</div><br>
<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Event / Activities</th>
                            <th class="text-center">Organization</th>
                            <th class="text-center">Date of Event / Activities</th>
                            <th class="text-center">Event Expenses</th>
                            <th class="text-center">isActive</th>
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
include('modal/modal_event.php');
include('../footer.php');
?>

<script>
    //ADD EVENT
    function add_event() {
        $('#add_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#add_modal').modal('show')
    }

    //delete event
    function inactive_event(event_id) {
        $('#delete_id').val(event_id);
        $('#delete_modal').modal('show');
    }

    function active_event(event_id) {
        $('#delete_cid').val(event_id);
        $('#delete_cmodal').modal('show');
    }

    //EDIT EVENT
    function edit_event(event_id) {
        $.ajax({
            url: 'events/event_edit',
            type: 'POST',
            data: {
                event_id: event_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            $("#edit_event_id").val(res.event_id);
            $("#edit_rso").val(res.rso);
            $("#edit_event").val(res.event);
            $("#edit_date_event").val(res.date_event);
            $("#edit_up_to").val(res.up_to);
            $('#edit_expenses').val(res.expenses);
            $('#edit_modal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $('#edit_modal').modal('show');

        }).fail(function() {
            console.log("FAIL");
        })
    }

    $(document).ready(function() {

        var table = $('#myTable').DataTable({
            ajax: 'events/event_view', // API endpoint to fetch data
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
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: "csv",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: "excel",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm btn-success",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: "print",
                    className: "btn-sm btn-success",
                    title: '.',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    message: '<img src="../../assets/img/logo.png" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">REPUBLIC OF THE PHILIPPINES</h4>\
							<h6>AGUSAN DEL SUR STATE COLLEGE OF AGRICULTURE AND TECHNOLOGY</h6>\
							<h6>BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</h6>\
							</center><br>\
              <center>LIST OF ACTIVITIES</center>',
                    customize: function(win) {
                        $(win.document.body).find('table').append('<br<br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');

                    }
                }
            ]
        });

        //ADD EVENT
        $('#form_event').submit(function(e) {
            e.preventDefault();

            let rso        = $('#add_rso').val();
            let event      = $('#add_event').val();
            let date_event = $('#date_event').val();
            let expenses   = $('#add_expenses').val();
            let up_to      = $('#up_to').val();

            $.ajax({
                url: 'events/event_add',
                type: 'POST',
                data: {
                    rso       : rso,
                    event     : event,
                    date_event: date_event,
                    expenses  : expenses,
                    up_to     : up_to

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Added an Event');
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

        //UPDATE ORGANIZATION
        $('#form_update').submit(function(e) {
            e.preventDefault();

            let event_id    = $('#edit_event_id').val();
            let rso         = $('#edit_rso').val();
            let event       = $('#edit_event').val();
            let date_event  = $('#edit_date_event').val();
            let up_to       = $('#edit_up_to').val();
            let expenses    = $('#edit_expenses').val();

            $.ajax({
                url: 'events/event_update',
                type: 'POST',
                data: {
                    rso       : rso,
                    event     : event,
                    date_event: date_event,
                    up_to     : up_to,
                    event_id  : event_id,
                    expenses  : expenses

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Updated');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#edit_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })
        })


        //Inactive events
        $('#delete_form').submit(function(e) {
            e.preventDefault()

            let event_id = $('#delete_id').val()

            $.ajax({
                url: 'events/event_inactive',
                type: 'POST',
                data: {
                    event_id: event_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Deactivated');
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


        //Active events
        $('#delete_cform').submit(function(e) {
            e.preventDefault()

            let event_id = $('#delete_cid').val()

            $.ajax({
                url: 'events/event_active',
                type: 'POST',
                data: {
                    event_id: event_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Activated');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#delete_cmodal').modal('hide');

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