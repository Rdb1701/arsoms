<?php

include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

extract($_POST);
$res_success      = 0;
$res_message      = "";
$data             = array();

$query = "
SELECT * FROM tbl_payment
WHERE student_id = '$student_id' AND
event_id = '$event'
";
$result = mysqli_query($db, $query);
if (!mysqli_num_rows($result)) {

$query = "
INSERT INTO tbl_payment(
event_id,
student_id,
fee,
status,
date_inserted
)VALUES(
'$event',
'$student_id',
'$fee',
'0',
'".date("Y-m-d H:i:s")."'
)
";

if(mysqli_query($db, $query)){
    $res_success = 1;

}else{
    $res_message = "Failed Query";
}


}else{
    $res_message = "The Student Obligation is exists in that event.";
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>