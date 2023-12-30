<?php
include("../../../app/database.php");


$organization_id   = mysqli_real_escape_string($db, trim($_POST['tvalue']));
$students = array();
$data = array();
$result1 = array();
$res_success = 0;
$res_message = " ";

$query = "
SELECT DISTINCT st.fname, st.lname, st.username, st.year_level, st.student_id
FROM tbl_students_exists as ste
LEFT JOIN tbl_students as st ON st.username = ste.student_id_number
WHERE ste.organization_id = '$organization_id'
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();
      $res_success = 1; 
      $year_level = "";

      if($row['year_level'] == 1){
        $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">1st Year</span>';
    }
    if($row['year_level'] == 2){
        $year_level = '<span class=" text-dark" style="padding: 3px 8px; border-radius: 5px;">2nd Year</span>';
    }
    if($row['year_level'] == 3){
      $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">3rd Year</span>';
    }
    if($row['year_level'] == 4){
      $year_level = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">4th Year</span>';
    }

      $temp_arr['student_id']    = $row['student_id'];
      $temp_arr['fname']         = $row['fname'];
      $temp_arr['lname']         = $row['lname'];
      $temp_arr['username']      = $row['username'];
      $temp_arr['year_level']    = $year_level;
   
      
      $students[] = $temp_arr;
    }
}


foreach ($students as $rows) {
    array_push($result1, $rows);  
} 


$data['student']      = $result1;
$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);
?>