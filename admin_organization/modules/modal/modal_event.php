<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '".$_SESSION['admin_org']['user_id']."' AND (status = '1' OR status = '4')";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_rso' required>";
$opt1 .= "<option value='' selected hidden>Select RSO</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt1 .= "</select>";
?>


<!-- ADD EVENT -->
<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_event">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Organization Name<span class="text-danger">*</span></label>
                        <?php echo $opt1; ?>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Event Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_event" required>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Expenses<span class="text-danger">*</span></label>
                        <input type="number" class="form-control validate" id="add_expenses" required>
                    </div><br>
                    <div class="md-form d-flex">
                    <label data-error="wrong" data-success="right">Date of Event<span class="text-danger">*</span></label>
                    <label data-error="wrong" data-success="right" style="margin-left:30%;">Up to<span class="text-danger">*</span></label>
                    </div>
                    <div class="md-form d-flex">
                        <input type="date" class="form-control validate" id="date_event" required>
                        <input type="date" class="form-control validate" id="up_to" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '".$_SESSION['admin_org']['user_id']."' AND (status = '1' OR status = '4')";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'edit_rso' required>";
$opt2 .= "<option value='' selected hidden>Select RSO</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt2 .= "</select>";
?>

<!-- EDIT EVENT -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update">
                <div class="modal-body">
                    <div class="md-form">
                    <input type="hidden" class="form-control validate" id="edit_event_id" required>
                        <label data-error="wrong" data-success="right">Organization Name<span class="text-danger">*</span></label>
                        <?php echo $opt2; ?>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Event Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_event" required>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Expenses<span class="text-danger">*</span></label>
                        <input type="number" class="form-control validate" id="edit_expenses" required>
                    </div><br>
                    <div class="md-form d-flex">
                    <label data-error="wrong" data-success="right">Date of Event<span class="text-danger">*</span></label>
                    <label data-error="wrong" data-success="right" style="margin-left:30%;">Up to<span class="text-danger">*</span></label>
                    </div>
                    <div class="md-form d-flex">
                        <input type="date" class="form-control validate" id="edit_date_event" required>
                        <input type="date" class="form-control validate" id="edit_up_to" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<!------------------------------------- Inacitve MEMBER -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Deactivate?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">
                    <span>are you sure do you want to deactivate?</span>
                    <input type="hidden" name="" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Deactivate</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!------------------------------------- Acitve MEMBER -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="delete_cmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Activate?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_cform">
                <div class="modal-body">
                    <span>are you sure do you want to activate?</span>
                    <input type="hidden" name="" id="delete_cid">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Activate</button>
                </div>
            </form>
        </div>

    </div>
</div>