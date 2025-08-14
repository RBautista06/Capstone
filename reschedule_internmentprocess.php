<?php
include 'dbconnection.php'; // Include your database connection file
$interment_id = $_POST['interment_id'];
$totalprice = $_POST['totalprice'];
$dayinweek = $_POST['dayinweek'];
$dateinterment = $_POST['dateinterment'];
$dayinterment = $_POST['dayinterment'];
$timeinterment = $_POST['timeinterment'];
$status = 'reschedule payment'; // Status to be updated
// Start transaction
$conn->begin_transaction();
try {
    // Prepare the SQL query for the interment_forms table
    $sql1 = "UPDATE interment_forms
            SET
                TOTAL_PRICE='$totalprice',
                DAYOFWEEK='$dayinweek',
                DATE_OF_INTERMENT='$dateinterment',
                DAY_OF_INTERMENT='$dayinterment',
                TIME='$timeinterment',
                STATUS='$status'
            WHERE INTERMENTFORM_ID='$interment_id'";
    // Execute the first query
    if ($conn->query($sql1) !== TRUE) {
        throw new Exception("Error updating interment_forms: " . $conn->error);
    }
    // Prepare the SQL query for the proof_of_payments table
    $sql2 = "UPDATE proof_of_payments
            SET
                STATUS='$status'
            WHERE INTERMENT_ORDER='$interment_id'";
    // Execute the second query
    if ($conn->query($sql2) !== TRUE) {
        throw new Exception("Error updating proof_of_payments: " . $conn->error);
    }
    // Prepare the SQL query for the payment_interment table
    $sql3 = "UPDATE payment_interment
            SET
                STATUS='$status'
            WHERE INTERMENT_ID='$interment_id'";
    // Execute the third query
    if ($conn->query($sql3) !== TRUE) {
        throw new Exception("Error updating payment_interment: " . $conn->error);
    }
    // If all updates are successful, commit the transaction
    $conn->commit();
    $response['success'] = true;
    $response['message'] = "Internment and payment status updated successfully";
    $response['redirect'] = "frontdesk_calendar.php?Id=" . urlencode($_POST['account_id']); // Redirect URL
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $conn->rollback();
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}
$conn->close();
echo json_encode($response);
?>
