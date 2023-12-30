<?php
include("../../../app/database.php");

$res_success = 0;
$res_message = "";
$data = array();

$add_rso        = mysqli_real_escape_string($db, trim($_POST['add_rso']));
$description    = mysqli_real_escape_string($db, trim($_POST['description']));
$mission        = mysqli_real_escape_string($db, trim($_POST['mission']));
$vision         = mysqli_real_escape_string($db, trim($_POST['vision']));
$goals          = mysqli_real_escape_string($db, trim($_POST['goals']));

$newReq         = $_POST['newReq'];
$newReq1        = $_POST['newReq1'];

$accomplishment  = $_FILES['accomplishment']['name'];
$report          = $_FILES['report']['name'];

$temp_name       = $_FILES['accomplishment']['tmp_name'];
$temp_name1      = $_FILES['report']['tmp_name'];



$query = "
SELECT * FROM tbl_organization_profile
 WHERE organization_id = '$add_rso'
";
$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

$query = "
INSERT INTO tbl_organization_profile(
organization_id,
description,
mission,
vision,
goals,
date_inserted)VALUES(
'$add_rso',
'$description',
'$mission',
'$vision',
'$goals',
'".date("Y-m-d H:i:s")."'
)
";

if (mysqli_query($db, $query)) {
    $res_success = 1;


// loop insert officers
foreach($newReq as $key => $value){
    $query = "
    INSERT INTO tbl_organization_officers(
    organization_id,
    name,
    role,
    date_inserted
    )VALUES(
    '$add_rso',
    '".$value."',
    '".$newReq1[$key]."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed Array";
    }
}


// loop insert accomplishments
for ($i = 0; $i < count($accomplishment); $i++) {
    $fileName    = $_FILES['accomplishment']['name'][$i];
    $fileTmpName = $_FILES['accomplishment']['tmp_name'][$i];

    $query = "
    INSERT INTO tbl_accomplishment(
    organization_id,
    accomplishment_file,
    date_inserted
    )values(
    '$add_rso',
    '".$fileName."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {

        move_uploaded_file($fileTmpName,"uploads_accomplishment/$fileName");

    } else {
        $res_message = "Query Failed Accomplishments";
    }
}



// loop insert reports

for ($j = 0; $j < count($report); $j++) {
    $fileName    = $_FILES['report']['name'][$j];
    $fileTmpName = $_FILES['report']['tmp_name'][$j];

    $query = "
    INSERT INTO tbl_reports_profile(
    organization_id,
    reports_file,
    date_inserted
    )values(
    '$add_rso',
    '".$fileName."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {

        move_uploaded_file($fileTmpName,"uploads_reports/$fileName");

    } else {
        $res_message = "Query Failed Accomplishments";
    }
}


} else {
    $res_message = "Query Failed";
}


} else {
    $res_message = "Organization Profile Already Exists";
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);




?>


