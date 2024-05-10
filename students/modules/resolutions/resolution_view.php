<?php

$resolution = array();


$query = "
SELECT DISTINCT reso.*, ev.event_desc
FROM tbl_resolution as reso
LEFT JOIN tbl_events as ev ON ev.event_id = reso.event_id
LEFT JOIN tbl_students_exists as stude ON stude.organization_id = ev.organization_id
WHERE stude.student_id_number = '".$_SESSION['student']['username']."'
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