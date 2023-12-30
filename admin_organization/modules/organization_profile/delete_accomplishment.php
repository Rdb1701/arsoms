<?php
include("../../../app/database.php");

extract($_POST);

$path = "uploads_accomplishment/$accomplishment_file";

$data = array();
$res_success = 0;
$res_message = "";

$query = "
DELETE FROM tbl_accomplishment
WHERE accomplishment_id = '$accomplishment_id'
";

if($db->query($query)){
    unlink($path);
    $res_success = 1;

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  