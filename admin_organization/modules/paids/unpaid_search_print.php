<?php


$year_level_s   = mysqli_real_escape_string($db, trim($_GET['year_level']));
$rso_s          = mysqli_real_escape_string($db, trim($_GET['rso']));
$event_s        = mysqli_real_escape_string($db, trim($_GET['event']));


$payments    = array();
$data        = array();
$fee         = "";
$year_level  = "";
$event       = "";
$date_of_event = "";
$org_name       = "";
$due_date = "";

$query = "
SELECT pay.*, ev.event_desc, stud.fname, stud.lname, ev.event_date, ev.last_event_date, stud.year_level, org.org_name
FROM tbl_payment as pay 
LEFT JOIN tbl_events as ev ON ev.event_id = pay.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = ev.organization_id
LEFT JOIN tbl_students as stud ON stud.student_id = pay.student_id
LEFT JOIN tbl_users as us ON us.user_id = org.user_id
WHERE (pay.status = '0' AND org.user_id = '".$_SESSION['admin_org']['user_id']."')
AND stud.year_level = '$year_level_s' AND ev.event_id = '$event_s'
ORDER BY stud.lname ASC
";

$result = mysqli_query($db, $query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $status= "";
      if($row['status'] == 0){
          $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Unpaid</span>';
      }
      if($row['status'] == 1){
          $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Paid</span>';
      }
      if($row['status'] == 2){
          $status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Sanctioned</span>';
      }

      $temp_arr['payment_id']    = $row['payment_id'];
      $temp_arr['fname']         = $row['fname'];
      $temp_arr['lname']         = $row['lname'];
      $fee                       = $row['fee'];
      $year_level                = $row['year_level'];
      $event                     = $row['event_desc'];
      $org_name                     = $row['org_name'];
      $temp_arr['status']        = $status;
      $temp_arr['date_inserted'] = date('F d,Y', strtotime($row['date_inserted']));
      $temp_arr['event_date']        = date('F d', strtotime($row['event_date']));
      $temp_arr['last_event_date']   = date('d, Y', strtotime($row['last_event_date']));
      $date_of_event = date('F d', strtotime($row['event_date'])). '-' . date('d, Y', strtotime($row['last_event_date']));
      $temp_arr['date_receipt']  = $row['date_receipt'];
      $due_date                  = date('F d,Y', strtotime($row['due_date']));


        // For the contatanation of the qr/bar code
        $q   = substr($row['date_receipt'],0,4);
        $w   = substr($row['date_receipt'],5,-12);
        $e   = substr($row['date_receipt'],8,-9);
        $r   = substr($row['date_receipt'],11,-6);
        $t   = substr($row['date_receipt'],14,-3);
        $y   = substr($row['date_receipt'],-2);
    
        // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
        $concatqr =$r.$t.$y;

        $temp_arr['concatqr'] = $concatqr;
 

      
      $payments[] = $temp_arr;
    }
}

?>