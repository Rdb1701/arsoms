<?php
$sql = "SELECT * FROM tbl_organization
WHERE user_id = '" . $_SESSION['admin_org']['user_id'] . "'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' id = 'add_organization' name='add_organization' required>";
$opt1 .= "<option value='' selected hidden>Select Organization</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt1 .= "</select>";
?>

<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add Resolution</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_payment">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Organization<span class="text-danger">*</span></label>
                        <?php echo $opt1; ?>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Event<span class="text-danger">*</span></label>
                        <select class="form-control" id="add_event" required name="add_event">
                            <option value='' selected hidden>Select Event</option>
                        </select>
                    </div><br>  
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">File<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="add_file" id="add_file">
                    </div><br>       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="p_fee">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
