<?php
include("../../../app/database.php");
require_once("../../../assets/libraries/tcpdf/tcpdf.php");

$count_paid = '';
$sum_pay    = '';
// $count_sanction = '';
// $sum_sanction = '';


$query = "
SELECT COUNT(*) FROM tbl_payment as pay
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE pay.status = '1' AND org.user_id = '".$_SESSION['admin_org']['user_id']."'
";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($row = mysqli_fetch_array($result)) {
  $count_paid =  $row[0];
}


//SUM PAIDS
$query_sum = "
SELECT SUM(fee) FROM tbl_payment as pay
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE pay.status = '1' AND org.user_id = '".$_SESSION['admin_org']['user_id']."'
";
$result_sum = mysqli_query($db, $query_sum) or die(mysqli_error($db));
while ($row = mysqli_fetch_array($result_sum)) {

  $sum_pay =  $row[0];
}

// //COUNT SANCTION
// $query = "
// SELECT COUNT(*) FROM tbl_payment
// WHERE status = '3'
// ";

// $result = mysqli_query($db, $query) or die(mysqli_error($db));
// while ($row = mysqli_fetch_array($result)) {
//   $count_sanction =  $row[0];
// }

// //SUM SANCTION
// $query_sum = "
// SELECT SUM(fee) FROM tbl_payment
// WHERE status = '3'
// ";
// $result_sum = mysqli_query($db, $query_sum) or die(mysqli_error($db));
// while ($row = mysqli_fetch_array($result_sum)) {

//   $sum_sanction =  $row[0];
// }


$dateToday = date("M j, Y", strtotime(date("Y-m-d")));

// ===================== PDF =====================
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Collections');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 5, 5);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

$d_html = '
<div>
<p style="margin: 0; padding: 0; text-align: center; line-height: 0;">
<img src="../../../assets/images/logo.png"></p><br><br>
<h1 style="margin: 0; padding: 0; text-align: center; line-height: 0;">COLLECTION FEES</h1>
<p></p>
<br>
</div>
<table style="width: 50%; font-size: 12px;">
  <tr>
    <td colspan="2"><b>FILTERS:</b></td>
  </tr>
     <tr>
     <td>Date:</td>
          <td><b>'.$dateToday.'</b></td>
     </tr>
 
';

$d_html .='
</table>
<br><br>';

$d_html .= '

<table border="1" style=" padding: 5px;">
        <tr style="border: 1px solid black;">
        <th class="text-center" style = "text-align: center;"><b>No. of Students</b></th>
        <th class="text-center" style = "text-align: center;"><b>Total Collected</b></th>
        </tr>
';


$d_html .= '
        <tr>
        <td style = "text-align: center;">'.$count_paid. '</td>

';

if($sum_pay == ''){
  $d_html .= '
<td style = "text-align: center;">0</td>
</tr>
';
}else{
  $d_html .= '
  <td style = "text-align: center;">P '.$sum_pay.'</td>
  
  </tr>
  ';
}


$d_html .= '               
        </table>
';

// Set some content to print
$html = <<<EOD

$d_html

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Paid Collections.pdf', 'I');



?>