<?php
include("../../../app/database.php");

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
UPDATE tbl_events
SET
organization_id = '$rso',
event_desc      = '$event',
event_date      = '$date_event',
last_event_date = '$up_to',
expenses        = '$expenses'
WHERE event_id = '$event_id'
";

if($db->query($query)){
    $res_success = 1;
}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);
?>  