<?php
include("../../../app/database.php");

$organization_id  = mysqli_real_escape_string($db, trim($_POST['organization_id']));


if(isset($_FILES['add_file_roster']['name'])){
   $data = array();
   $res_success = 0;
    /* Getting file name */
    $filename = $_FILES['add_file_roster']['name'];
 

    /* Location */
    $location = "uploads/";
    $FileType = pathinfo($filename,PATHINFO_EXTENSION);
    $FileType = strtolower($FileType);

    //rename
      $rename = md5($filename);
      $newname = $rename.'.'.$FileType;

    /* Valid extensions */
    $valid_extensions = array("jpg","jpeg","png","pdf","docx");

    $response = 0;
    /* Check file extension */
    if(in_array(strtolower($FileType), $valid_extensions)) {
       /* Upload file */
       if(move_uploaded_file($_FILES['add_file_roster']['tmp_name'],$location.$newname)){
          $response = $newname;
            $res_success = 1;
          $query="
            UPDATE tbl_organization
            SET
            roster      = '$response'
            WHERE organization_id = '$organization_id'
            ";
          mysqli_query($db,$query);
          
       }
    }
    

    echo $response;
    exit;
 }

 echo 0;




?>
