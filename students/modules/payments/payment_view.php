<?php
include("../../../app/database.php");

$payments = array();
$data  = array();

$query = "
SELECT pay.*, ev.event_desc, stud.fname, stud.lname, ev.event_date, ev.last_event_date, stud.year_level, org.org_name
FROM tbl_payment as pay 
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_students as stud ON stud.student_id = pay.student_id
WHERE pay.student_id = '".$_SESSION['student']['student_id']."'
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
      if($row['status'] == 3){
        $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Paid</span>';
    }

      $temp_arr['payment_id']       = $row['payment_id'];
      $temp_arr['student_id']       = $row['student_id'];
      $temp_arr['fname']            = $row['fname'];
      $temp_arr['lname']            = $row['lname'];
      $temp_arr['org_name']         = $row['org_name'];
      $temp_arr['fee']              = $row['fee'];
      $temp_arr['event_desc']       = $row['event_desc'];
      $temp_arr['year_level']       = $row['year_level'];
      $temp_arr['sanction_remarks'] = $row['sanction_remarks'];
      $temp_arr['status']           = $status;
      $temp_arr['date_inserted']    = date('F d,Y', strtotime($row['date_inserted']));
      $temp_arr['event_date']       = date('F d', strtotime($row['event_date']));
      $temp_arr['last_event_date']  = date('d, Y', strtotime($row['last_event_date']));
      
      $payments[] = $temp_arr;
    }
}

foreach($payments as $key => $value){

    $remarks_sanction = "";

    if($value['status'] == '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Unpaid</span>'){
      $remarks_sanction = $value['sanction_remarks'];
    }else if($value['status'] == '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Paid</span>'){
      $remarks_sanction = "Paid";
    }else{
      $remarks_sanction = $value['sanction_remarks'];
    }
  

    //PRINT RECEIP BUTTON
    $button_print = "";
    if($value['status'] == '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Paid</span>'){
    $button_print = "<button class = 'btn btn-warning' title='Print Receipt'  onclick='send_receipt(".$value['payment_id'].")'><i class='fa fa-print'></i></button>&nbsp;";
    }else{
    $button_print = "<button class = 'btn btn-warning' title='Print Receipt'  onclick='send_receipt(".$value['payment_id'].")' disabled><i class='fa fa-print'></i></button>&nbsp;";
    }

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
   $button_print
    </div>
  </td>
    ";

    $data['data'][] = array($value['org_name'],$value['event_desc'],$value['event_date'].' - '.$value['last_event_date'],'₱ '.$value['fee'],$value['status'],$remarks_sanction,$button);
  }
  
  echo json_encode($data);
