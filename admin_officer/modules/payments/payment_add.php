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
$students         = array();
$organization_id  = '';


// $query_event = "
// SELECT * FROM tbl_payment
// WHERE event_id = '$event' AND status = '0'
// ";
// $result = mysqli_query($db, $query_event);

// if (!mysqli_num_rows($result)) {

//EVENT VIEW
$query = "
SELECT * FROM tbl_events
WHERE event_id = '$event'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);
  $organization_id =  $row['organization_id'];

}

//GET student_id
$query = "
SELECT * FROM tbl_students
WHERE organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $temp_arr['student_id'] = $row['student_id'];
      $temp_arr['email'] = $row['email'];
      $temp_arr['fname'] = $row['fname'];

      $students[] = $temp_arr;

    }
}else{
  $res_message = "No Members in that organization";
}

foreach($students as $key => $value){

    //INSERT ALL STUDENT WITH THE SPECIFIC EVENT
    $insert_query = "
    INSERT INTO tbl_payment(
    event_id,
    student_id,
    fee,
    status,
    date_inserted
    )VALUES(
    '$event',
    '".$value['student_id']."',
    '$fee',
    '0',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if(mysqli_query($db, $insert_query)){
        $res_success = 1;

    }else{
        $res_message = "Failed Query";
    }
}

// }else{
//   $res_message = "Students Already Have Obligation Fees";
// }


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
  foreach($students as $stud){
  $mail->addAddress($stud['email']);
  }
  
  $mail->isHTML(true);
  $mail->Subject = "EVENT OBLIGATION FEES";
  $mail->Body = "Hi. You Have following Obligation Fees to pay on your student organization. Please Log in your account to the system for further details on the fees";
  $mail->send();

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>