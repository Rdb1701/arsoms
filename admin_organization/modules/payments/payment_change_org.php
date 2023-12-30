<?php
include("../../../app/database.php");

$organization_id =  mysqli_real_escape_string($db, $_POST['organization_id']);

$query = "SELECT ev.event_id, org.organization_id, ev.event_desc, org.org_name FROM tbl_events as ev
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '".$_SESSION['admin_org']['user_id']."' AND ev.isActive = '1'";
$result= mysqli_query($db,$query)or die ('Error in'. $query);

$html = '<option value="">&nbsp;</option>';
if($organization_id != "") {
    $html = '';
    while($row = mysqli_fetch_array($result)) {
        $html .= "<option value='".$row['event_id']."'>".$row['event_desc']."</option>";
    }
}

echo $html;



?>