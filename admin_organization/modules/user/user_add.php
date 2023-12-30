<?php
include("../../../app/database.php");

extract($_POST);
$res_success = 0;
$res_message = "";
$data = array();


$query = "
SELECT * FROM tbl_users
 WHERE username = '$username'
";
$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

$query = "
INSERT INTO tbl_users(
username,
password,
fname,
lname,
gender,
email,
admin_org_id,
user_type_id,
isActive
)VALUES(
'$username',
'".md5($username)."',
'$fname',
'$lname',
'$gender',
'$email',
'".$_SESSION['admin_org']['user_id']."',
'3',
'1'
)
";

if (mysqli_query($db, $query)) {
    $res_success = 1;
} else {
    $res_message = "Query Failed";
}
} else {
    $res_message = "Username Already Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);
?>


