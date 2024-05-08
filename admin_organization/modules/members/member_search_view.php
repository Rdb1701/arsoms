<?php

$students = array();
$data = array();

$year_level        = mysqli_real_escape_string($db, trim($_GET['year_level']));
$rso               = mysqli_real_escape_string($db, trim($_GET['rso']));
$org_name          = "";
$year              = "";

$query = "
SELECT ext.*, stud.*, org.org_name, org.organization_id as org_id
FROM tbl_students_exists as ext
LEFT JOIN tbl_students as stud ON stud.username = ext.student_id_number
LEFT JOIN tbl_organization as org ON org.organization_id = ext.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE org.user_id = '" . $_SESSION['admin_org']['user_id'] . "'
AND stud.year_level = '$year_level'
AND org.organization_id = '$rso'
ORDER by stud.lname ASC
";


$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
        $temp_arr = array();

        $active = "";
        if ($row['isActive'] == 0) {
            $active = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';
        }
        if ($row['isActive'] == 1) {
            $active = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Active</span>';
        }

        $year_level = "";

        if ($row['year_level'] == 1) {
            $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">1st Year</span>';
        }
        if ($row['year_level'] == 2) {
            $year_level = '<span class=" text-dark" style="padding: 3px 8px; border-radius: 5px;">2nd Year</span>';
        }
        if ($row['year_level'] == 3) {
            $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">3rd Year</span>';
        }
        if ($row['year_level'] == 4) {
            $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">4th Year</span>';
        }


        $temp_arr['student_id']  = $row['student_id'];
        $temp_arr['organization_id']  = $row['org_id'];
        $temp_arr['username']    = $row['username'];
        $org_name                = $row['org_name'];
        $temp_arr['lname']       = $row['lname'];
        $temp_arr['fname']       = $row['fname'];
        $temp_arr['gender']      = $row['gender'];
        $temp_arr['email']       = $row['email'];
        $year                    = $year_level;
        $temp_arr['active']      = $active;

        $students[] = $temp_arr;
    }
}

?>
