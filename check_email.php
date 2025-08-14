<?php
include "dbconnection.php";

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $stmt = $conn->prepare("SELECT CONTACT, NAME FROM tbl_accounts WHERE POSITION = 'Lot Owner' AND EMAIL = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo json_encode([
            'exists' => true,
            'name' => $row['NAME'], // Include the name if the email exists
            'contact' => $row['CONTACT'] // Include the name if the email exists
        ]);
    } else {
        echo json_encode(['exists' => false]);
    }
}
?>
