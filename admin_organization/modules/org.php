<?php
include("../header.php");
?>
<div class="page-heading">
  <h3 class="">Student Organization</h3>
</div>
<br>
<div>
  <button onclick="add_org()" data-toggle="modal" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Create RSO</button>
</div><br>
<div class="page-content">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Logo</th>
              <th class="text-center">Organization Name</th>
              <th class="text-center">Organization Details</th>
              <th class="text-center">Documents</th>
              <th class="text-center">Date Created</th>
              <th class="text-center">Status</th>
              <th class="text-center">Remarks</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <!------------------------- CONTENT TABLE------------------------------>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<?php
include("modal/modal_organization.php");
include("../footer.php");
?>

<script>

function logo_upload(organization_id){
    $('#logo_id').val(organization_id)
    $('#upload_excel_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#upload_excel_modal').modal('show');

}

  //EMPTY DOCUMENT
  function refresh() {
    location.reload();
  }

  // ADD ORGANIZATION
  function add_org() {
    $('#organization_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $("#organization_modal").modal("show")
  }

  //DELETE ORG
  function delete_org(organization_id) {
    $('#delete_id').val(organization_id);
    $('#delete_modal').modal('show');
  }

  function file_upload(organization_id) {
    $('#organization_id').val(organization_id)
    $('#upload_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#upload_modal').modal('show')
  }

  //EDIT ORGANIZATION
  function edit_org(organization_id) {
    $.ajax({
      url: 'organization/org_edit',
      type: 'POST',
      data: {
        organization_id: organization_id

      },
      dataType: 'JSON',
      beforeSend: function() {

      }
    }).done(function(res) {

      $('#edit_org_id').val(res.org_id);
      $('#edit_org').val(res.org_name);
      $('#edit_address').val(res.address);
      $('#edit_email').val(res.email);
      $('#edit_number').val(res.number);
      $('#edit_type').val(res.type);
      $('#organization_edit_modal').modal({
        backdrop: 'static',
        keyboard: false
      })
      $('#organization_edit_modal').modal('show');

    }).fail(function() {
      console.log("FAIL");
    })
  }

  //remarks Org
  function remarks_org(organization_id) {

    $.ajax({
      url: 'organization/org_reject_remarks',
      type: 'POST',
      data: {
        organization_id: organization_id,

      },
      dataType: 'JSON',
      beforeSend: function() {

      }
    }).done(function(res) {
      if (res.res_success == 1) {
        // swal(res.remark_desc ,"","");
        $('#content1').html(res.remark_desc);
        $('#reject_Modal').modal({
          backdrop: 'static',
          keyboard: false
        }, 'show');
        $('#reject_Modal').modal('show');
      } else {
        alert(res.res_message)
      }
    })


  }


  //FILE DOCUMENTS
  function file_documents(organization_id, intent, request, form, cbl, list_activities, roster) {

    //INTENT LETTER
    let intent_letter = document.getElementById("intent");
    let documentUrl = "organization/uploads/" + intent;
    if (intent == "") {
      intent_letter.setAttribute("data-toggle", "modal");
      intent_letter.setAttribute("data-target", "#alert_modal");
    } else {
      intent_letter.setAttribute("href", documentUrl);
    }

    //REQUEST LETTER
    let request_letter = document.getElementById("request");
    let documentUrl2 = "organization/uploads/" + request;
    if (request == "") {
      request_letter.setAttribute("data-toggle", "modal");
      request_letter.setAttribute("data-target", "#alert_modal");
    } else {
      request_letter.setAttribute("href", documentUrl2);
    }

    //MEMBERSHIP FORM
    let form_membership = document.getElementById("form");
    let documentUrl3 = "organization/uploads/" + form;
    if (form == "") {
      form_membership.setAttribute("data-toggle", "modal");
      form_membership.setAttribute("data-target", "#alert_modal");
    } else {
      form_membership.setAttribute("href", documentUrl3);
    }

    //CBL
    let cbl_1 = document.getElementById("cbl");
    let documentUrl4 = "organization/uploads/" + cbl;

    if (cbl == "") {
      cbl_1.setAttribute("data-toggle", "modal");
      cbl_1.setAttribute("data-target", "#alert_modal");
    } else {
      cbl_1.setAttribute("href", documentUrl4);
    }

     //List of Activities
     let list_1 = document.getElementById("list");
    let documentUrl5 = "organization/uploads/" + list_activities;

    if (list_activities == "") {
      list_1.setAttribute("data-toggle", "modal");
      list_1.setAttribute("data-target", "#alert_modal");
    } else {
      list_1.setAttribute("href", documentUrl5);
    }

     //Roster
     let roster_1 = document.getElementById("roster");
    let documentUrl6 = "organization/uploads/" + roster;

    if (roster == "") {
      roster_1.setAttribute("data-toggle", "modal");
      roster_1.setAttribute("data-target", "#alert_modal");
    } else {
      roster_1.setAttribute("href", documentUrl6);
    }

    $('#document_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#document_modal').modal('show')

  }

  //VIEW DETAILS
  function view_details(organization_id) {
    $.ajax({
      url: 'organization/view_details',
      type: 'POST',
      data: {
        organization_id: organization_id

      },
      dataType: 'JSON',
      beforeSend: function() {

      }
    }).done(function(res) {

      let table = "<thead>";
      table += "<tr>" +
        '<th class=\"text-left font-weight-bold\">ORGANIZATION NAME</th>' +
        '<th class=\"text-left font-weight-bold\">' + res.org_name + '</th>' +
        '</tr>' +
        '<tr>' +
        '<th class=\"text-left\">ADDRESS</th>' +
        '<th class=\"text-left\">' + res.address + '</th>' +
        '</tr>' +
        '<tr>' +
        '<th class=\"text-left\">CONTACT NUMBER</th>' +
        '<th class=\"text-left\">' + res.number + '</th>' +
        '</tr>' +
        '<tr>' +
        '<th class=\"text-left\">EMAIL</th>' +
        '<th class=\"text-left\">' + res.email + '</th>' +
        '</tr>' +
        '<tr>' +
        '<th class=\"text-left\">ORGANIZATION TYPE</th>' +
        '<th class=\"text-left\">' + res.type + '</th>' +
        '</tr>' +
        '<tr>' +
        '<th class=\"text-left\">ACTIVE</th>' +
        '<th class=\"text-left\">' + res.active + '</th>' +
        '</tr>' +
        '<tr>' +
        '<th class=\"text-left\">DATE CREATED</th>' +
        '<th class=\"text-left\">' + res.date_inserted + '</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';

      $('#my_table').html(table)
      $('#show_modal').modal({
        backdrop: 'static',
        keyboard: false
      })
      $('#show_modal').modal('show');

    }).fail(function() {
      console.log("FAIL");
    })
  }


  $(document).ready(function() {

    var table = $('#myTable').DataTable({
      ajax: 'organization/view_organization', // API endpoint to fetch data
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
          "className": "text-center font-weight-bold",
        },
        {
          data: [6],
          "className": "text-center"
        },
        {
          data: [7],
          "className": "text-center"
        }

      ]
    });

    //ADD ORGANIZATIONS
    $('#form_org').on('submit', function(e) {
      e.preventDefault();

      let org_name  = $('#add_org').val();
      let address   = $('#add_address').val();
      let email     = $('#add_email').val();
      let number    = $('#add_number').val();
      let type      = $('#add_type').val();

      let errors = new Array();
      let input = "Please Input";

      if (org_name == '') {
        errors.push('Organization Name');
      }
      if (address == '') {
        errors.push('Address');
      }
      if (email == '') {
        errors.push('Email');
      }
      if (number == '') {
        errors.push('Number');
      }
      if (type == '') {
        errors.push('Organization Type');
      }
      if (errors.length > 0) {
        let error = '';
        $.each(errors, function(key, value) {
          if (error == '') {
            error += '• ' + value;
          } else {
            error += '\n• ' + value;
          }
        });
        alert(input + '\n' + error);
      } else {

        $.ajax({
          url: 'organization/add_organization',
          type: 'POST',
          data: {
            org_name  : org_name,
            address   : address,
            email     : email,
            number    : number,
            type      : type
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {
          if (res.res_success == 1) {
            alert('Successfully Registered');
            var currentPageIndex = table.page.info().page;
            table.ajax.reload(function() {
              table.page(currentPageIndex).draw(false);
            }, false);
            $('#organization_modal').modal('hide');

          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('fail')
        })

      }
    })

    // UPDATE FORM
    $('#form_update_org').submit(function(e) {
      e.preventDefault();

      let org_id    = $('#edit_org_id').val();
      let org_name  = $('#edit_org').val();
      let address   = $('#edit_address').val();
      let email     = $('#edit_email').val();
      let number    = $('#edit_number').val();
      let type      = $('#edit_type').val();

      $.ajax({
        url: 'organization/update_organization',
        type: 'POST',
        data: {
          org_id   : org_id,
          org_name : org_name,
          address  : address,
          email    : email,
          number   : number,
          type     : type
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
          $('#organization_edit_modal').modal('hide');

        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })

    })

    //DELETING
    $('#delete_form').submit(function(e) {
      e.preventDefault()

      let organization_id = $('#delete_id').val()

      $.ajax({
        url: 'organization/delete_organization',
        type: 'POST',
        data: {
          organization_id: organization_id

        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          alert('Successfully Deleted');
          var currentPageIndex = table.page.info().page;
          table.ajax.reload(function() {
            table.page(currentPageIndex).draw(false);
          }, false);
          $('#delete_modal').modal('hide');

        } else {
          alert()
          alert(res.res_message);
        }
      }).fail(function() {
        console.log("FAIL");
      })

    })


    // -----------------------------FIRST BUTTON UPLOAD-------------------------------------------//

    $("#submit1").on("click", function(e) {
      e.preventDefault();

      var fd = new FormData($("#form_upload")[0]);
      var files = $("#add_file_intent")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('add_file_intent', files[0]);


        $.ajax({
          url: 'organization/org_upload1',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert("Successfully Uploaded")


            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })


    // -----------------------------SECOND BUTTON UPLOAD-------------------------------------------//

    $("#submit2").on("click", function(e) {
      e.preventDefault();

      var fd = new FormData($("#form_upload")[0]);
      var files = $("#add_file_letter")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('add_file_letter', files[0]);


        $.ajax({
          url: 'organization/org_upload2',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert("Successfully Uploaded")

            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })

    // -----------------------------THIRD BUTTON UPLOAD-------------------------------------------//

    $("#submit3").on("click", function(e) {
      e.preventDefault();

      var fd = new FormData($("#form_upload")[0]);
      var files = $("#add_file_form")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('add_file_form', files[0]);


        $.ajax({
          url: 'organization/org_upload3',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert("Successfully Uploaded")

            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })

    // -----------------------------FOURTH BUTTON UPLOAD-------------------------------------------//

    $("#submit4").on("click", function(e) {
      e.preventDefault();

      var fd = new FormData($("#form_upload")[0]);
      var files = $("#add_file_cbl")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('add_file_cbl', files[0]);

        $.ajax({
          url: 'organization/org_upload4',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert("Successfully Uploaded")

            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })

       // -----------------------------list Activities UPLOAD-------------------------------------------//

       $("#submit5").on("click", function(e) {
      e.preventDefault();

      var fd = new FormData($("#form_upload")[0]);
      var files = $("#add_file_list")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('add_file_list', files[0]);

        $.ajax({
          url: 'organization/org_upload5',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert("Successfully Uploaded")

            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })

    // -----------------------------Roster UPLOAD-------------------------------------------//

    $("#submit6").on("click", function(e) {
      e.preventDefault();

      var fd = new FormData($("#form_upload")[0]);
      var files = $("#add_file_roster")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('add_file_roster', files[0]);

        $.ajax({
          url: 'organization/org_upload6',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert("Successfully Uploaded")

            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })



     // -----------------------------UPLOAD LOGO-------------------------------------------//

     $("#upload_logo").on("submit", function(e) {
      e.preventDefault();

      var fd = new FormData($("#upload_logo")[0]);
      var files = $("#logo_file")[0].files;

      for (item of fd) {
        console.log(item[0], item[1]);
      }
      // Check file selected or not
      if (files.length > 0) {
        fd.append('logo_file', files[0]);

        $.ajax({
          url: 'organization/org_logo_upload',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response != 0) {
              alert('Successfully Uploaded Logo');
              var currentPageIndex = table.page.info().page;
              table.ajax.reload(function() {
                table.page(currentPageIndex).draw(false);
              }, false);

              $('#upload_excel_modal').modal('hide');
            } else {
              alert('file not uploaded');
            }
          },
        });
      } else {
        alert("Please select a file.");
      }
    })




  })
</script>