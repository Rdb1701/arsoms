<?php
include("../app/database.php");

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM tbl_users
 WHERE username = '$username'
";
$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO tbl_users(username,
        password,
        fname,
        lname,
        gender,
        email,
        user_type_id,
        isActive) VALUES('$username',
        '".md5($password)."',
        '$fname',
        '$lname',
        '$gender',
        '$email',
        '2',
        '1'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username already Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);


?>