<?php include "../header.php";
include "members/member_search_view.php";
?>

<div class="page-heading">
    <a href="member"><i class="fa fa-arrow-left"></i> BACK</a>
</div><br>

<div class="">
<h6 class="font-weight-bold">FILTER:</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center fw-bold bg-success text-white" style="width: 130px;">Organization</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th><?php echo $org_name;  ?></th>
            </tr>
            <tr>
                <th class="text-center fw-bold bg-success text-white">Year Level</th>
                <th class="text-center fw-bold bg-success text-white" style="width: 2px;">:</th>
                <th><?php echo $year;  ?></th>
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
                            <th class="text-center">ID Number</th>
                            <th class="text-center">Member Name</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Email</th>
                            <!-- <th class="text-center">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($students) {
                            foreach ($students as $stud) {
                        ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"><?php echo $stud['username']; ?></td>
                                    <td class="text-center"><?php echo $stud['lname']; ?> <?php echo $stud['fname']; ?></td>
                                    <td class="text-center"><?php echo $stud['gender']; ?></td>
                                    <td class="text-center"><?php echo $stud['email']; ?></td>
                                    <!-- <td class="text-center"></td> -->

                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td class="text-center text-danger" colspan="7">No Data Found</td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../footer.php"; ?>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            "ordering": false,
            lengthMenu: [
                [10, 25, 50, 100, 500, -1],
                [10, 25, 50, 100, 500, 'All']
            ],
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
            <center>ORGANIZATION MEMBERS</center><br>\
            <span class= "font-weight-bold">FILTER:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></span><br>\
            <span class= "font-weight-bold">Organization:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $org_name ? $org_name : 'No Data Found'; ?></span><br>\
            <span class= "font-weight-bold">Section:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $year ? $year : 'No Data Found'; ?></span><br><br>\
                           ',
                    customize: function(win) {
                        $(win.document.body).find('table').append('<br><br/><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');
                    }
                }
            ],
            columnDefs: [{
                targets: 0, // First column
                render: function(data, type, row, meta) {
                    return meta.row + 1; // Add 1 to row index for numbering
                }
            }]
        });
    });
</script>