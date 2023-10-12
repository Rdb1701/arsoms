<?php

include("../../../app/database.php");

$data = array();

$password = mysqli_real_escape_string($db, trim($_POST['password']));

$query  = "
  UPDATE tbl_users
  SET password = '".md5($password)."' 
  WHERE user_id = '".$_SESSION['osa']['user_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>
