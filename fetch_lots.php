<?php
// Include your database connection file
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['location_id'])) {
    $locationId = $_POST['location_id'];
    
    // Query to get TYPE_OF_LOT and LOT1 through LOT24
    $query = "SELECT TYPE_OF_LOT, LOT1, LOT2, LOT3, LOT4, LOT5, LOT6, LOT7, LOT8, LOT9, LOT10, LOT11, LOT12, LOT13, LOT14, LOT15, LOT16, LOT17, LOT18, LOT19, LOT20, LOT21, LOT22, LOT23, LOT24
              FROM owners 
              WHERE IO_ID = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('s', $locationId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No data found.']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Query preparation failed.']);
    }

    $conn->close();
}
?>
