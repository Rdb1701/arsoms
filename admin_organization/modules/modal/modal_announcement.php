<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '".$_SESSION['admin_org']['user_id']."' AND status = '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_rso' required>";
$opt1 .= "<option value='' selected hidden>Select RSO</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt1 .= "</select>";
?>

<!-- ADD ORGANIZATION -->
<div class="modal fade" tabindex="-1" role="dialog" id="add_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add Announcement Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_announcement">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Organization Name<span class="text-danger">*</span></label>
                        <?php echo $opt1; ?>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Post Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_title" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Announcement Description<span class="text-danger">*</span></label>
                       <textarea name="" id="add_announcement" class="tinymce form-control" cols="10" rows="7" required></textarea>
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

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '".$_SESSION['admin_org']['user_id']."' AND status = '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'edit_rso' required>";
$opt2 .= "<option value='' selected hidden>Select RSO</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
} 
$opt2 .= "</select>";
?>


<!-- ADD ORGANIZATION -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit Announcement Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update">
                <div class="modal-body">
                    <div class="md-form">
                        <input type="hidden" id = "ann_id">
                        <label data-error="wrong" data-success="right">Organization Name<span class="text-danger">*</span></label>
                        <?php echo $opt2; ?>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Post Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_title" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Announcement Description<span class="text-danger">*</span></label>
                       <textarea name="" id="edit_announcement" class="tinymce form-control" cols="10" rows="7" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<!------------------------------------- DELETE MEMBER -------------------------------------------------->
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
                    <span>are you sure do you want to delete post?</span>
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


<!------------------------------------- UPLOAD PHOTO-------------------------------------------------->
<div class="modal fade" id="upload_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="upload_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="announcement_id" id="announcement_id">
            <input type="file" name="file" id="file" accept="image/*" class="form-control"><br><br>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>

  </div>
</div>