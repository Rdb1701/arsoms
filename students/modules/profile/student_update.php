<?php
include("../../../app/database.php");

date_default_timezone_set('Asia/Manila');


extract($_POST);

$data = array();

$res_success = 0;
$res_message = '';

    $query = "
    UPDATE tbl_students
    SET
    lname             = '$lname',
    fname             = '$fname',
    gender            = '$gender',
    year_level        = '$year_level',
    email             = '$email'
    WHERE student_id  = '".$_SESSION['student']['student_id']."'
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