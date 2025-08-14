<?php
include "dbconnection.php";

if (isset($_GET['location_id'])) {
    $location_id = intval($_GET['location_id']); // Ensure it's an integer

    // Prepare and execute the query to fetch lots
    $query = $conn->prepare("SELECT * FROM owners WHERE IO_ID = ?");
    if (!$query) {
        die(json_encode(['error' => 'Error preparing query: ' . $conn->error]));
    }
    $query->bind_param("i", $location_id);
    $query->execute();
    $result = $query->get_result();
    if (!$result) {
        die(json_encode(['error' => 'Error executing query: ' . $conn->error]));
    }

    // Fetch all lots
    $all_lots = [];
    while ($row = $result->fetch_assoc()) {
        for ($i = 1; $i <= 24; $i++) {
            $lot_column = "LOT" . $i;
            if (!empty($row[$lot_column])) {
                $all_lots[] = $row[$lot_column];
            }
        }
    }

    // Return the lots as JSON
    echo json_encode($all_lots);
} else {
    echo json_encode(['error' => 'No location_id provided']);
}
?>
