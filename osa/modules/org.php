<?php
include("../header.php");
?>
<div class="page-heading">
    <h3 class="">Student Organizations</h3>
</div>
<br>
<div>

</div><br>
<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Organization Name</th>
                            <th class="text-center">Organization Details</th>
                            <th class="text-center">Documents</th>
                            <th class="text-center">Date Submitted</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!------------------------- CONTENT TABLE------------------------------>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include("modal/modal_organization.php");
include("../footer.php");
?>

<script>
    //EMPTY DOCUMENT
    function refresh() {
        location.reload();
    }

    function delete_org(organization_id) {
        $('#delete_id').val(organization_id);
        $('#delete_modal').modal('show');
    }
    //ACCEPT ORGANIZATIOn
    function accept_organization(organization_id, email) {
        $('#accept_id').val(organization_id);
        $('#accept_email').val(email)
        $('#accept_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#accept_modal').modal('show')
    }

    //REJECT ORGANIZATION
    function reject_organization(organization_id, email) {
        $('#reject_id').val(organization_id);
        $('#reject_email').val(email)
        $('#reject_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#reject_modal').modal('show')
    }
    //DELETE ORGANIZATION
    function delete_org(organization_id, delete_email) {
        $('#delete_id').val(organization_id);
        $('#delete_email').val(delete_email);
        $('#delete_modal').modal('show');
    }

    //FILE DOCUMENTS
    function file_documents(organization_id, intent, request, form, cbl, list_activities, roster) {

        //INTENT LETTER
        let intent_letter = document.getElementById("intent");
        let documentUrl = "../../admin_organization/modules/organization/uploads/" + intent;
        if (intent == "") {
            intent_letter.setAttribute("data-toggle", "modal");
            intent_letter.setAttribute("data-target", "#alert_modal");
        } else {
            intent_letter.setAttribute("href", documentUrl);
        }

        //REQUEST LETTER
        let request_letter = document.getElementById("request");
        let documentUrl2 = "../../admin_organization/modules/organization/uploads/" + request;
        if (request == "") {
            request_letter.setAttribute("data-toggle", "modal");
            request_letter.setAttribute("data-target", "#alert_modal");
        } else {
            request_letter.setAttribute("href", documentUrl2);
        }

        //MEMBERSHIP FORM
        let form_membership = document.getElementById("form");
        let documentUrl3 = "../../admin_organization/modules/organization/uploads/" + form;
        if (form == "") {
            form_membership.setAttribute("data-toggle", "modal");
            form_membership.setAttribute("data-target", "#alert_modal");
        } else {
            form_membership.setAttribute("href", documentUrl3);
        }

        //CBL
        let cbl_1 = document.getElementById("cbl");
        let documentUrl4 = "../../admin_organization/modules/organization/uploads/" + cbl;
        if (cbl == "") {
            cbl_1.setAttribute("data-toggle", "modal");
            cbl_1.setAttribute("data-target", "#alert_modal");
        } else {
            cbl_1.setAttribute("href", documentUrl4);
        }

        //List of Activities
        let list_1 = document.getElementById("list");
        let documentUrl5 = "../../admin_organization/modules/organization/uploads/" + list_activities;

        if (list_activities == "") {
            list_1.setAttribute("data-toggle", "modal");
            list_1.setAttribute("data-target", "#alert_modal");
        } else {
            list_1.setAttribute("href", documentUrl5);
        }

        //Roster
        let roster_1 = document.getElementById("roster");
        let documentUrl6 = "../../admin_organization/modules/organization/uploads/" + roster;

        if (roster == "") {
            roster_1.setAttribute("data-toggle", "modal");
            roster_1.setAttribute("data-target", "#alert_modal");
        } else {
            roster_1.setAttribute("href", documentUrl6);
        }

        $('#document_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#document_modal').modal('show')

    }

    //VIEW DETAILS
    function view_details(organization_id) {
        $.ajax({
            url: 'organization/view_details',
            type: 'POST',
            data: {
                organization_id: organization_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            let table = "<thead>";
            table += "<tr>" +
                '<th class=\"text-left font-weight-bold\">ORGANIZATION NAME</th>' +
                '<th class=\"text-left font-weight-bold\">' + res.org_name + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">ADMIN</th>' +
                '<th class=\"text-left\">' + res.fname + ' ' + res.lname + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">ADDRESS</th>' +
                '<th class=\"text-left\">' + res.address + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">CONTACT NUMBER</th>' +
                '<th class=\"text-left\">' + res.number + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">EMAIL</th>' +
                '<th class=\"text-left\">' + res.email + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">ORGANIZATION TYPE</th>' +
                '<th class=\"text-left\">' + res.type + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">ACTIVE</th>' +
                '<th class=\"text-left\">' + res.active + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left\">DATE CREATED</th>' +
                '<th class=\"text-left\">' + res.date_inserted + '</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            $('#my_table').html(table)
            $('#show_modal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $('#show_modal').modal('show');

        }).fail(function() {
            console.log("FAIL");
        })
    }


    $(document).ready(function() {

        var table = $('#myTable').DataTable({
            ajax: 'organization/organization_view', // API endpoint to fetch data
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

            ]
        });

        //DELETING INFORMATION
        $('#delete_form').submit(function(e) {
            e.preventDefault()

            let organization_id = $('#delete_id').val()
            let delete_email = $('#delete_email').val()

            $.ajax({
                url: 'organization/organization_delete',
                type: 'POST',
                data: {
                    organization_id: organization_id,
                    email: delete_email

                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btn_delete').prop('disabled', true)
                    $("#loader4").show();
                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Deleted');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#delete_modal').modal('hide');

                } else {

                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })

        })


        //ACCEPTING ORGANIZATION
        $('#accept_form').submit(function(e) {
            e.preventDefault()

            let organization_id = $('#accept_id').val()
            let email = $('#accept_email').val()

            $.ajax({
                url: 'organization/organization_accept',
                type: 'POST',
                data: {
                    organization_id: organization_id,
                    email: email

                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btn_approve').prop('disabled', true)
                    // Show image container
                    $("#loader").show();
                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    $("#loader").hide();
                    alert('Successfully Accepted');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#accept_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })

        })


        //REJECTIING ORGANIZATION
        $('#reject_form').submit(function(e) {
            e.preventDefault()

            let organization_id = $('#reject_id').val()
            let email = $('#reject_email').val()
            let remarks = $('#remarks').val()

            $.ajax({
                url: 'organization/organization_reject',
                type: 'POST',
                data: {
                    organization_id: organization_id,
                    email: email,
                    remarks: remarks
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btn_reject').prop('disabled', true)
                    // Show image container
                    $("#loader1").show();
                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    $("#loader1").hide();
                    alert('Successfully Accepted');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#reject_modal').modal('hide');

                } else {
                    alert(res.res_message)
                }
            }).fail(function() {
                console.log("FAIL");
            })

        })


    })
</script>