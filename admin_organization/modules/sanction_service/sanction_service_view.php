<?php
include("../../../app/database.php");

$payments = array();
$data = array();

$query = "
SELECT pay.*, ev.event_desc, stud.fname, stud.lname, ev.event_date, ev.last_event_date, stud.year_level
FROM tbl_sanction_services as pay 
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_students as stud ON stud.student_id = pay.student_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER BY stud.lname
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $status= "";
      if($row['status'] == 0){
          $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';
      }
      if($row['status'] == 1){
          $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Done</span>';
      }


      $temp_arr['service_id']    = $row['service_id'];
      $temp_arr['fname']         = $row['fname'];
      $temp_arr['lname']         = $row['lname'];
      $temp_arr['service']           = $row['service'];
      $temp_arr['event_desc']    = $row['event_desc'];
      $temp_arr['year_level']    = $row['year_level'];
      $temp_arr['remarks']       = $row['remarks'];
      $temp_arr['status']        = $status;
      $temp_arr['date_inserted'] = date('F d,Y', strtotime($row['date_inserted']));
      
      $payments[] = $temp_arr;
    }
}

foreach($payments as $key => $value){

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-success' title='Done Service'  onclick='send_receipt(".$value['service_id'].")'><i class='fa fa-check'></i></button>&nbsp;
    <button class = 'btn btn-danger' title='Delete'  onclick='delete_payment(".$value['service_id'].")'><i class='fa fa-trash'></i></button>&nbsp;
    </div>
  </td>
    ";

    $data['data'][] = array($value['fname'].' '.$value['lname'],$value['year_level'],$value['event_desc'],$value['service'],$value['status'],$value['remarks'],$button);
  }
  
  echo json_encode($data);
?>