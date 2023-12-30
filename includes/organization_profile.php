<?php

$organization_profile = array();
    $query = "
        SELECT prof.*, org.*, org.date_inserted as date_logo, us.fname, us.lname
        FROM tbl_organization_profile as prof
        LEFT JOIN tbl_organization as org ON org.organization_id = prof.organization_id
        LEFT JOIN tbl_users as us ON us.user_id = org.user_id
        WHERE prof.organization_id = '$organization_id'
        ";

    $result = mysqli_query($db, $query);
    $numRows = $result->num_rows;

    if ($numRows > 0) {
        while ($row = $result->fetch_assoc()) {
            $temp_arr = array();


            $temp_arr['profile_id']            = $row['profile_id'];
            $temp_arr['fname']                 = $row['fname'];
            $temp_arr['lname']                 = $row['lname'];
            $temp_arr['description']           = $row['description'];
            $temp_arr['logo']                  = $row['logo'];
            $temp_arr['mission']               = $row['mission'];
            $temp_arr['vision']                = $row['vision'];
            $temp_arr['goals']                 = $row['goals'];
            $temp_arr['date_logo']             = date('F d,Y', strtotime($row['date_logo']));

            $temp_arr['organization_id']      = $row['organization_id'];
            $temp_arr['org_name']             = $row['org_name'];
            $temp_arr['address']              = $row['address'];
            $temp_arr['email']                = $row['email'];
            $temp_arr['number']               = $row['number'];
            $temp_arr['intent_letter']        = $row['intent_letter'];
            $temp_arr['request_letter']       = $row['request_letter'];
            $temp_arr['form_membership']      = $row['form_membership'];
            $temp_arr['remarks_reject']       = $row['remarks_reject'];
            $temp_arr['CBL']                  = $row['CBL'];
            $temp_arr['list_activities']      = $row['list_activities'];   
            $temp_arr['type']                 = $row['type'];
            $temp_arr['logo']                 = $row['logo'];
            // $temp_arr['accomplishment_file']   = $row['accomplishment_file'];
            // $temp_arr['reports_file']          = $row['reports_file'];

            $organization_profile[] = $temp_arr;
        }
    }


    ?>