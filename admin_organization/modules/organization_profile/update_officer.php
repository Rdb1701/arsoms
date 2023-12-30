<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

$data = array();

$res_success = 0;
$res_message = '';


$organization_id          = mysqli_real_escape_string($db, trim($_POST['edit_officer_id']));

$newReq         = $_POST['newReq_file'];
$newReq1        = $_POST['newReq1_file'];


 // loop insert officers
foreach($newReq as $key => $value){
    $query = "
    INSERT INTO tbl_organization_officers(
    organization_id,
    name,
    role,
    date_inserted
    )VALUES(
    '$organization_id',
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

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
    

?>