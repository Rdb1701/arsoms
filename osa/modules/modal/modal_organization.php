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
                    <input type="hidden" name="" id="delete_email">
                </div>
                <div class="modal-footer">
                      <!-- Image loader -->
                      <div id='loader4' style='display: none;'>
                        <img src='../../assets/img/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response'></div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn_delete" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!------------------------------------- ACCEPT ORGANZIATION -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="accept_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Accept?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="accept_form">
                <div class="modal-body">
                    <span>are you sure do you want to Accept?</span>
                    <input type="hidden" name="" id="accept_id">
                    <input type="hidden" name="" id="accept_email">
                </div>
                <div class="modal-footer">
                      <!-- Image loader -->
                      <div id='loader' style='display: none;'>
                        <img src='../../assets/img/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response'></div>
                    <button class="btn btn-secondary" type="button"  data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn_approve" class="btn btn-success">Accept</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!------------------------------------- REJECT ORGANZIATION -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="reject_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Reject?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="reject_form">
                <div class="modal-body">
                    <input type="hidden" name="" id="reject_id">
                    <input type="hidden" name="" id="reject_email">
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Remarks<span class="text-danger">*</span></label>
                       <textarea name="" id="remarks" class="form-control" cols="10" rows="7" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                      <!-- Image loader -->
                      <div id='loader1' style='display: none;'>
                        <img src='../../assets/img/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response1'></div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn_reject" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- Details Modal -->
<div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">STUDENT ORGANIZATION DETAILS</h5>
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
            <form id="form_upload" enctype="multipart/form-data">
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
                    <br>
                    
                    <label data-error="wrong" data-success="right">List of Activities<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <a id="list" href="#" class="btn btn-primary">Download Document</a>
                    </div>

                    <br>
                    <label data-error="wrong" data-success="right">Roster<span class="text-danger">*</span></label>
                    <div class="d-flex">
                        <a id="roster" href="#" class="btn btn-primary">Download Document</a>
                    </div>
                    <br>

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
            <form id="form_upload" enctype="multipart/form-data">
                <div class="modal-body">
                    <span> The file is empty!</span>          
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>
</div>
</div>

