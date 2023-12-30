<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');


$profile_id     = mysqli_real_escape_string($db, trim($_POST['edit_profile_id']));
$rso            = mysqli_real_escape_string($db, trim($_POST['edit_rso']));
$description    = mysqli_real_escape_string($db, trim($_POST['edit_description']));
$mission        = mysqli_real_escape_string($db, trim($_POST['edit_mission']));
$vision         = mysqli_real_escape_string($db, trim($_POST['edit_vision']));
$goals          = mysqli_real_escape_string($db, trim($_POST['edit_goals']));

$data = array();

$res_success = 0;
$res_message = '';

    $query = "
    UPDATE tbl_organization_profile
    SET
    organization_id   = '$rso',
    description       = '$description',
    mission           = '$mission',
    vision            = '$vision',
    goals             = '$goals'
    WHERE profile_id  = '$profile_id'
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