<?php

$officers = array();

$query = "
SELECT * FROM tbl_organization_officers
WHERE organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

    $temp_arr['name']        = $row['name'];
    $temp_arr['role']        = $row['role'];


    $officers[] = $temp_arr;

}

}



?>