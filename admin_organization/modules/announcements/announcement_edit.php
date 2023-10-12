<?php
include("../../../app/database.php");

$announcement_id = mysqli_real_escape_string($db, trim($_POST['announcement_id']));

$data = array();

$announcement_desc = '';
$org               = '';
$title             = '';

$query = "
SELECT * FROM tbl_announcement
WHERE announcement_id = '$announcement_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $org                = $row['organization_id'];
  $announcement_desc  = $row['announcement_desc'];
  $title              = $row['title'];


}

$data['announcement_id']    = $announcement_id;
$data['announcement_desc']  = $announcement_desc;
$data['title']              = $title;
$data['org']                = $org;




echo json_encode($data);


?>