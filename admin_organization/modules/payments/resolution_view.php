<?php

$resolution = array();


$query = "
SELECT reso.*, ev.event_desc
FROM tbl_resolution as reso
LEFT JOIN tbl_events as ev ON ev.event_id = reso.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER by reso.date_inserted ASC 

";
$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $temp_arr['resolution_id']      = $row['resolution_id'];
      $temp_arr['event_id']           = $row['event_id'];
      $temp_arr['event_desc']         = $row['event_desc'];
      $temp_arr['filename']           = $row['filename'];

      $resolution[] = $temp_arr;
    }
}


?>