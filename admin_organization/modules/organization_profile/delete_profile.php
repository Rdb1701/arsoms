<?php
include("../../../app/database.php");

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
DELETE FROM tbl_organization_profile
WHERE profile_id = '$profile_id'
";

if($db->query($query)){

    $query_report= "DELETE FROM tbl_reports_profile WHERE organization_id = '$organization_id'";
    $db->query($query_report);

    $query_accomplishment = "DELETE FROM tbl_accomplishment WHERE organization_id = '$organization_id'";
    $db->query($query_accomplishment);

    $query_officer = "DELETE FROM tbl_organization_officers WHERE organization_id = '$organization_id'";
    $db->query($query_officer);

    $res_success = 1;

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  