<?php
include '../header.php';
?>

<?php

$sql = "SELECT org_name, organization_id FROM tbl_organization WHERE user_id = '" . $_SESSION['admin_org']['user_id'] . "' AND status = '1'";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='add_rso' id = 'add_rso' required>";
$opt1 .= "<option value='' selected hidden>Select Organization</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='" . $row['organization_id'] . "'>" . $row['org_name'] . "</option>";
}
$opt1 .= "</select>";
?>

<div class="content text-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card h-100 mb-lg-0">
                    <div class="card-body table-responsive">
                        <form id="form_profile">

                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <?php echo $opt1; ?>
                                </div>
                                <div class="form-group col-12 col-md-8">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" class="form-control" name="description" placeholder="Description">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="mission">Mission <span class="text-danger">*</span></label>
                                    <textarea name="mission" id="" cols="30" rows="5" class="tinymce form-control"></textarea>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="vision">Vision <span class="text-danger">*</span></label>
                                    <textarea name="vision" id="" cols="30" rows="5" class="tinymce form-control"></textarea>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="goals">Goals<span class="text-danger">*</span></label>
                                    <textarea name="goals" id="" cols="30" rows="5" class="tinymce form-control"></textarea>
                                </div>
                            </div>
                            <!-- REPORTS -->
                            <div class="row">
                                <div class="form-group col-12 col-md-12 mb-0">
                                    <label class="d-flex">
                                        Reports
                                        <button type="button" id="btnReport" class="btn btn-primary btn-raised btn-sm ml-auto">
                                            <i class="nav-icon fas fa-plus"></i>
                                        </button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hovered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">File</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="newReport">
                                                <tr>
                                                    <td class="text-left">
                                                        <input type="file" name="report[]" id="" class="form-control" required>
                                                    </td>
                                                    <td class="text-center">-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Accomplishments -->
                            <div class="row">
                                <div class="form-group col-12 col-md-12 mb-0">
                                    <label class="d-flex">
                                        Accpmplishments
                                        <button type="button" id="btnAccomplishment" class="btn btn-primary btn-raised btn-sm ml-auto">
                                            <i class="nav-icon fas fa-plus"></i>
                                        </button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hovered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">File</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="newAccomplishment">
                                                <tr>
                                                    <td class="text-left">
                                                        <input type="file" name="accomplishment[]" id="" class="form-control" required>
                                                    </td>
                                                    <td class="text-center">-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- OFFICERS -->
                            <div class="row">
                                <div class="form-group col-12 col-md-12 mb-0">
                                    <label class="d-flex">
                                        List of Officers
                                        <button type="button" id="btnNew" class="btn btn-primary btn-raised btn-sm ml-auto">
                                            <i class="nav-icon fas fa-plus"></i>
                                        </button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hovered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Name</th>
                                                    <th class="text-center">Role</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="newReq">
                                                <tr>
                                                    <td class="text-left">
                                                        <input type="text" class="form-control" name="newReq[]" placeholder="Name" required>
                                                    </td>
                                                    <td class="text-left">
                                                        <input type="text" class="form-control" name="newReq1[]" placeholder="Officer Role" required>
                                                    </td>
                                                    <td class="text-center">-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>

<h4>Organization Profiles</h4>
<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Organization</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Files</th>
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

<!-- <h4>Officers</h4>
<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Officer Name</th>
                            <th class="text-center">Organization</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->


<?php
include '../footer.php';
include 'modal/modal_profile.php';
?>

