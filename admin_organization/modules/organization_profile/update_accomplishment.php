<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

$data = array();

$res_success = 0;
$res_message = '';


$organization_id          = mysqli_real_escape_string($db, trim($_POST['edit_accomplishment_id']));

$accomplishment          = $_FILES['accomplishment_file']['name'];


   // loop insert reports

for ($j = 0; $j < count($accomplishment); $j++) {
    $fileName    = $_FILES['accomplishment_file']['name'][$j];
    $fileTmpName = $_FILES['accomplishment_file']['tmp_name'][$j];

    $query = "
    INSERT INTO tbl_accomplishment(
    organization_id,
    accomplishment_file,
    date_inserted
    )values(
    '$organization_id',
    '".$fileName."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
        move_uploaded_file($fileTmpName,"uploads_accomplishment/$fileName");

    } else {
        $res_message = "Query Failed Accomplishments";
    }
}

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
    

?>