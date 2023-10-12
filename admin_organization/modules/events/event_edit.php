<?php
include("../../../app/database.php");

$event_id = mysqli_real_escape_string($db, trim($_POST['event_id']));
$data = array();

$rso          = '';
$event        = '';
$date_event   = '';
$up_to        = '';

$query = "
SELECT DATE(event_date) as event_date, DATE(last_event_date) as last_event_date, organization_id, event_desc
FROM tbl_events
WHERE event_id = '$event_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $rso          = $row['organization_id'];
  $event        = $row['event_desc'];
  $date_event   = $row['event_date'];
  $up_to        = $row['last_event_date'];

}

$data['event_id']   = $event_id;
$data['rso']        = $rso;
$data['event']      = $event;
$data['date_event'] = $date_event;
$data['up_to']      = $up_to;

echo json_encode($data);


?>