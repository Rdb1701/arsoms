<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

$rso              = mysqli_real_escape_string($db, $_POST['rso']);
$title            = mysqli_real_escape_string($db, $_POST['title']);
$announcement     = mysqli_real_escape_string($db, $_POST['announcement']);
$announcement_id  = mysqli_real_escape_string($db, $_POST['announcement_id']);


$res_success = 0;
$res_message = "";
$data        = array();

$query = "
UPDATE tbl_announcement
SET
organization_id        = '$rso',
title                  = '$title',
announcement_desc      = '$announcement'
WHERE announcement_id  = '$announcement_id'
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
