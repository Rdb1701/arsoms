<?php
include("../../../app/database.php");

$profile = array();
$data = array();

$query = "
SELECT prof.*, org.org_name
FROM tbl_organization_profile as prof
LEFT JOIN tbl_organization as org ON org.organization_id = prof.organization_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER BY prof.organization_id ASC
";


$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();


    $temp_arr['profile_id']            = $row['profile_id'];
    $temp_arr['organization_id']       = $row['organization_id'];
    $temp_arr['org_name']              = $row['org_name'];
    $temp_arr['description']           = $row['description'];
    $temp_arr['mission']               = $row['mission'];
    $temp_arr['vision']                = $row['vision'];
    $temp_arr['goals']                 = $row['goals'];
    // $temp_arr['accomplishment_file']   = $row['accomplishment_file'];
    // $temp_arr['reports_file']          = $row['reports_file'];

    $profile[] = $temp_arr;

}

}


foreach($profile as $key => $value){

    $button_files = "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-warning'  title='Report Files' onclick='files_open_report(".$value['organization_id'].")'><i class='fa fa-file'></i></button>&nbsp;
    <button class = 'btn btn-success'  title='Accomplishment Files' onclick='files_open(".$value['organization_id'].")'><i class='fa fa-file-video'></i></button>
    </div>
  </td>";

     $button= "
     <td class='text-center'>
     <div class='d-flex justify-content-center order-actions'>
     <button class = 'btn btn-success' title='Edit'  onclick='edit_officer(".$value['organization_id'].")'><i class='fa fa-users'></i></button>&nbsp;
     <button class = 'btn btn-primary' title='Edit'  onclick='edit_profile(".$value['profile_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
     <button class = 'btn btn-danger'  title='Delete' onclick='delete_profile(".$value['profile_id'].",".$value['organization_id'].")'><i class='fa fa-trash'></i></button>
     </div>
   </td>
     ";

     $data['data'][] = array($value['org_name'], $value['description'],$button_files,$button);
   }
   
  echo json_encode($data);
