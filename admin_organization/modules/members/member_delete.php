<?php
include("../../../app/database.php");

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
DELETE FROM tbl_students
WHERE student_id = '$student_id'
";

if($db->query($query)){

    $query_delete = "DELETE FROM tbl_payment WHERE student_id = '$student_id'";
    $db->query($query_delete);
    $res_success = 1;

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  