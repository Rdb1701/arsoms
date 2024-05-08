<?php

include('../app/database.php');
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../assets/libraries/PHPMailer/src/Exception.php';
require '../assets/libraries/PHPMailer/src/PHPMailer.php';
require '../assets/libraries/PHPMailer/src/SMTP.php';

$data        = array();
$res_success = 0;
$res_message = 0;
$errors = array();


$email         = mysqli_real_escape_string($db, trim($_POST['email']));

// For the contatanation of the qr/bar code
$q   = substr(date("Y-m-d H:i:s"), 0, 4);
$w   = substr(date("Y-m-d H:i:s"), 5, -12);
$e   = substr(date("Y-m-d H:i:s"), 8, -9);
$r   = substr(date("Y-m-d H:i:s"), 11, -6);
$t   = substr(date("Y-m-d H:i:s"), 14, -3);
$y   = substr(date("Y-m-d H:i:s"), -2);

// $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
$concatqr = $r . $t . $y;


$query = "
SELECT * FROM tbl_users
 WHERE email = '$email'
";
$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {
    $res_message = "We cant find Your Email. Please Enter a valid email";
} else {
    $query = "
    UPDATE tbl_users
    set
    password = '" . md5($concatqr) . "'
    WHERE email = '$email'
    ";

    $result = $db->query($query);
    if ($result) {
        $res_success = 1;

        //-------------------------------------------------SENDING EMAIL-------------------------------------------------------------------
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'asscatcampus@gmail.com';
        $mail->Password = 'wcldkcvfucjjeczf';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('asscatcampus@gmail.com', 'STUDENT ORGANIZATION');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "FORGOT PASSWORD";
        $mail->Body = "Your new password has been set to: ".md5($concatqr)." . Please log in to the system.";
        $mail->send();
    }else{
        $res_message = "Query Failed";
    }
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>
