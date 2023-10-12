<?php
include('../header.php');
?>
<div class="page-heading">
    <h3 class="">Announcements</h3>
</div>
<br>
<div>
    <button onclick="add_announcement()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Post</button>
</div><br>
<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Post Title</th>
                            <th class="text-center">Announcement Description</th>
                            <th class="text-center">Organization</th>
                            <th class="text-center">Date Created</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!------------------------- CONTENT TABLE ------------------------------>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include('modal/modal_announcement.php');
include('../footer.php');
?>

<script>

function announcement_upload(announcement_id){
    $('#announcement_id').val(announcement_id)
    $('#upload_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#upload_modal').modal('show');

}

function delete_announcement(announcement_id){
    $('#delete_id').val(announcement_id);
    $('#delete_modal').modal('show');
  }

function add_announcement(){
    $('#add_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#add_modal').modal('show');
}

function edit_announcement(announcement_id){
    $.ajax({
    url: 'announcements/announcement_edit',
    type: 'POST',
    data: {
        announcement_id: announcement_id

    },
    dataType: 'JSON',
    beforeSend: function () {

    }
}).done(function (res) {

  $("#ann_id").val(res.announcement_id);
  $("#edit_rso").val(res.org);
  $("#edit_title").val(res.title);
  $("#edit_announcement").val(res.announcement_desc);
  $('#edit_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
  $('#edit_modal').modal('show');

}).fail(function () {
    console.log("FAIL");
})
  }


$(document).ready(function(){

    var table = $('#myTable').DataTable({
      ajax: 'announcements/announcement_view', // API endpoint to fetch data
      columns: [{
          data: [0],
          "className": "text-center"
        },
        {
          data: [1],
          "className": "text-center"
        },
        {
          data: [2],
          "className": "text-center"
        },
        {
          data: [3],
          "className": "text-center"
        },
        {
          data: [4],
          "className": "text-center"
        },
        {
          data: [5],
          "className": "text-center"
        }
      ]
 
    });

     //ADD ORGANIZATIONS
     $('#form_announcement').submit(function(e){
      e.preventDefault();

      let add_rso       = $('#add_rso').val();
      let announcement  = $('#add_announcement').val();
      let title         = $('#add_title').val();
 
        $.ajax({
          url: 'announcements/announcement_add',
          type: 'POST',
          data: {
            add_rso        : add_rso,
            announcement   : announcement,
            title           : title
        
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Added an Announcement');
           var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#add_modal').modal('hide');

          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })

      
    })


     //UPDATE Announcement
     $('#form_update').submit(function(e){
      e.preventDefault();

      let announcement_id   = $('#ann_id').val();
      let rso               = $('#edit_rso').val();
      let title              = $('#edit_title').val();
      let announcement      = $('#edit_announcement').val();
 
        $.ajax({
          url: 'announcements/announcement_update',
          type: 'POST',
          data: {
            rso             : rso,
            announcement    : announcement,
            announcement_id : announcement_id,
            title           : title
        
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Updated');
           var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#edit_modal').modal('hide');

          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })

      
    })


     //DELETING STUDENTS INFORMATION
     $('#delete_form').submit(function (e) {
             e.preventDefault()

             let announcement_id = $('#delete_id').val()

             $.ajax({
                 url: 'announcements/announcement_delete',
                 type: 'POST',
                 data: {
                    announcement_id: announcement_id

                 },
                 dataType: 'JSON',
                 beforeSend: function () {

                 }
             }).done(function (res) {
                 if (res.res_success == 1) {
                  alert('Successfully Removed');
           var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#delete_modal').modal('hide');

                 } else {
                     alert()
                     alert(res.res_message);
                 }
             }).fail(function () {
                 console.log("FAIL");
             })

         })


 //============================================ UPLOAD PICTURE =========================================>

    $("#upload_form").on("submit", function(e) {
      e.preventDefault();

      var fd = new FormData($("#upload_form")[0]);
      var files = $("#file")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('file', files[0]);


        $.ajax({
          url: 'announcements/announcement_upload',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert('Successfully Uploaded');
              var currentPageIndex = table.page.info().page;
              table.ajax.reload(function() {
                table.page(currentPageIndex).draw(false);
              }, false);

              $('#upload_modal').modal('hide');
            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })

//DOCUMENT READY
})

</script>