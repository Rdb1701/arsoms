<?php

$reports = array();

$query = "
SELECT * FROM tbl_reports_profile
WHERE organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

    $temp_arr['report_id']           = $row['report_id'];
    $temp_arr['reports_file']        = $row['reports_file'];


    $reports[] = $temp_arr;

}

}



?>