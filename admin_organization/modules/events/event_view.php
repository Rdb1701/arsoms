<?php
include("../../../app/database.php");

$events = array();

$query = "
SELECT ev.*, org.org_name, org.user_id
FROM tbl_events as ev
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."'
ORDER BY ev.event_date DESC
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

    $temp_arr['event_id']          = $row['event_id'];
    $temp_arr['event_desc']        = $row['event_desc'];
    $temp_arr['org_name']          = $row['org_name'];
    $temp_arr['expenses']          = $row['expenses'];
    $temp_arr['event_date']        = date('F d', strtotime($row['event_date']));
    $temp_arr['last_event_date']   = date('d, Y', strtotime($row['last_event_date']));
    $temp_arr['date_inserted']     = date('F d,Y', strtotime($row['date_inserted']));
    $temp_arr['isActive']          = $active;

    $events[] = $temp_arr;

}

}


foreach($events as $key => $value){

    $button1 = '';
    if($value['isActive'] == '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Active</span>'){
        $button1 = " <button class = 'btn btn-warning'  title='Inactive' onclick='inactive_event(".$value['event_id'].")'><i class='fa fa-times'></i></button>";
    }else{
        $button1 = " <button class = 'btn btn-success'  title='Active' onclick='active_event(".$value['event_id'].")'><i class='fa fa-check'></i></button>";
    }

     $button= "
     <td class='text-center'>
     <div class='d-flex justify-content-center order-actions'>
     <button class = 'btn btn-primary' title='Edit'  onclick='edit_event(".$value['event_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
     $button1
     </div>
   </td>
     ";

     $data['data'][] = array($value['event_desc'], $value['org_name'],$value['event_date'].' - '.$value['last_event_date'],'₱ '.$value['expenses'],$value['isActive'],$button);
   }
   
   echo json_encode($data);



?>