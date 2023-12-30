<?php

$accomplishment = array();

$query = "
SELECT * FROM tbl_accomplishment
WHERE organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

    $temp_arr['accomplishment_id']    = $row['accomplishment_id'];
    $temp_arr['accomplishment_file']  = $row['accomplishment_file'];


    $accomplishment[] = $temp_arr;

}

}



?>