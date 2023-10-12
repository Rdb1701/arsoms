<?php
include("../../../app/database.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../../assets/libraries/PHPMailer/src/Exception.php';
require '../../../assets/libraries/PHPMailer/src/PHPMailer.php';
require '../../../assets/libraries/PHPMailer/src/SMTP.php';

$organization_id  = mysqli_real_escape_string($db, trim($_POST['organization_id']));
$email          = mysqli_real_escape_string($db, trim($_POST['email']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
DELETE FROM tbl_organization
WHERE organization_id = '$organization_id'
";

if($db->query($query)){
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
        $mail->Body = "Your Student Organization Application has been removed by OSA";
        $mail->send();

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  