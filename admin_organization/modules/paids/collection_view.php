<?php

$event_iid             = mysqli_real_escape_string($db, trim($_GET['event_id']));
$event_name           = "";
$org_description      = "";
$total_paid_payments  = "";
$num_students_paid    = "";
$unpaid_amount        = "";
$num_students_unpaid  = "";

$query = "
SELECT
e.event_id,
e.event_desc AS event_name,
SUM(CASE WHEN p.status = 1 THEN p.fee ELSE 0 END) AS total_paid_payments,
COUNT(DISTINCT CASE WHEN p.status = 1 THEN p.student_id END) AS num_students_paid,
SUM(CASE WHEN p.status <> 1 THEN p.fee ELSE 0 END) AS unpaid_amount,
COUNT(DISTINCT CASE WHEN p.status <> 1 THEN p.student_id END) AS num_students_unpaid,
org.org_name
FROM
tbl_events e
LEFT JOIN tbl_payment p ON e.event_id = p.event_id
LEFT JOIN tbl_organization as org ON org.organization_id = e.organization_id
WHERE p.event_id = '$event_iid'
GROUP BY
e.event_id, e.event_desc
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $event_name              = $row['event_name'];
  $org_description         = $row['org_name'];
  $total_paid_payments     = $row['total_paid_payments'];
  $num_students_paid       = $row['num_students_paid'];
  $unpaid_amount           = $row['unpaid_amount'];
  $num_students_unpaid     = $row['num_students_unpaid'];

}
?>