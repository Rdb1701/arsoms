<?php
include("../../../app/database.php");

include '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$data_1 = array();
$res_success = 0;
$res_message = '';

$organization_id  = mysqli_real_escape_string($db, trim($_POST['organization_id']));


$fileName = $_FILES['excel_1']['name'];
$file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

$allowed_ext = ['xls','csv','xlsx'];

if(in_array($file_ext, $allowed_ext))
{
    $inputFileNamePath = $_FILES['excel_1']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
    $data = $spreadsheet->getActiveSheet()->toArray();
    
    $count = "0";

    foreach($data as $row)
    {
    if($count > 0)
    {
        $username   = $row['0'];
        $fname      = $row['1'];
        $lname      = $row['2'];
        $gender     = $row['3'];
        $year_level = $row['4'];
        $email      = $row['5'];


        $query_0 = "
        SELECT stud.*, ext.*
        FROM tbl_students as stud
        LEFT JOIN tbl_students_exists as ext ON ext.student_id_number = stud.username
        WHERE stud.username = '$username'
        AND ext.organization_id = '$organization_id'
        ";

        $result_1 = mysqli_query($db, $query_0);

        if (!mysqli_num_rows($result_1)) {
        
        $query_1 = "
        SELECT * FROM tbl_students as stud
        WHERE username = '$username'
        ";
        $result = mysqli_query($db, $query_1);

        if (!mysqli_num_rows($result)) {

        $query = "INSERT INTO tbl_students(
            username,
            password,
            fname,
            lname,
            gender,
            year_level,
            email,
            isActive)VALUES(
            '$username',
            '".md5($username)."',
            '$fname',
            '$lname',
            '$gender',
            '$year_level',
            '$email',
            '1')
            ";

            if(mysqli_query($db,$query)){
                $res_success = 1;

                $query_exists ="INSERT INTO tbl_students_exists(
                    student_id_number,
                    organization_id,
                    date_inserted
                    )VALUES(
                    '$username',
                    '$organization_id',
                    '".date("Y-m-d H:i:s")."'
                    )";
                
                   mysqli_query($db, $query_exists);

              }else{
                $res_success = 0;
              }
        }else{
            $query_exists ="INSERT INTO tbl_students_exists(
                student_id_number,
                organization_id,
                date_inserted
                )VALUES(
                '$username',
                '$organization_id',
                '".date("Y-m-d H:i:s")."'
                )";
            
               mysqli_query($db, $query_exists);
              $res_success = 1;
        }
    }else{
        $res_success = 2;
    }
        //IF COUNT
        }else{
            $count = "1";
        }
    //FOREACH
    }

}

echo $res_success;



