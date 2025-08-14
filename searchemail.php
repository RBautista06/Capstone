<?php
include "dbconnection.php";

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Changed the SQL query to directly filter by the 'Visitor' position
    $sql = "SELECT EMAIL FROM tbl_accounts WHERE POSITION = 'Visitor' AND EMAIL LIKE ?";
    
    // Append wildcard at the end to match emails starting with the search term
    $searchTerm = $searchTerm . '%';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchTerm); // Bind search term with wildcard
} else {
    // Return an empty array if no search term is provided
    echo json_encode([]);
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

// Return JSON-encoded data
echo json_encode($data);
?>
