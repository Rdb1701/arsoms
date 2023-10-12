<?php
include("../../../app/database.php");

$data = array();
$organization_id  = mysqli_real_escape_string($db, trim($_POST['organization_id']));

$org_name = "";
$address  = "";
$email    = "";
$number   = "";
$type     = "";

$query = "
SELECT * FROM tbl_organization
WHERE organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $org_name = $row['org_name'];
  $address = $row['address'];
  $email   = $row['email'];
  $number  = $row['number'];
  $type    = $row['type'];
  
}

$data['org_id']   = $organization_id;
$data['org_name'] = $org_name; 
$data['address']  = $address;
$data['email']    = $email;
$data['number']   = $number;
$data['type']     = $type;


echo json_encode($data);

?>