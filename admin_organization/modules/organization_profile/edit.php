<?php
include("../../../app/database.php");

$profile_id = mysqli_real_escape_string($db, trim($_POST['profile_id']));

$data = array();

$organization_id  = '';
$description      = '';
$mission          = '';
$vision           = '';
$goal             = '';

$query = "
SELECT * FROM tbl_organization_profile
WHERE profile_id = '$profile_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $organization_id   = $row['organization_id'];
  $description       = $row['description'];
  $mission           = $row['mission'];
  $vision            = $row['vision'];
  $goal              = $row['goals'];
 
}

$data['profile_id']       = $profile_id;
$data['organization_id']  = $organization_id;
$data['description']      = $description;
$data['mission']          = $mission;
$data['vision']           = $vision;
$data['goal']             = $goal;

echo json_encode($data);


?>