<script>
    var countNew = 1;
    var countReport = 1;
    var countAccomplishment = 1;

    function remove(id, type) {

        $('#' + type + id).remove()

    }

    function delete_profile(profile_id, organization_id) {
        $('#delete_id').val(profile_id);
        $('#delete_organization_id').val(organization_id);
        $('#delete_modal').modal('show');
    }

    //delete officer
    function delete_officer(officer_id) {

        $.ajax({
            url: 'organization_profile/delete_officer',
            type: 'POST',
            data: {
                officer_id: officer_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Successfully Removed');
                $('tr#' + officer_id + '').fadeOut('slow');

            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    }

    //delete reports
    function delete_report(report_id, report_file) {

        $.ajax({
            url: 'organization_profile/delete_report',
            type: 'POST',
            data: {
                report_id: report_id,
                report_file: report_file

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Successfully Removed');
                $('tr#' + report_id + '').fadeOut('slow');

            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    }

    //delete reports
    function delete_accomplishment(accomplishment_id, accomplishment_file) {

        $.ajax({
            url: 'organization_profile/delete_accomplishment',
            type: 'POST',
            data: {
                accomplishment_id: accomplishment_id,
                accomplishment_file: accomplishment_file

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Successfully Removed');
                $('tr#' + accomplishment_id + '').fadeOut('slow');

            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    }

    //Accomplishment
    function files_open(organization_id) {

        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\">Accomplishments</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            url: 'organization_profile/edit_file_accomplishment',
            type: 'POST',
            data: {
                organization_id: organization_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            if (res.res_success == 1) {
                $.each(res.files, function(key, value) {
                    table += `<tr class="text-center" id ="${value.accomplishment_id}">` +
                        `<td class="text-center"><a href="organization_profile/uploads_accomplishment/${value.accomplishment_file}">${value.accomplishment_file}</a></td>` +
                        `<td class="text-center"><button class = "btn btn-danger"  title="Delete" onclick="delete_accomplishment(${value.accomplishment_id},'${value.accomplishment_file}')"><i class="fa fa-trash"></i></button></td>` +
                        `<tr>`
                    $('#my_table').html(table)
                })
                $('#list_file_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#edit_accomplishment_id').val(organization_id);
                $('#list_file_modal').modal('show');
            } else {
                $('#edit_accomplishment_id').val(organization_id);
                $('#list_file_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#list_file_modal').modal('show');
            }

        }).fail(function() {
            console.log("FAIL");
        })
    }

    //edit officer
    function edit_officer(organization_id) {
        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\">Name</th>" +
            "<th class=\"text-center\">Role</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            url: 'organization_profile/edit_file_officer',
            type: 'POST',
            data: {
                organization_id: organization_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            if (res.res_success == 1) {
                $.each(res.files, function(key, value) {
                    table += `<tr class="text-center" id ="${value.officer_id}">` +
                        `<td class="text-center">${value.name}</td>` +
                        `<td class="text-center">${value.role}</td>` +
                        `<td class="text-center"><button class = "btn btn-danger"  title="Delete" onclick="delete_officer(${value.officer_id})"><i class="fa fa-trash"></i></button></td>` +
                        '<tr>'
                    $('#my_table_officer').html(table)
                })
                $('#edit_officer_id').val(organization_id);
                $('#officer_file_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#officer_file_modal').modal('show');
            } else {
                $('#edit_officer_id').val(organization_id);
                $('#officer_file_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#officer_file_modal').modal('show');
            }

        }).fail(function() {
            console.log("FAIL");
        })
    }

    //reports
    function files_open_report(organization_id) {

        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\">Reports</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            url: 'organization_profile/edit_file_report',
            type: 'POST',
            data: {
                organization_id: organization_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            if (res.res_success == 1) {
                $.each(res.files, function(key, value) {
                    table += `<tr class="text-center" id ="${value.report_id}">` +
                        `<td class="text-center"><a href="organization_profile/uploads_reports/${value.reports_file}">${value.reports_file}</a></td>` +
                        `<td class="text-center"><button class = "btn btn-danger"  title="Delete" onclick="delete_report(${value.report_id},'${value.reports_file}')"><i class="fa fa-trash"></i></button></td>` +
                        '<tr>'
                    $('#my_table_report').html(table)
                })
                $('#edit_report_id').val(organization_id);
                $('#report_file_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#report_file_modal').modal('show');
            } else {
                $('#edit_report_id').val(organization_id);
                $('#report_file_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                $('#report_file_modal').modal('show');
            }

        }).fail(function() {
            console.log("FAIL");
        })
    }
    //edit profile
    function edit_profile(profile_id) {
        $.ajax({
            url: 'organization_profile/edit',
            type: 'POST',
            data: {
                profile_id: profile_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            $("#edit_profile_id").val(res.profile_id);
            $("#edit_rso").val(res.organization_id);
            $("#edit_description").val(res.description);
            $("#edit_mission").val(res.mission);
            $("#edit_vision").val(res.vision);
            $("#edit_goal").val(res.goal);
            $('#list_edit_modal').modal({
                backdrop: 'static',
                keyboard: false
            })

            $('#list_edit_modal').modal('show');

        }).fail(function() {
            console.log("FAIL");
        })

    }

    $(document).ready(function() {

        var table = $('#myTable1').DataTable({
            ajax: 'organization_profile/view', // API endpoint to fetch data
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
                }
            ]

        });

        $('#form_update').on('submit', function(e) {
            e.preventDefault()

            let edit_profile_id = $("#edit_profile_id").val();
            let edit_rso = $("#edit_rso").val();
            let edit_description = $("#edit_description").val();
            let edit_mission = $("#edit_mission").val();
            let edit_vision = $("#edit_vision").val();
            let edit_goals = $("#edit_goals").val();


            $.ajax({
                url: 'organization_profile/update',
                type: 'POST',
                data: {
                    edit_profile_id : edit_profile_id,
                    edit_rso        : edit_rso,
                    edit_description: edit_description,
                    edit_mission: edit_mission,
                    edit_vision: edit_vision,
                    edit_goals: edit_goals

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Update Information');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#list_edit_modal').modal('hide');
                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })
        })

        //Delete Profile
        $('#delete_form').on('submit', function(e) {
            e.preventDefault();

            let profile_id      = $('#delete_id').val()
            let organization_id = $('#delete_organization_id').val()

            $.ajax({
                url: 'organization_profile/delete_profile',
                type: 'POST',
                data: {
                    profile_id: profile_id,
                    organization_id: organization_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
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
            }).fail(function() {
                console.log("FAIL");
            })
        })

    })

    $(document).on('click', '#btnNew', function() {
        countNew++
        html = ''
        html += '<tr id="rowNew' + countNew + '">'
        html += '<td class="text-left"><input type="text" class="form-control" name="newReq[]" placeholder="Name"></td>'
        html += '<td class="text-left"><input type="text" class="form-control" name="newReq1[]" placeholder="Officer Role"></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countNew + ', \'rowNew\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon fas fa-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newReq').append(html)
    })

    $(document).on('click', '#btnReport', function() {
        countReport++
        html = ''
        html += '<tr id="rowReport' + countReport + '">'
        html += '<td class="text-left"><input type="file" name="report[]" id="" class="form-control" required></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countReport + ', \'rowReport\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon fas fa-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newReport').append(html)
    })


    $(document).on('click', '#btnAccomplishment', function() {
        countAccomplishment++
        html = ''
        html += '<tr id="rowAccomplish' + countAccomplishment + '">'
        html += '<td class="text-left"><input type="file" name="accomplishment[]" id="" class="form-control" required></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countAccomplishment + ', \'rowAccomplish\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon fas fa-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newAccomplishment').append(html)
    })



    $(document).on('submit', '#form_profile', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'organization_profile/add',
            method: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'JSON',
            beforeSend: function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Success');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function(err) {
            console.log(err)
        })
    })


    //UPDATE Reports
    $(document).on('submit', '#report_update', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'organization_profile/update_report',
            method: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'JSON',
            beforeSend: function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Success');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function(err) {
            console.log(err)
        })
    })


    //UPDATE Officer
    $(document).on('submit', '#officer_update', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'organization_profile/update_officer',
            method: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'JSON',
            beforeSend: function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Success');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function(err) {
            console.log(err)
        })
    })


    //UPDATE Accomplishment
    $(document).on('submit', '#file_update', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'organization_profile/update_accomplishment',
            method: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'JSON',
            beforeSend: function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Success');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function(err) {
            console.log(err)
        })
    })
</script>