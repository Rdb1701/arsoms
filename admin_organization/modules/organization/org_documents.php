<?php
include("../../../app/database.php");

$data = array();
$organization_id  = mysqli_real_escape_string($db, trim($_POST['organization_id']));

$intent  = "";
$request = "";
$form    = "";
$cbl     = "";

$query = "
SELECT intent_letter, request_letter, form_membership
";
?>