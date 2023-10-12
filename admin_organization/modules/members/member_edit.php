<?php
include("../../../app/database.php");

$student_id = mysqli_real_escape_string($db, trim($_POST['student_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$email        = '';
$rso          = '';
$year_level   = '';


$query = "
SELECT * FROM tbl_students
WHERE student_id = '$student_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $student_id   = $row['student_id'];
  $username     = $row['username'];
  $lname        = $row['lname'];
  $fname        = $row['fname'];
  $gender       = $row['gender'];
  $email        = $row['email'];
  $rso          = $row['organization_id'];
  $year_level   = $row['year_level'];

}

$data['student_id']   = $student_id;
$data['username']     = $username;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['gender']       = $gender;
$data['email']        = $email;
$data['rso']          = $rso;
$data['year_level']   = $year_level;



echo json_encode($data);


?>