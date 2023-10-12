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
$res_success      = 0;
$res_message      = "";
$data             = array();
$email            = '';
$fname            = '';

$query_insert = "
    INSERT INTO tbl_payment(
    event_id,
    student_id,
    fee,
    sanction_remarks,
    status,
    date_inserted
    )VALUES(
    '$event',
    '$student_id',
    '$fee',
    '$remarks',
    '2',
    '" . date("Y-m-d H:i:s") . "'
    )
    ";

if (mysqli_query($db, $query_insert)) {
    $res_success = 1;

    //GET EMAIL AND SEND
    $query_email = "
    SELECT email, fname
    FROM tbl_students
    WHERE student_id = '$student_id'
    ";
    $result = mysqli_query($db, $query_email);
    $numRows = $result->num_rows;

    if ($numRows > 0) {
        $row = $result->fetch_assoc();

        $email = $row['email'];
        $fname = $row['fname'];

    }else{
        $res_message = "cAnnot find email";
    }

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
  $mail->Subject = "SANCTION FEE";
  $mail->Body = "Hi ".$fname.". You Have following Sanction Fees to pay on your student organization. Please Log in your account to the system for further details regarding your penalty.";
  $mail->send();
    

} else {
    $res_message = "Cannot Insert Data";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
