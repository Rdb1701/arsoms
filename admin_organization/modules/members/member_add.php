<?php
include("../../../app/database.php");

extract($_POST);
$res_success = 0;
$res_message = "";
$data = array();
$last_id = '';

$query_1 = "
SELECT stud.*, ext.*
 FROM tbl_students as stud
 LEFT JOIN tbl_students_exists as ext ON ext.student_id_number = stud.username
 WHERE stud.username = '$username'
 AND ext.organization_id = '$rso'
";

$result_1 = mysqli_query($db, $query_1);

if (!mysqli_num_rows($result_1)) {

$query = "
SELECT * FROM tbl_students as stud
 WHERE username = '$username'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

$query = "
INSERT INTO tbl_students(
username,
password,
fname,
lname,
gender,
year_level,
email,
isActive
)VALUES(
'$username',
'".md5($username)."',
'$fname',
'$lname',
'$gender',
'$year_level',
'$email',
'1'
)
";

if (mysqli_query($db, $query)) {
    $res_success = 1;

$query_exists ="INSERT INTO tbl_students_exists(
    student_id_number,
    organization_id,
    date_inserted
    )VALUES(
    '$username',
    '$rso',
    '".date("Y-m-d H:i:s")."'
    )";

   mysqli_query($db, $query_exists);


} else {
    $res_message = "Query Failed";
}
} else {

    $query_exists ="INSERT INTO tbl_students_exists(
        student_id_number,
        organization_id,
        date_inserted
        )VALUES(
        '$username',
        '$rso',
        '".date("Y-m-d H:i:s")."'
        )";
    
       mysqli_query($db, $query_exists);
      $res_success = 1;

}
}else{
    $res_message = "Member Alreaday Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);
