<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');


extract($_POST);

$data         = array();
$res_success  = 0;
$res_message  = '';
$organization_id = '';
$users        = array();
$result1      = array();

$query = "
SELECT * FROM tbl_events
WHERE event_id = '$event'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row = $result->fetch_assoc();

    $organization_id = $row['organization_id'];
}else{
    $res_message = "No organization show";
}

//GET STUDENT
$query_student = "
SELECT stud.* FROM tbl_students as stud
LEFT JOIN tbl_students_exists as ext ON ext.student_id_number = stud.username
WHERE ext.organization_id = '$organization_id'
";

$result = $db->query($query_student);
$numRows = $result->num_rows;

if($numRows > 0 ){
    while($row = $result->fetch_assoc()){
        $temp_arr = array();
        $res_success = 1;

        $temp_arr['student_id'] = $row['student_id'];
        $temp_arr['fname']   = $row['fname'];
        $temp_arr['lname']   = $row['lname'];

        $users[] = $temp_arr;

    }
}else{
    $res_message = "Query Failed";
}

foreach ($users as $rows) {
    array_push($result1, $rows);  
} 

$data['users']       = $result1;
$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

 echo json_encode($data);


?>