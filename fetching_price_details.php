<?php
include "dbconnection.php";
$serviceId = $_GET['id'];
// Sanitize the input
$serviceId = $conn->real_escape_string($serviceId);
$sql = "SELECT * FROM interment_price WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $serviceId);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
header('Content-Type: application/json');
echo json_encode($data);
$stmt->close();
$conn->close();
?>
