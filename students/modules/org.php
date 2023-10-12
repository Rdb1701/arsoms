<?php
include('../header.php');
?>
<div class="page-heading">
    <h3 class="">Organization</h3>
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
                            <th class="text-center">Date Created</th>
                            <th class="text-center">Organization Details</th>
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
include('modal/modal_organization.php');
include('../footer.php');
?>

<script>
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
        }
   
    ]
});

     })
</script>