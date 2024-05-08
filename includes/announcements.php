<?php

$announcements = array();

$query = "
SELECT ann.*, org.org_name 
FROM tbl_announcement as ann
LEFT JOIN tbl_organization as org ON org.organization_id = ann.organization_id 
WHERE org.status != 3
ORDER BY ann.date_inserted DESC
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['title']             = $row['title'];
    $temp_arr['announcement_desc'] = $row['announcement_desc'];
    $temp_arr['date_inserted']     = date('F d,Y', strtotime($row['date_inserted']));
    $temp_arr['date_created']      = date('Y-m-d', strtotime($row['date_inserted']));
    $temp_arr['photo']             = $row['photo'];
    $temp_arr['org_name']          = $row['org_name'];

    $announcements[] = $temp_arr;
  }
}
?>
