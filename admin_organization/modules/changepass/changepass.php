<?php

include("../../../app/database.php");

$data = array();

extract($_POST);

$query  = "
  UPDATE tbl_users
  SET 
  email = '$email',
  password = '".md5($password)."'
  WHERE user_id = '".$_SESSION['admin_org']['user_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>
