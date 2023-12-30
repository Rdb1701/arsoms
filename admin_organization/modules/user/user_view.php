<?php
include("../../../app/database.php");

$payments = array();
$data = array();

$query = "
SELECT us.* 
FROM tbl_users as us
WHERE admin_org_id = '".$_SESSION['admin_org']['user_id']."' 
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $gender_status = "";
      if ($row['gender'] == 0) {
        $gender_status = '<span class="text-dark " style="padding: 3px 8px; border-radius: 5px;">Female</span>';
    }
      if ($row['gender'] == 1) {
          $gender_status = '<span class="text-dark " style="padding: 3px 8px; border-radius: 5px;">Male</span>';
      }

      $temp_arr['user_id']       = $row['user_id'];
      $temp_arr['username']      = $row['username'];
      $temp_arr['fname']         = $row['fname'];
      $temp_arr['lname']         = $row['lname'];
      $temp_arr['gender']        = $gender_status;
      $temp_arr['email']         = $row['email'];

      
      $payments[] = $temp_arr;
    }
}

foreach($payments as $key => $value){

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-primary' title='Edit User'  onclick='edit_user(".$value['user_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
    <button class = 'btn btn-success' title='Edit'  onclick='member_change(".$value['user_id'].",\"".$value['username']."\")'><i class='fa fa-key'></i></button>&nbsp;
    <button class = 'btn btn-danger' title='Delete'  onclick='delete_user(".$value['user_id'].")'><i class='fa fa-trash'></i></button>&nbsp;
    </div>
  </td>
    ";

    $data['data'][] = array($value['username'],$value['fname'].' '.$value['lname'],$value['gender'],$value['email'],$button);
  }
  
  echo json_encode($data);
?>