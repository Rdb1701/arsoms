<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

//QR CODE
require '../../../assets/libraries/phpqrcode/qrlib.php';


extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
UPDATE tbl_payment
SET
status = '1',
date_receipt = '".date("Y-m-d H:i:s")."'
WHERE payment_id = '$payment_id'
";

if($db->query($query)){

    $res_success = 1;
     //GETTING QR CODE
     $reference_no = date("Y-m-d H:i:s");


     $q   =  substr("$reference_no", 0, 4);
     $w   =  substr("$reference_no", 5, -12);
     $e   =  substr("$reference_no", 8, -9);
     $r   =  substr("$reference_no", 11, -6);
     $t   =  substr("$reference_no", 14, -3);
     $y   =  substr("$reference_no", -2);
     // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
     $concatqr = $r . $t . $y;
 
     //----------------------------------------------GENERATING QR CODE----------------------------------------------------------->
     $tempDir = 'qr_images/';
     $codeContents =  $concatqr;
     // we need to generate filename somehow, 
     // with md5 or with database ID used to obtains $codeContents...
     $fileName = '005_file_' . md5($codeContents) . '.png';
 
     $pngAbsoluteFilePath = $fileName;
     $urlRelativeFilePath = $tempDir . $fileName;;
 
     // generating
     if (!file_exists($pngAbsoluteFilePath)) {
 
         //UPDATING FILE NAME
         $query = "UPDATE tbl_payment 
     SET
     qr_image = '$pngAbsoluteFilePath'
     WHERE payment_id = '$payment_id'
     ";
         mysqli_query($db, $query);
         QRcode::png($codeContents, $urlRelativeFilePath);
         $res_success = 1;
     } else {
         $res_message =  'File already generated! We can use this cached file to speed up site on common codes!';
         $res_message = '<hr />';
     }

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  