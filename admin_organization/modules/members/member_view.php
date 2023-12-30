<?php
include("../../../app/database.php");

$students = array();
$data = array();

$query = "
SELECT ext.*, stud.*, org.org_name, org.organization_id as org_id
FROM tbl_students_exists as ext
LEFT JOIN tbl_students as stud ON stud.username = ext.student_id_number
LEFT JOIN tbl_organization as org ON org.organization_id = ext.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER by stud.lname
";


$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

    $active = "";
    if($row['isActive'] == 0){
        $active = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';
    }
    if($row['isActive'] == 1){
        $active = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Active</span>';
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


    $temp_arr['student_id']  = $row['student_id'];
    $temp_arr['organization_id']  = $row['org_id'];
    $temp_arr['username']    = $row['username'];
    $temp_arr['org_name']    = $row['org_name'];
    $temp_arr['lname']       = $row['lname'];
    $temp_arr['fname']       = $row['fname'];
    $temp_arr['gender']      = $row['gender'];
    $temp_arr['email']       = $row['email'];
    $temp_arr['year_level']  = $year_level;
    $temp_arr['active']      = $active;

    $students[] = $temp_arr;

}

}


foreach($students as $key => $value){

     $button= "
     <td class='text-center'>
     <div class='d-flex justify-content-center order-actions'>
     <button class = 'btn btn-primary' title='Edit'  onclick='edit_member(".$value['student_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
     <button class = 'btn btn-success' title='Edit'  onclick='member_change(".$value['student_id'].",\"".$value['username']."\")'><i class='fa fa-key'></i></button>&nbsp;
     <button class = 'btn btn-danger'  title='Delete' onclick='delete_member(".$value['organization_id'].",\"".$value['username']."\")'><i class='fa fa-trash'></i></button>
     </div>
   </td>
     ";

     $data['data'][] = array($value['username'], $value['fname'].' '.$value['lname'],$value['org_name'],$value['gender'],$value['year_level'], $value['email'],$button);
   }
   
   echo json_encode($data);
