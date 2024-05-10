<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../../assets/libraries/PHPMailer/src/Exception.php';
require '../../../assets/libraries/PHPMailer/src/PHPMailer.php';
require '../../../assets/libraries/PHPMailer/src/SMTP.php';

$event           =  mysqli_real_escape_string($db, $_POST['add_event_p']);
$sanction_fee    =  mysqli_real_escape_string($db, $_POST['add_fee_p']);
$add_remark      =  mysqli_real_escape_string($db, $_POST['add_remark']);

$s_id            =  $_POST['s_id'];


$res_success      = 0;
$res_message      = "";
$data             = array();
$students         = array();
$organization_id = "";

$query = "
SELECT * FROM tbl_events
WHERE event_id = '$event'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0 ){
    $row = $result->fetch_assoc();

    $organization_id = $row['organization_id'];
}else{
    $res_message = "No organization show";
}


//GET student_id
$query = "
SELECT stud.* 
FROM tbl_students as stud
LEFT JOIN tbl_students_exists as ext ON ext.student_id_number = stud.username
WHERE ext.organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $temp_arr['student_id'] = $row['student_id'];
      $temp_arr['email']      = $row['email'];
      $temp_arr['fname']      = $row['fname'];

      $students[] = $temp_arr;

    }
}else{
  $res_message = "No Members in that organization";
}

for($count = 0; $count < count($s_id); $count++)
{

    //INSERT ALL STUDENT WITH THE SPECIFIC EVENT
    $insert_query = "
    INSERT INTO tbl_sanction_services(
        event_id,
        student_id,
        service,
        remarks,
        status
        )VALUES(
        '$event',
        '".$s_id[$count]."',
        '$sanction_fee',
        '$add_remark',
        '0'
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
  $mail->Subject = "SANCTION FEE";
  $mail->Body = "Hi!. You Have following Sanction Fees to pay on your student organization. Please Log in your account to the system for further details regarding your penalty.";
  $mail->send();

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>