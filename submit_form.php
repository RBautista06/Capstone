<?php
session_start();
include "dbconnection.php";
function sanitizeFileName($fileName) {
    return preg_replace("/[^A-Za-z0-9_\-\.]/", '', $fileName);
}
$error_message = ""; // Initialize an empty error message variable
// Check if there are any records in the interment_data table
$sql_check = "SELECT COUNT(*) AS count FROM internment_data";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();
$count = $row_check['count'];
// If there are no records, insert a default record with ID 1
if ($count == 0) {
    $sql_insert_default = "INSERT INTO internment_data (id) VALUES (1)";
    if ($conn->query($sql_insert_default) !== TRUE) {
        $error_message = "Error inserting default record: " . $conn->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deceased_name = $conn->real_escape_string($_POST['deceased_name']);
    $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
    $date_of_death = $conn->real_escape_string($_POST['date_of_death']);
    $age_at_death = $conn->real_escape_string($_POST['age_at_death']);
    $remains_type = $conn->real_escape_string($_POST['remains_type']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']);
    if (isset($_GET['Id'])) {
        $customer_id = $conn->real_escape_string($_GET['Id']);
        $sql = "SELECT NAME FROM tbl_accounts WHERE ACCOUNT_ID = '$customer_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customerName = $row["NAME"];
        } else {
            $error_message = "Customer not found";
        }
    } else {
        $error_message = "Customer ID not found in URL";
    }
    // Insert a new record into the interment_data table to get its ID
    $sql_insert = "INSERT INTO internment_data (customer_id, customer_name, deceased_name, date_of_birth, date_of_death, age_at_death, remains_type, payment_method)
                    VALUES ('$customer_id', '$customerName', '$deceased_name', '$date_of_birth', '$date_of_death', '$age_at_death', '$remains_type', '$payment_method')";
    if ($conn->query($sql_insert) === TRUE) {
        $interment_id = $conn->insert_id; // Get the ID of the inserted record
    } else {
        $error_message = "Error inserting record: " . $conn->error;
    }
    $uploadedFileNames = array();
    foreach ($_FILES as $key => $file) {
        if ($key === 'burial_permit_picture') {
            $uploadDirectory = "intermentfiles/burialpermits/";
        } elseif ($key === 'death_certificate_picture') {
            $uploadDirectory = "intermentfiles/deathcertificate/";
        } elseif ($key === 'owner_rep_id_picture') {
            $uploadDirectory = "intermentfiles/ownerid/";
        } else {
            continue;
        }
        $fileName = sanitizeFileName($file['name']);
        // Append customer ID, customer name, and interment ID to the filename
        $fileName = $customer_id . "_" . $customerName . "_" . $interment_id . "_" . $fileName;
        $filePath = $uploadDirectory . $fileName;
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $uploadedFileNames[$key] = $fileName;
        } else {
            $error_message = "Error uploading file: " . $fileName;
        }
    }
    if (empty($error_message)) {
        // Update the record in the interment_data table with the filenames
        $sql_update = "UPDATE internment_data
                        SET burial_permit = '{$uploadedFileNames['burial_permit_picture']}',
                            death_certificate = '{$uploadedFileNames['death_certificate_picture']}',
                            owner_id = '{$uploadedFileNames['owner_rep_id_picture']}'
                        WHERE id = $interment_id";
        if ($conn->query($sql_update) === TRUE) {
            // Successful submission alert
            echo "<script>alert('Form submitted successfully');</script>";
            // Redirect to the form page
            echo "<script>window.location.href = 'intermentform.php?Id=$customer_id';</script>";
            exit();
        } else {
            $error_message = "Error updating record: " . $conn->error;
        }
    }
}
$conn->close();
// If an error occurs, display the error message using JavaScript alert
if (!empty($error_message)) {
    echo "<script>alert('$error_message');</script>";
}
?>
