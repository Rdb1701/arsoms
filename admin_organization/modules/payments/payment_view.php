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
WHERE pay.status = '0' and org.user_id = '".$_SESSION['admin_org']['user_id']."'
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

      $year_level = "";

      if($row['year_level'] == 1){
        $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">1st Year</span>';
    }
    if($row['year_level'] == 2){
        $year_level = '<span class=" text-dark" style="padding: 3px 8px; border-radius: 5px;">2nd Year</span>';
    }
    if($row['year_level'] == 3){
      $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">3rd Year</span>';
    }
    if($row['year_level'] == 4){
      $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">4th Year</span>';
    }

      $temp_arr['payment_id']    = $row['payment_id'];
      $temp_arr['fname']         = $row['fname'];
      $temp_arr['lname']         = $row['lname'];
      $temp_arr['fee']           = $row['fee'];
      $temp_arr['event_desc']    = $row['event_desc'];
      $temp_arr['year_level']    = $year_level;
      $temp_arr['status']        = $status;
      $temp_arr['date_inserted'] = date('F d,Y', strtotime($row['date_inserted']));
      $temp_arr['due_date']         = date('F d,Y', strtotime($row['due_date']));
      $temp_arr['event_date']       = date('F d', strtotime($row['event_date']));
      $temp_arr['last_event_date']  = date('d, Y', strtotime($row['last_event_date']));
      
      $payments[] = $temp_arr;
    }
}

foreach($payments as $key => $value){

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-success' title='Send Receipt'  onclick='send_receipt(".$value['payment_id'].")'><i class='fa fa-receipt'></i></button>&nbsp;
    <button class = 'btn btn-danger' title='Delete'  onclick='delete_payment(".$value['payment_id'].")'><i class='fa fa-trash'></i></button>&nbsp;
    </div>
  </td>
    ";

    $data['data'][] = array($value['fname'].' '.$value['lname'],$value['year_level'],$value['event_desc'],$value['event_date'].' - '.$value['last_event_date'],$value['due_date'],'₱ '.$value['fee'],$value['status'],$button);
  }
  
  echo json_encode($data);
?>