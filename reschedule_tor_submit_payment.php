<?php
// Include your database connection
include "dbconnection.php";
$account_id = isset($_GET['account_id']) ? intval($_GET['account_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $payment_number = $_POST['payment_number'];
    $interment_order = $_POST['interment_order'];
    $prepared_by = $_POST['prepared_by'];
    $reference_number = $_POST['reference_number'];

    // Handle file upload
    if (isset($_FILES['proof_image']) && $_FILES['proof_image']['error'] == 0) {

        // Check if the payment record exists
        $query = "SELECT PROOF_ID FROM tor_proof_of_payments WHERE PAYMENT_NUMBER = '$payment_number'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $proof_id = $row['PROOF_ID'];

            // Create directory for the file if it doesn't exist
            $target_dir = "proofofpayment/$proof_id/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Save the new file with the prefix 'reference_'
            $file_extension = pathinfo($_FILES['proof_image']['name'], PATHINFO_EXTENSION);
            $new_file_name = "reference_" . $proof_id . '.' . $file_extension;
            $target_file = $target_dir . $new_file_name;
            move_uploaded_file($_FILES['proof_image']['tmp_name'], $target_file);

            // Update proof_of_payments with the new reference number and file path
            $update_query = "UPDATE tor_proof_of_payments 
                             SET RESCHEDULE_REFERENCE = '$reference_number', 
                                 RESCHEDULE_FILE = '$target_file',
                                 STATUS = 'reschedule payment'
                             WHERE PROOF_ID = '$proof_id'
                             ";
            $conn->query($update_query);

            // Update the status in payment_interment table
            $update_payment_query = "UPDATE payment_tor SET STATUS = 'submitted' WHERE ID = '$payment_number'";
            $conn->query($update_payment_query);

            ?>
            <script>
                alert("Proof of Payment For Rescheduling Submitted Successfully!!");
                window.location.href = "customermap.php?Id=<?php echo $account_id; ?>"; 
            </script>
            <?php
        } else {
            echo "Payment record not found.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
