<?php
include("../../../app/database.php");

$organization_id  = mysqli_real_escape_string($db, trim($_POST['logo_id']));
var_dump($organization_id);


if(isset($_FILES['logo_file']['name'])){
   $data = array();
   $res_success = 0;
    /* Getting file name */
    $filename = $_FILES['logo_file']['name'];
 

    /* Location */
    $location = "logo/";
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
       if(move_uploaded_file($_FILES['logo_file']['tmp_name'],$location.$newname)){
          $response = $newname;
        
          $query="
            UPDATE tbl_organization
            SET
            logo         = '$response'
            WHERE organization_id = '$organization_id'
            ";
            
          if(mysqli_query($db,$query)){
            $res_success = 1;
          }else{
            $res_success = 2;
          }
                
       }
    }
    
  

    echo $response;
    exit;
 }

 echo 0;




?>
