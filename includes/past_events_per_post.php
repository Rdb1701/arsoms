<?php

$past_events = array();

$query = "
SELECT ev.*, org.org_name
FROM tbl_events as ev
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
WHERE (ev.isActive = '1' AND (ev.event_date < '".date("Y-m-d H:i:s")."')) AND ev.organization_id = '$organization_id'
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
    $temp_arr['event_date']        = date('F d', strtotime($row['event_date']));
    $temp_arr['last_event_date']   = date('d, Y', strtotime($row['last_event_date']));
    $temp_arr['date_inserted']     = date('F d,Y', strtotime($row['date_inserted']));
    $temp_arr['event_date_compare']  = date('d', strtotime($row['event_date']));
    $temp_arr['isActive']          = $active;

    $past_events[] = $temp_arr;

}

}



?>