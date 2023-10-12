<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

extract($_POST);

$res_success = 0;
$res_message = "";
$data        = array();

$query = "
SELECT * FROM tbl_organization
 WHERE org_name = '$org_name'
";
$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

$query = "
INSERT INTO tbl_organization(
    user_id,
    org_name,
    address,
    email,
    number,
    type,
    isActive,
    status,
    remarks_reject,
    date_inserted)VALUES(
    '".$_SESSION['admin_org']['user_id']."',
    '$org_name',
    '$address',
    '$email',
    '$number',
    '$type',
    '1',
    '0',
    'Pending...',
    '".date("Y-m-d H:i:s")."'
)";

if (mysqli_query($db, $query)) {
    $res_success = 1;

} else {
    $res_message = "Query Failed";
}

} else {
    $res_message = "Organization Name Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);

?>