<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '" . $_SESSION['admin_org']['user_id'] . "' AND (status = '1' OR status = '4')";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='edit_rso' id = 'edit_rso' required>";
$opt2 .= "<option value='' selected hidden>Select Organization</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt2 .= "</select>";
?>

<div class="modal fade" tabindex="-1" role="dialog" id="list_edit_modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit Organization Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12 col-md-4">
                            <input type="hidden" id="edit_profile_id">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <?php echo $opt2; ?>
                        </div>
                        <div class="form-group col-12 col-md-8">
                            <label for="edit_description">Description</label>
                            <input type="text" id="edit_description" class="form-control" name="description" placeholder="Description">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-md-4">
                            <label for="edit_mission">Mission <span class="text-danger">*</span></label>
                            <textarea name="edit_mission" id="edit_mission" cols="30" rows="5" class="tinymce form-control"></textarea>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="vision">Vision <span class="text-danger">*</span></label>
                            <textarea name="edit_vision" id="edit_vision" cols="30" rows="5" class="tinymce form-control"></textarea>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="edit_goals">Goals<span class="text-danger">*</span></label>
                            <textarea name="edit_goals" id="edit_goals" cols="30" rows="5" class="tinymce form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="list_file_modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Accomplishment File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="my_table">

                    <!-- CONTENT -->
                </table>
                <!-- Accomplishments -->
                <form id="file_update">
                    <div class="row">
                        <div class="form-group col-12 col-md-12 mb-0">
                            <label class="d-flex">
                                Accpmplishments
                                <button type="button" id="btnAccomplishment1" class="btn btn-primary btn-raised btn-sm ml-auto">
                                    <i class="nav-icon fas fa-plus"></i>
                                </button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <input type="hidden" id="edit_accomplishment_id" name="edit_accomplishment_id">
                                    <thead>
                                        <tr>
                                            <th class="text-left">File</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="newAccomplishment1">
                                        <tr>
                                            <td class="text-left">
                                                <input type="file" name="accomplishment_file[]" id="" class="form-control" required>
                                            </td>
                                            <td class="text-center">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Report -->
<div class="modal fade" tabindex="-1" role="dialog" id="report_file_modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Reports File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="my_table_report">

                    <!-- CONTENT -->
                </table>
                <form id="report_update">
                    <div class="row">
                        <div class="form-group col-12 col-md-12 mb-0">
                            <label class="d-flex">
                                Reports
                                <button type="button" id="btnReport1" class="btn btn-primary btn-raised btn-sm ml-auto">
                                    <i class="nav-icon fas fa-plus"></i>
                                </button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <input type="hidden" id="edit_report_id" name="edit_report_id">
                                    <thead>
                                        <tr>
                                            <th class="text-left">File</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="newReport1">
                                        <tr>
                                            <td class="text-left">
                                                <input type="file" name="report_file[]" id="" class="form-control" required>
                                            </td>
                                            <td class="text-center">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Officers -->
<div class="modal fade" tabindex="-1" role="dialog" id="officer_file_modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Officers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="my_table_officer">

                    <!-- CONTENT -->
                </table>
                <form id="officer_update">
                    <!-- OFFICERS -->
                    <div class="row">
                        <div class="form-group col-12 col-md-12 mb-0">
                            <label class="d-flex">
                                List of Officers
                                <button type="button" id="btnNew1" class="btn btn-primary btn-raised btn-sm ml-auto">
                                    <i class="nav-icon fas fa-plus"></i>
                                </button>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <input type="hidden" id="edit_officer_id" name="edit_officer_id">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Name</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="newReq1">
                                        <tr>
                                            <td class="text-left">
                                                <input type="text" class="form-control" name="newReq_file[]" placeholder="Name" required>
                                            </td>
                                            <td class="text-left">
                                                <input type="text" class="form-control" name="newReq1_file[]" placeholder="Officer Role" required>
                                            </td>
                                            <td class="text-center">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                    <input type="hidden" name="" id="delete_organization_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </div>
            </form>
        </div>

    </div>
</div>


<script>
    let countReport1 = 1;
    let countAccomplishment1 = 1;
    let countNew1 = 1;

    function refresh() {
        location.reload();
    }


    $(document).on('click', '#btnAccomplishment1', function() {
        countAccomplishment1++
        html = ''
        html += '<tr id="rowAccomplish1' + countAccomplishment1 + '">'
        html += '<td class="text-left"><input type="file" name="accomplishment_edit[]" id="" class="form-control" required></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countAccomplishment1 + ', \'rowAccomplish1\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon fas fa-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newAccomplishment1').append(html)
    })



    $(document).on('click', '#btnReport1', function() {
        countReport1++
        html = ''
        html += '<tr id="rowReport1' + countReport1 + '">'
        html += '<td class="text-left"><input type="file" name="report_file[]" id="" class="form-control" required></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countReport1 + ', \'rowReport1\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon fas fa-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newReport1').append(html)
    })


    $(document).on('click', '#btnNew1', function() {
        countNew1++
        html = ''
        html += '<tr id="rowNew1' + countNew1 + '">'
        html += '<td class="text-left"><input type="text" class="form-control" name="newReq_file[]" placeholder="Name"></td>'
        html += '<td class="text-left"><input type="text" class="form-control" name="newReq1_file[]" placeholder="Officer Role"></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countNew1 + ', \'rowNew1\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon fas fa-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newReq1').append(html)
    })
</script>