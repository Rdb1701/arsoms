<?php
include("../../../app/database.php");

$organization = array();
$data = array();

$query = "
SELECT * FROM tbl_organization
WHERE user_id = '".$_SESSION['admin_org']['user_id']."'
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
    $temp_arr['remarks_reject']       = $row['remarks_reject'];
    $temp_arr['CBL']                  = $row['CBL'];
    $temp_arr['list_activities']      = $row['list_activities'];
    $temp_arr['roster']               = $row['roster'];
    $temp_arr['type']                 = $row['type'];
    $temp_arr['logo']                = $row['logo'];
    $temp_arr['isActive']             = $active;
    $temp_arr['status']               = $status;
    $temp_arr['date_inserted']        = date('F d,Y', strtotime($row['date_inserted']));

    $organization[] = $temp_arr;
 }
}

foreach($organization as $key => $value){

    //DISABLE DELETE BUTTON IF ACCEPTED
    $delete_button = '';
    if($value['status'] == '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Accepted</span>'){
        $delete_button = "<button class = 'btn btn-danger'  title='Delete' onclick='delete_org(".$value['organization_id'].")' disabled><i class='fa fa-trash'></i></button>";
    }else{
        $delete_button = " <button class = 'btn btn-danger'  title='Delete' onclick='delete_org(".$value['organization_id'].")'><i class='fa fa-trash'></i></button>";
    }

    //REJECT BUTTON
    $reject_button = '';
    if($value['remarks_reject'] != 'Accredited' && $value['remarks_reject'] != 'Pending...' ){
        $reject_button = "<button class = 'btn btn-danger'  title='Show Remarks' onclick='remarks_org(".$value['organization_id'].")'><i class='fa fa-exclamation'></i></button>";
    }else{
        $reject_button = $value['remarks_reject'];
    }

    //BUTTON FOR DETAILES AND DOCUMENT
     $button_details = "
     <button class = 'btn btn-warning' title='View' onclick='view_details(".$value['organization_id'].")'><i class='fa fa-eye'></i></button>&nbsp;
     ";
     $button_documents = "
     <button class = 'btn btn-warning' title='View Documents' onclick='file_documents(".$value['organization_id'].",\"".$value['intent_letter']."\",\"".$value['request_letter']."\",\"".$value['form_membership']."\",\"".$value['CBL']."\",\"".$value['list_activities']."\",\"".$value['roster']."\")'><i class='fa fa-file'></i></button>&nbsp;
     ";

     //ACTION BUTTONS
      $button= "
      <td class='text-center'>
      <div class='d-flex justify-content-center order-actions'>
      <button class = 'btn btn-success' title='Upload Logo' onclick='logo_upload(".$value['organization_id'].")'><i class='fa fa-image'></i></button>&nbsp;
      <button class = 'btn btn-warning' title='File Upload' onclick='file_upload(".$value['organization_id'].")'><i class='fa fa-upload'></i></button>&nbsp;
      <button class = 'btn btn-primary' title='Edit'  onclick='edit_org(".$value['organization_id'].")'><i class='fa fa-edit'></i></button>&nbsp;
      $delete_button
      </div>
    </td>
      ";

      $image = "<img src='organization/logo/".$value['logo']."' alt='No Photo' width='70px'>";

      $data['data'][] = array($image,$value['org_name'], $button_details,$button_documents,$value['date_inserted'],$value['status'],$reject_button,$button);
    }
    
    echo json_encode($data);

?>