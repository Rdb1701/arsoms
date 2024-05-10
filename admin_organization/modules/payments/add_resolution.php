<?php
include("../../../app/database.php");


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape form data
    $organization_id    = mysqli_real_escape_string($db, $_POST['add_organization']);
    $event_id           = mysqli_real_escape_string($db, $_POST['add_event']);
    $file_name          = mysqli_real_escape_string($db, $_FILES['add_file']['name']);
    $file_tmp           = $_FILES['add_file']['tmp_name'];
    $file_destination   = 'uploads/' . $file_name; // Destination folder for file upload

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($file_tmp, $file_destination)) {
        // Insert data into the database
        $sql = "INSERT INTO tbl_resolution (event_id, filename)
                VALUES ('$event_id', '$file_name')";
        if (mysqli_query($db, $sql)) {
            echo "Successfully Added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    } else {
        echo "Failed to upload file.";
    }
}

?>