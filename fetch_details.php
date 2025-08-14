<?php
include "dbconnection.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['INTERMENTFORM_ID'])) {
    $intermentFormId = $_GET['INTERMENTFORM_ID'];

    // Prepare the SQL statement
    $sql = "SELECT INTERMENTFORM_ID, FIRSTNAME, MIDDLENAME, LASTNAME, DATE_OF_DEATH, LOCATION_ID 
            FROM interment_forms
            WHERE INTERMENTFORM_ID = ? AND STATUS = 'Mark as Done'";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(array('error' => 'Prepare failed: ' . $conn->error));
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param("s", $intermentFormId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $locationId = $row['LOCATION_ID'];

        // Fetch corresponding LOT1 from owners table
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

        $data[] = $row;
    }

    $stmt->close();
    $stmtLot->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No INTERMENTFORM_ID provided.'));
}
?>
