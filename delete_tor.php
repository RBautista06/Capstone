<?php
include "dbconnection.php";

if (isset($_GET['interment_id'])) {
    $interment_id = intval($_GET['interment_id']);
    $account_id = intval($_GET['account_id']);

    // Delete the record from the interment_forms table
    $sql = "DELETE FROM transfer_of_rights WHERE ID = $interment_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to the original page after deletion
        header("Location: customer_declinedtor.php?Id=" . $account_id);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
