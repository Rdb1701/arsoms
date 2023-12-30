<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

$data = array();

$res_success = 0;
$res_message = '';


$organization_id          = mysqli_real_escape_string($db, trim($_POST['edit_report_id']));

$report          = $_FILES['report_file']['name'];


   // loop insert reports

for ($j = 0; $j < count($report); $j++) {
    $fileName    = $_FILES['report_file']['name'][$j];
    $fileTmpName = $_FILES['report_file']['tmp_name'][$j];

    $query = "
    INSERT INTO tbl_reports_profile(
    organization_id,
    reports_file,
    date_inserted
    )values(
    '$organization_id',
    '".$fileName."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
        move_uploaded_file($fileTmpName,"uploads_reports/$fileName");

    } else {
        $res_message = "Query Failed Accomplishments";
    }
}

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
    

?>