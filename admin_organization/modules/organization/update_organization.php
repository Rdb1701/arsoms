<?php
include("../../../app/database.php");

$data = array();
$res_success = 0;
$res_message = "";

extract($_POST);


$query = "
UPDATE tbl_organization
SET
org_name = '$org_name',
address = '$address',
email   = '$email',
number  = '$number',
type    = '$type'
WHERE organization_id = '$org_id'
";

if($db->query($query)){
    $res_success = 1;
}else{
    $res_message = "Failed";
}


$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>