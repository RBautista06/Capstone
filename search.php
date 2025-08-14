<?php
include "dbconnection.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$data = array();
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'] . '%';
    $sql = "SELECT INTERMENTFORM_ID, FIRSTNAME, MIDDLENAME, LASTNAME, DATE_OF_DEATH, LOCATION_ID
            FROM interment_forms
            WHERE STATUS = 'Mark as Done'
            AND CONCAT(FIRSTNAME, ' ', MIDDLENAME, ' ', LASTNAME) LIKE ?";
} elseif (isset($_GET['FIRSTNAME'])) {
    $FIRSTNAME = $_GET['FIRSTNAME'];
    $sql = "SELECT INTERMENTFORM_ID, FIRSTNAME, MIDDLENAME, LASTNAME, DATE_OF_DEATH, LOCATION_ID
            FROM interment_forms
            WHERE STATUS = 'Mark as Done'
            AND CONCAT(FIRSTNAME, ' ', MIDDLENAME, ' ', LASTNAME) = ?";
} else {
    $sql = "SELECT INTERMENTFORM_ID, FIRSTNAME, MIDDLENAME, LASTNAME, DATE_OF_DEATH, LOCATION_ID
            FROM interment_forms
            WHERE STATUS = 'Mark as Done'";
}
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(array('error' => 'Prepare failed: ' . $conn->error));
    exit;
}
if (isset($_GET['search'])) {
    $stmt->bind_param("s", $searchTerm);
} elseif (isset($_GET['FIRSTNAME'])) {
    $stmt->bind_param("s", $FIRSTNAME);
}
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(array()); // Return an empty array if no results found
    exit;
}
while ($row = $result->fetch_assoc()) {
    $locationId = $row['LOCATION_ID'];
    $sqlLot = "SELECT LOT1 FROM owners WHERE IO_ID = ?";
    $stmtLot = $conn->prepare($sqlLot);
    if (!$stmtLot) {
        echo json_encode(array('error' => 'Prepare failed: ' . $conn->error));
        exit;
    }
    $stmtLot->bind_param("s", $locationId);
    $stmtLot->execute();
    $resultLot = $stmtLot->get_result();
    if ($lotRow = $resultLot->fetch_assoc()) {
        $row['LOT1'] = trim($lotRow['LOT1']);
    } else {
        $row['LOT1'] = null;
    }
    $stmtLot->close();
    $data[] = $row;
}
$stmt->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode($data);
?>
