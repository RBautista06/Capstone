<?php
include 'dbconnection.php';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$response = [];
if ($email) {
    $stmt = $conn->prepare("SELECT FIRSTNAME, MIDDLENAME, LASTNAME FROM tbl_accounts WHERE EMAIL = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    $stmt->close();
}
$conn->close();
echo json_encode($response);
?>
