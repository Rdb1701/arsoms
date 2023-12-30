<?php
include("../../../app/database.php");

$user_id = mysqli_real_escape_string($db, trim($_POST['user_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$email        = '';



$query = "
SELECT * FROM tbl_users
WHERE user_id = '$user_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $user_id      = $row['user_id'];
  $username     = $row['username'];
  $lname        = $row['lname'];
  $fname        = $row['fname'];
  $gender       = $row['gender'];
  $email        = $row['email'];

}

$data['user_id']      = $user_id;
$data['username']     = $username;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['gender']       = $gender;
$data['email']        = $email;

echo json_encode($data);


?>