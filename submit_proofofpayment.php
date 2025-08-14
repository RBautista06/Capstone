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
        // Create a query to insert the data into proof_of_payments table
        $query = "INSERT INTO proof_of_payments (STATUS, PAYMENT_NUMBER, INTERMENT_ORDER, PREPARED_BY, REFERENCE_NUMBER) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }
        $status = 'pending';
        $stmt->bind_param("siiss", $status, $payment_number, $interment_order, $prepared_by, $reference_number);
        $stmt->execute();

        // Get the ID of the inserted record
        $proof_id = $stmt->insert_id;
        $stmt->close();

        // Create directory for the file
        $target_dir = "proofofpayment/$proof_id/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Save the file in the directory
        $file_name = $proof_id . '.' . pathinfo($_FILES['proof_image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES['proof_image']['tmp_name'], $target_file);

        // Update the record with the file path in proof_of_payments table
        $query = "UPDATE proof_of_payments SET FILE_PATH = ? WHERE PROOF_ID = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }
        $stmt->bind_param("si", $target_file, $proof_id);
        $stmt->execute();
        $stmt->close();

        // Update the status in payment_interment table
        $updateQuery = "UPDATE payment_interment SET STATUS = 'submitted' WHERE PAYMENT_ID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        if (!$updateStmt) {
            echo "Error preparing update statement: " . $conn->error;
            exit;
        }
        $updateStmt->bind_param("i", $payment_number);
        $updateStmt->execute();
        $updateStmt->close();

        ?>
        <script>
            alert("Proof of Payment Submitted Successfully!!");
            window.location.href = "customermap.php?Id=<?php echo $account_id; ?>"; 
        </script>
        <?php
    } else {
        echo "Error uploading file.";
    }
}
?>
