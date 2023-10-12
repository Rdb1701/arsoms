<!------------------------------------- DELETE ORGANZIATION -------------------------------------------------->
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

<!-- ADD ORGANIZATION -->
<div class="modal fade" tabindex="-1" role="dialog" id="organization_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Create RSO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_org">
                <div class="modal-body">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Organization Name<span class="text-danger">*</span></label>
                        <input type="text" name="add_org" class="form-control validate" id="add_org" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_address" name="add_address" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email<span class="text-danger">*</span></label>
                        <input type="email" name="add_email" class="form-control validate" id="add_email" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Number<span class="text-danger">*</span></label>
                        <input type="number" name="add_number" class="form-control validate" id="add_number" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Organization Type<span class="text-danger">*</span></label>
                        <input type="text" name="add_type" class="form-control validate" id="add_type" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>

<!--EDIT ORGANIZATION -->
<div class="modal fade" tabindex="-1" role="dialog" id="organization_edit_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit RSO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update_org">
                <div class="modal-body">
                    <div class="md-form">
                        <input type="hidden" class="form-control validate" id="edit_org_id" disabled>
                        <label data-error="wrong" data-success="right">Organization Name<span class="text-danger">*</span></label>
                        <input type="text" name="" class="form-control validate" id="edit_org" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="edit_address" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email<span class="text-danger">*</span></label>
                        <input type="email" name="" class="form-control validate" id="edit_email" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Number<span class="text-danger">*</span></label>
                        <input type="number" name="" class="form-control validate" id="edit_number" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Organization Type<span class="text-danger">*</span></label>
                        <input type="text" name="" class="form-control validate" id="edit_type" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>

<!-- UPLOAD DOCUMENTS -->
<div class="modal fade" tabindex="-1" role="dialog" id="upload_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Required Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_upload" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="organization_id" name="organization_id" class="form-control">
                    <label data-error="wrong" data-success="right">Letter of Intent<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <input type="file" name="add_file_intent" class="form-control validate" id="add_file_intent">
                        <button type="button" class="btn btn-primary" id="submit1">Submit</button>
                    </div>
                    <br>
                    <label data-error="wrong" data-success="right">Letter of Request<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <input type="file" name="add_file_letter" class="form-control validate" id="add_file_letter">
                        <button type="button" class="btn btn-primary" id="submit2">Submit</button>
                    </div>
                    <br>
                    <label data-error="wrong" data-success="right">Membership Form<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <input type="file" name="add_file_form" class="form-control " id="add_file_form">
                        <button type="button" class="btn btn-primary" id="submit3">Submit</button>
                    </div>
                    <br>
                    <label data-error="wrong" data-success="right">CBL<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <input type="file" name="add_file_cbl" class="form-control " id="add_file_cbl">
                        <button type="button" class="btn btn-primary" id="submit4">Submit</button>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>
</div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RSO DETAILS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <p id="name"    class="font-weight-bold"></p>
                            <p id="address" class="font-weight-bold"></p>
                            <p id="email"   class="font-weight-bold"></p>
                            <p id="number"  class="font-weight-bold"></p>
                            <p id="type"    class="font-weight-bold"></p>
                            <p id="date_inserted" class="font-weight-bold"></p>
                            <p id="active" class="font-weight-bold"></p> -->

                <table class="table table-bordered" id="my_table">

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>

<!-- Document _download -->
<div class="modal fade" tabindex="-1" role="dialog" id="document_modal">
    <div class="modal-dialog  modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Download Documents</h5>
                <button type="button" class="close" onclick="refresh()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <input type="hidden" id="organization_iid" class="form-control">

                    <label data-error="wrong" data-success="right">Letter of Intent<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <a id="intent" href="#" class="btn btn-primary">Download Document</a>
                    </div>
                    <br>

                    <label data-error="wrong" data-success="right">Letter of Request<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <a id="request" href="#" class="btn btn-primary">Download Document</a>
                    </div>
                    <br>

                    <label data-error="wrong" data-success="right">Membership Form<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <a id="form" href="#" class="btn btn-primary">Download Document</a>
                    </div>
                    <br>

                    <label data-error="wrong" data-success="right">CBL<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <a id="cbl" href="#" class="btn btn-primary">Download Document</a>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>
</div>
</div>

<!-- Document _download -->
<div class="modal fade" tabindex="-1" role="dialog" id="alert_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">ALERT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="" enctype="multipart/form-data">
                <div class="modal-body">
                    <span> The file is empty. Please Upload the document first</span>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>
</div>
</div>


<!----------------------------REJECT MODAL --------------------------------->
<div class="modal fade" id="reject_Modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remark(s)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
                </button>
            </div>
            <div class="modal-body text-center">
                <h4 id="content1" class="fw-bold">
                    <!-- CONTENT -->
                </h4>
            </div>
        </div>
    </div>
</div>






<!-- <div class="md-form">
    <label data-error="wrong" data-success="right">Letter of Intent<span class="text-danger">*</span></label>
    <input type="file" name="add_file_intent" class="form-control validate" id="add_file_intent">
</div>
<div class="md-form">
    <label data-error="wrong" data-success="right">Letter of Request<span class="text-danger">*</span></label>
    <input type="file" name="add_file_letter" class="form-control validate" id="add_file_letter">
</div>
<div class="md-form">
    <label data-error="wrong" data-success="right">Membership Form<span class="text-danger">*</span></label>
    <input type="file" name="add_file_form" class="form-control " id="add_file_form">
</div>
<div class="md-form">
    <label data-error="wrong" data-success="right">CBL<span class="text-danger">*</span></label>
    <input type="file" name="add_file_cbl" class="form-control " id="add_file_cbl">
</div> -->