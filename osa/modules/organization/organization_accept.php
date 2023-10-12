<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../../assets/libraries/PHPMailer/src/Exception.php';
require '../../../assets/libraries/PHPMailer/src/PHPMailer.php';
require '../../../assets/libraries/PHPMailer/src/SMTP.php';

extract($_POST);

$data = array();

$res_success = 0;
$res_message = '';

$query = "
    UPDATE tbl_organization
    SET
    status      = '1',
    remarks_reject = 'Accredited'
    WHERE organization_id = '$organization_id'
    ";

if (mysqli_query($db, $query)) {
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
    $mail->setFrom('asscatcampus@gmail.com', 'OSA');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "STUDENT ORGANIZAION APPLICATION";
    $mail->Body = "Your Student Organization has been approved by OSA. Please Log in on your account to manage it. Thank You and Goodluck!";
    $mail->send();

} else {
    $res_message = "Query Failed";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
