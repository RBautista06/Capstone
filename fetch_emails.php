<?php
include "dbconnection.php";
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $conn->prepare("SELECT EMAIL FROM tbl_accounts WHERE POSITION = 'Lot Owner' AND EMAIL LIKE ? LIMIT 10");
    $search = $query . '%';
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $emails = [];
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['EMAIL'];
    }
    echo json_encode($emails);
}
?>
