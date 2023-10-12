<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');


$announcement  = mysqli_real_escape_string($db, trim($_POST['announcement']));
$title         = mysqli_real_escape_string($db, trim($_POST['title']));
$add_rso       = mysqli_real_escape_string($db, trim($_POST['add_rso']));

$res_success = 0;
$res_message = "";
$data = array();

$query = "
INSERT INTO tbl_announcement(
organization_id,
title,
announcement_desc,
date_inserted
)VALUES(
'$add_rso',
'$title',
'$announcement',
'".date("Y-m-d H:i:s")."'
)
";

if (mysqli_query($db, $query)) {
    $res_success = 1;

} else {
    $res_message = "Query Failed";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);
