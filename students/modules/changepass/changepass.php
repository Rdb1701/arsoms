<?php

include("../../../app/database.php");

$data = array();

$password = mysqli_real_escape_string($db, trim($_POST['password']));

$query  = "
  UPDATE tbl_students
  SET password = '".md5($password)."' 
  WHERE student_id = '".$_SESSION['student']['student_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>
