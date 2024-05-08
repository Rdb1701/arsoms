<!-------------------------------------------- Change Password modal ------------------------------------------------->
<div class="modal fade" id="changepassword_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_cp">
        <div class="modal-body mx-4">

          <input type="hidden" id="cp_id" value="">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>

            <input type="text" class="form-control validate" id="cp_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_new_password" required>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_re_new_password" required>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" name="signupbtn">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>




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

<!---------------------------- ADD MEMBER ----------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="list_add_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Add New Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_add">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">ID Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_username" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_fname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_lname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="add_gender" required>
                            <option value="" selected hidden>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
                        <select class='form-control' id="add_year" required>
                            <option value="" selected hidden>Select year</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email</label>
                        <input type="email" class="form-control validate" id="add_email" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">RSO <span class="text-danger">*</span></label>
                        <?php echo $opt1;  ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<!-- EDIT MEMBER -->
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

<!---------------------------- EDIT MEMBER ----------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="list_edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update">
                <div class="modal-body">
                    <div class="md-form">
                    <input type="hidden" class="form-control validate" id="edit_student_id" disabled>
                        <label data-error="wrong" data-success="right">ID Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_username" disabled>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_fname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_lname" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="edit_gender" required>
                            <option value="" selected hidden>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
                        <select class='form-control' id="edit_year" required>
                            <option value="" selected hidden>Select year</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email</label>
                        <input type="email" class="form-control validate" id="edit_email" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">RSO <span class="text-danger">*</span></label>
                        <?php echo $opt2;  ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Ready to Remove?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">
                    <span>are you sure do you want to remove member?</span>
                    <input type="hidden" name="" id="delete_id">
                    <input type="hidden" name="" id="usern">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </div>
            </form>
        </div>

    </div>
</div>



<!-- FILE UPLOAD -->
<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '".$_SESSION['admin_org']['user_id']."' AND (status = '1' OR status = '4')";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt3 = "<select class='form-control' name='organization_id' id = 'organization_id' required>";
$opt3 .= "<option value='' selected hidden>Select RSO</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt3 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt3 .= "</select>";
?>

  <!------------------------------------- UPLOAD FILE-------------------------------------------------->
  <div class="modal fade" id="upload_excel_modal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h5 class="modal-title" id="exampleModalLabel">Upload Excel File</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form id="upload_excel" enctype="multipart/form-data">
                 <div class="modal-body">
                 <div class="form-group">
                    <?php
                    echo $opt3;
                    ?>
                    <br>
                    <input type="file" name="excel_1" id="excel_1" class="form-control"><br><br>
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Upload</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 