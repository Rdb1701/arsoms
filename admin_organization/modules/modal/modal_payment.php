<?php
$sql = "SELECT ev.event_id, ev.event_desc, org.org_name FROM tbl_events as ev
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."' AND ev.isActive = '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_event' required>";
$opt1 .= "<option value='' selected hidden>Select Event</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['event_id'] . "'>" . $row['event_desc'] . " - " . $row['org_name'] . "</option>";
}
$opt1 .= "</select>";
?>

<!--------------------------- Populate Fee -------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Populate Obligation Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_payment">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Event<span class="text-danger">*</span></label>
                        <?php echo $opt1; ?>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Obligation Fee<span class="text-danger">*</span></label>
                        <input type="number" class="form-control validate" id="add_fee" required>
                    </div><br>
                </div>
                <div class="modal-footer">
                    <!-- Image loader -->
                    <div id='loader' style='display: none;'>
                        <img src='../../assets/img/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response'></div>
                    <button type="submit" class="btn btn-primary" id ="p_fee">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<?php
$sql = "SELECT student_id, fname, lname FROM tbl_students WHERE isActive = '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_student' required>";
$opt1 .= "<option value='' selected hidden>Select Student</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['student_id'] . "'>" . $row['fname'] . ' ' . $row['lname'] . "</option>";
}
$opt1 .= "</select>";


$sql = "SELECT event_id, event_desc FROM tbl_events WHERE isActive = '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'add_event_p' required>";
$opt2 .= "<option value='' selected hidden>Select Event</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['event_id'] . "'>" . $row['event_desc'] . "</option>";
}
$opt2 .= "</select>";
?>


<!--------------------------- Per Student Fee -------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="add_pmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add Obligation Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_payment_p">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Event<span class="text-danger">*</span></label>
                        <?php echo $opt2; ?>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Student<span class="text-danger">*</span></label>
                        <?php echo $opt1; ?>
                    </div><br>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Obligation Fee<span class="text-danger">*</span></label>
                        <input type="number" class="form-control validate" id="add_fee_p" required>
                    </div><br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<!------------------------------------- DELETE Payment-------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">
                    <span>are you sure do you want to delete?</span>
                    <input type="hidden" name="" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-------------------------------------Send Receiot------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="send_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Send?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="send_form">
                <div class="modal-body">
                    <span>are you sure do you want to Send Receipt?</span>
                    <input type="hidden" name="" id="send_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>

    </div>
</div>