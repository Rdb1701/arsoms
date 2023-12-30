<?php
include("../../../app/database.php");

$organization_id   = mysqli_real_escape_string($db, trim($_POST['organization_id']));
$data         = array();
$files        = array();
$res_success  = 0;
$res_message  = " ";

$result1      = array();


$query="
SELECT * FROM tbl_reports_profile
WHERE organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

    $temp_arr = array();
    $res_success = 1; 
    while ($row = mysqli_fetch_assoc($result)) {

        $temp_arr['reports_file']  = $row['reports_file'];
        $temp_arr['report_id']     = $row['report_id'];

        $files[] = $temp_arr;

    }
}else{
    $res_message = "QUERY FAILED";
}

foreach ($files as $rows) {
    array_push($result1, $rows);  
} 


$data['files']        = $result1;
$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);



?>