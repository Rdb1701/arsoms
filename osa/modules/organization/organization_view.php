<?php
include("../../../app/database.php");

$organization = array();

$query = "
SELECT * FROM tbl_organization
ORDER by org_name ASC
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
        $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Accepted</span>';
    }
    if($row['status'] == 2){
        $status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Rejected</span>';
    }

    $active = "";
    if($row['isActive'] == 0){
        $active = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';
    }
    if($row['isActive'] == 1){
        $active = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Active</span>';
    }

    $temp_arr['organization_id']      = $row['organization_id'];
    $temp_arr['org_name']             = $row['org_name'];
    $temp_arr['address']              = $row['address'];
    $temp_arr['email']                = $row['email'];
    $temp_arr['number']               = $row['number'];
    $temp_arr['intent_letter']        = $row['intent_letter'];
    $temp_arr['request_letter']       = $row['request_letter'];
    $temp_arr['form_membership']      = $row['form_membership'];
    $temp_arr['CBL']                  = $row['CBL'];
    $temp_arr['type']                 = $row['type'];
    $temp_arr['isActive']             = $active;
    $temp_arr['status']               = $status;
    $temp_arr['date_inserted']        = date('F d,Y', strtotime($row['date_inserted']));

    $organization[] = $temp_arr;
 }
}

foreach($organization as $key => $value){

    //BUTTON FOR DETAILES AND DOCUMENT
     $button_details = "
     <button class = 'btn btn-warning' title='View' onclick='view_details(".$value['organization_id'].")'><i class='fa fa-eye'></i></button>&nbsp;
     ";
     $button_documents = "
     <button class = 'btn btn-warning' title='View Documents' onclick='file_documents(".$value['organization_id'].",\"".$value['intent_letter']."\",\"".$value['request_letter']."\",\"".$value['form_membership']."\",\"".$value['CBL']."\")'><i class='fa fa-file'></i></button>&nbsp;
     ";

     //ACTION BUTTONS
      $button= "
      <td class='text-center'>
      <div class='d-flex justify-content-center order-actions'>
      <button class = 'btn btn-success' title='Approve' onclick='accept_organization(".$value['organization_id'].",\"".$value['email']."\")'><i class='fa fa-check'></i></button>&nbsp;
      <button class = 'btn btn-secondary' title='Reject' onclick='reject_organization(".$value['organization_id'].",\"".$value['email']."\")'><i class='fa fa-times'></i></button>&nbsp;
      <button class = 'btn btn-danger' title='Remove' onclick='delete_org(".$value['organization_id'].",\"".$value['email']."\")'><i class='fa fa-trash'></i></button>&nbsp;
      </div>
    </td>
      ";

      $data['data'][] = array($value['org_name'], $button_details,$button_documents,$value['date_inserted'],$value['status'],$button);
    }
    
    echo json_encode($data);

?>