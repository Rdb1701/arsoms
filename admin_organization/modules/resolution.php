<?php include "../header.php"; 
      include "payments/resolution_view.php";
?>
<div class="page-heading">
    <a href="payment"><i class="fa fa-arrow-left"></i> BACK</a>
</div><br>

<button onclick="add_reso()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Resolution</button>
<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      
                        <tr>
                            <th class="text-center">File</th>
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                     
                    </thead>
                    <tbody>
                    <?php if($resolution) {
                                foreach($resolution as $reso){
                            ?>
                        <tr>
                          <td class="text-center"><a href="payments/uploads/<?php echo $reso['filename']; ?>"><?php echo $reso['filename']; ?></a></td>
                          <td class="text-center"><?php echo $reso['event_desc']; ?></td>
                          <td class="text-center"><button class="btn btn-danger" onclick="delete_reso(<?php echo $reso['resolution_id'] ?>)">Delete</button></td>
                        </tr>

                        <?php } }else{  ?>

                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "modal/modal_resolution.php"; ?>
<?php include "../footer.php"; ?>

<script>

function delete_reso(resolution_id) {
        if (confirm("Are you sure you want to remove Resolution?")) {
            $.ajax({
                url: 'payments/resolution_delete',
                type: 'POST',
                data: {
                    resolution_id: resolution_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Deleted');
                    location.reload();
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })
        }
    }


    function add_reso() {
        $('#add_modal').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#add_modal').modal('show');
    }

    $(document).ready(function() {

        $('#add_organization').on('change', function() {
            let organization_id = $("#add_organization option:selected").val();
            $.ajax({
                type: "POST",
                url: "payments/payment_change_org",
                dataType: 'html',
                data: {
                    organization_id: organization_id
                }
            }).done(function(data) {
                $('#add_event').html(data);
            });
        });


        $('#form_payment').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Add additional data if needed
            formData.append('additional_data', 'value');

            // Send AJAX request
            $.ajax({
                url: 'payments/add_resolution', // PHP script to handle the data insertion
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });

    })
</script>