<?php
include "dbconnection.php";
$polygonId = $_GET['id'];
$polygonId = $conn->real_escape_string($polygonId);
$sql = "SELECT IO_ID AS location_id, LOT1
        FROM owners
        WHERE LOT1 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $polygonId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$locationId = $row['location_id'];
$lot1 = $row['LOT1'];
$stmt->close();
if ($locationId) {
    $sql = "SELECT CONCAT(FIRSTNAME, ' ', MIDDLENAME, ' ', LASTNAME) AS name,
                   DATE_OF_DEATH AS date_of_death,
                   LOCATION_ID AS grave_location,
                   REMAINS_TYPE AS remains_type,
                   ? AS lot1
            FROM interment_forms
            WHERE LOCATION_ID = ? AND STATUS = 'Mark as Done'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $lot1, $locationId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    $stmt->close();
} else {
    header('Content-Type: application/json');
    echo json_encode(array());
}
$conn->close();
?>
