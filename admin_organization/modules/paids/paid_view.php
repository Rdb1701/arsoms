<?php
include("../../../app/database.php");

$payments = array();
$data = array();

$query = "
SELECT pay.*, ev.event_desc, stud.fname, stud.lname, ev.event_date, ev.last_event_date, stud.year_level
FROM tbl_payment as pay 
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_students as stud ON stud.student_id = pay.student_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE (pay.status = '1' OR pay.status = '3') AND org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER BY stud.lname
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $status= "";
      if($row['status'] == 0){
          $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Unpaid</span>';
      }
      if($row['status'] == 1){
          $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Paid</span>';
      }
      if($row['status'] == 2){
          $status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Sanctioned</span>';
      }

      $temp_arr['payment_id']    = $row['payment_id'];
      $temp_arr['fname']         = $row['fname'];
      $temp_arr['lname']         = $row['lname'];
      $temp_arr['fee']           = $row['fee'];
      $temp_arr['year_level']    = $row['year_level'];
      $temp_arr['event_desc']    = $row['event_desc'];
      $temp_arr['status']        = $status;
      $temp_arr['date_inserted'] = date('F d,Y', strtotime($row['date_inserted']));
      $temp_arr['event_date']        = date('F d', strtotime($row['event_date']));
      $temp_arr['last_event_date']   = date('d, Y', strtotime($row['last_event_date']));
      $temp_arr['date_receipt']  = $row['date_receipt'];
      
      $payments[] = $temp_arr;
    }
}

foreach($payments as $key => $value){

       // For the contatanation of the qr/bar code
       $q   = substr($value['date_receipt'],0,4);
       $w   = substr($value['date_receipt'],5,-12);
       $e   = substr($value['date_receipt'],8,-9);
       $r   = substr($value['date_receipt'],11,-6);
       $t   = substr($value['date_receipt'],14,-3);
       $y   = substr($value['date_receipt'],-2);
   
       // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
       $concatqr =$r.$t.$y;


    $data['data'][] = array($value['fname'].' '.$value['lname'],$value['year_level'],$value['event_desc'],'₱ '.$value['fee'],$value['event_date'].' - '.$value['last_event_date'],$concatqr);
  }
  
  echo json_encode($data);
?>