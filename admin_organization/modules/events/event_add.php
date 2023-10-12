<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

extract($_POST);

$data         = array();
$res_success  = 0;
$res_message  = "";

$query ="
INSERT INTO tbl_events(
organization_id,
event_desc,
event_date,
expenses,
last_event_date,
date_inserted,
isActive
)VALUES(
'$rso',
'$event',
'$date_event',
'$expenses',
'$up_to',
'".date("Y-m-d H:i:s")."',
'1'
)
";

if (mysqli_query($db, $query)) {
    $res_success = 1;

} else {
    $res_message = "Query Failed";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>