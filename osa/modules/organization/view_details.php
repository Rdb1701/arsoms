<?php
include("../../../app/database.php");

$organization_id  = mysqli_real_escape_string($db, trim($_POST['organization_id']));
$data        = array();

$org_name = "";
$address  = "";
$email    = "";
$number   = "";
$type     = "";
$isActive = "";
$date_inserted = "";

$query = "
SELECT org.*, us.fname, us.lname
FROM tbl_organization as org
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    $temp_arr = array();
    $res_success = 1;
    while ($row = mysqli_fetch_assoc($result)) {

        $active = "";
        if ($row['isActive'] == 0) {
            $active = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';
        }
        if ($row['isActive'] == 1) {
            $active = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Active</span>';
        }

        $org_name        = $row['org_name'];
        $address         = $row['address'];
        $email           = $row['email'];
        $fname           = $row['fname'];
        $lname           = $row['lname'];
        $number          = $row['number'];
        $type            = $row['type'];
        $isActive        = $active;
        $date_inserted   = date('F d,Y', strtotime($row['date_inserted']));
    }

}

$data['organization_id'] = $organization_id;
$data['org_name']        = $org_name;
$data['address']         = $address;
$data['email']           = $email;
$data['fname']           = $fname;
$data['lname']           = $lname;
$data['number']          = $number;
$data['type']            = $type;
$data['date_inserted']   = $date_inserted;
$data['active']   = $isActive;


echo json_encode($data);

?>