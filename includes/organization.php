<?php

$organization = array();

$query = "
SELECT org.*, us.fname, us.lname, prof.description
 FROM tbl_organization as org
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
LEFT JOIN tbl_organization_profile as prof ON prof.organization_id = org.organization_id
WHERE (org.status = 1 OR org.status = 4) AND org.status != 3
ORDER by org.date_inserted ASC
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
    $temp_arr['description']          = $row['description'];
    $temp_arr['roster']               = $row['roster'];
    $temp_arr['type']                 = $row['type'];
    $temp_arr['logo']                 = $row['logo'];
    $temp_arr['fname']                = $row['fname'];
    $temp_arr['lname']                = $row['lname'];
    $temp_arr['isActive']             = $active;
    $temp_arr['date_inserted']        = date('F d,Y', strtotime($row['date_inserted']));

    $organization[] = $temp_arr;

}

}



?>