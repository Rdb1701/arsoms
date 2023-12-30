<?php
include("../../../app/database.php");
require_once("../../../assets/libraries/tcpdf/tcpdf.php");

$payments     = array();
$payment_id   = mysqli_real_escape_string($db, trim($_GET['receipt_number']));
$fname        = '';
$lname        = '';
$qr_image     = '';
$reference_no = '';
$year_level   = '';
$fee          = '';
$logo         = '';
$org_name         = '';
$event        = '';
$event_date   = '';
$last_event_date = '';
$date_receipt = '';
$concatqr     = '';

$query = "
SELECT pay.*, stud.fname, stud.lname, stud.year_level, ev.event_desc, ev.event_date, ev.last_event_date, org.logo, org.org_name
FROM tbl_payment as pay
LEFT JOIN tbl_students as stud ON stud.student_id = pay.student_id
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
WHERE pay.payment_id = '$payment_id'
";

$result = mysqli_query($db, $query) or die ('Error in Inserting users in '. $query);

if (mysqli_num_rows($result) > 0) {
   $row = mysqli_fetch_array($result);

   $fname        =  $row['fname'];
   $lname        = $row['lname'];
   $reference_no = $row['date_receipt'];
   $year_level   = $row['year_level'];
   $fee          = $row['fee'];
   $logo         = $row['logo'];
   $org_name     = $row['org_name'];
   $qr_image     = $row['qr_image'];
   $event        = $row['event_desc'];
   $event_date        = date('F d', strtotime($row['event_date']));
   $last_event_date   = date('d, Y', strtotime($row['last_event_date']));


   $q   =  substr("$reference_no", 0, 4);
   $w   =  substr("$reference_no", 5, -12);
   $e   =  substr("$reference_no", 8, -9);
   $r   =  substr("$reference_no", 11, -6);
   $t   =  substr("$reference_no", 14, -3);
   $y   =  substr("$reference_no", -2);
   // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
   $concatqr = $r . $t . $y;

    }

 

// ===================== PDF =====================
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OSA');
$pdf->SetTitle('Receipt');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(50, 50, 60);

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

<p></p>

<br>

</div>

<table border="1" style=" padding: 5px;">
<tr>
<th colspan="1" style="font-size: 15px; padding: 10%; text-align: center;  font-weight: bold;">STUDENT ORGANIZATION RECEIPT</th>
</tr>
<tr>
<th colspan="1" style="font-size: 15px; padding: 10%; text-align: center; font-weight: bold;"><img src="../../../admin_organization/modules/organization/logo/'.$logo.'" style="margin: 0; padding: 0; line-height: 0; width: 300%;"><br><b><span>'.$org_name.'</span></b></th>
</tr>
<tr style="border: 1px solid black;">
    <th style="font-size: 15px; padding: 10%;"><b><img src="../../../admin_organization/modules/payments/qr_images/'.$qr_image.'" style="margin: 0; padding: 0; line-height: 0;"></b><br><b>Invoice No: </b><b style="color:red;">'.$concatqr.'</b><br><br><b> Name:</b> '.$fname.' '.$lname.'<br>==================================<br><b> Year Level:</b> '.$year_level.'<br>==================================<br><b> Event Name: </b>'.$event.'<br>==================================<br><b> Date of Event:</b> '.$event_date.' - '.$last_event_date.'<br>==================================<br><b> Fees: </b> P'.$fee.'<br>==================================</th>

</tr>
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
$pdf->Output('student_receipt.pdf', 'I');

?>

