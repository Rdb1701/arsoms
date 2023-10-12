<?php
include("../../../app/database.php");

$res_success = 0;
$res_message = '';
$data        = array();

$remarks   = array();
$remark_id = '';

$organization_id = mysqli_real_escape_string($db, trim($_POST['organization_id']));

$query= "
SELECT remarks_reject FROM tbl_organization
WHERE organization_id = '$organization_id'

";
$result = mysqli_query($db,$query);
if (mysqli_num_rows($result) > 0) {
 while($row = mysqli_fetch_assoc($result)){
        $res_success = 1;
      
    $remarks = $row['remarks_reject'];

}
    }else{
        $res_message = "Query Failed";
    }
  
    $convert = nl2br($remarks);

    $data['remark_desc']  = $convert;
    $data['organization_id'] = $organization_id;
    $data['remarks']      = $remarks;
    $data['res_success']  = $res_success;
    $data['res_message']  = $res_message;

    echo json_encode($data);

?>