<?php
include("../../../app/database.php");

$announcements = array();

$query = "
SELECT ann.*, org.org_name, org.user_id
FROM tbl_announcement as ann
LEFT JOIN tbl_organization as org ON org.organization_id = ann.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER BY org.org_name ASC
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

    $temp_arr['announcement_id']   = $row['announcement_id'];
    $temp_arr['announcement_desc'] = $row['announcement_desc'];
    $temp_arr['org_name']          = $row['org_name'];
    $temp_arr['title']             = $row['title'];
    $temp_arr['date_inserted']     = date('F d,Y', strtotime($row['date_inserted']));
    $temp_arr['photo']             = $row['photo'];


    $announcements[] = $temp_arr;

    }
}  

foreach($announcements as $key => $value){

    $image = "<img src='announcements/uploads/".$value['photo']."' alt='No Photo' width='70px'>";

    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class = 'btn btn-warning' title='Upload Photo'  onclick='announcement_upload(".$value['announcement_id'].")'><i class='fa fa-upload'></i></button>&nbsp;
    <button class = 'btn btn-primary' title='Edit'  onclick='edit_announcement(".$value['announcement_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
    <button class = 'btn btn-danger'  title='Delete' onclick='delete_announcement(".$value['announcement_id'].")'><i class='fa fa-trash'></i></button>
    </div>
  </td>
    ";

    $data['data'][] = array($image,$value['title'],$value['announcement_desc'], $value['org_name'],$value['date_inserted'],$button);
  }
  
  echo json_encode($data);

?>