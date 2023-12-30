<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');


extract($_POST);

$data = array();

$res_success = 0;
$res_message = '';

    $query = "
    UPDATE tbl_users
    SET
    lname             = '$lname',
    fname             = '$fname',
    gender            = '$gender',
    email             = '$email'
    WHERE user_id     = '$user_id'
    ";

    if(mysqli_query($db, $query)){
        $res_success = 1;
    }else{
        $res_message = "Query Failed";
    }

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
    

?>