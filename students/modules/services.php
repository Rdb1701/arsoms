<?php
include('../header.php');
?>

<div class="page-heading">
    <h3 class="">Services Sanctioned</h3>
</div>
<br>

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
                            <th class="text-center">Service</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Remarks</th>
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


    $(document).ready(function() {

        var table = $('#myTable').DataTable({
            ajax: 'sanction_services/sanction_service_view', // API endpoint to fetch data
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
    
        });


    })
</script>