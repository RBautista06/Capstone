<?php
header('Content-Type: application/json');

// Database connection
include "dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vaultype']) && isset($_POST['weekday'])) {
    $selectedVaultType = $_POST['vaultype'];
    $selectedWeekday = $_POST['weekday'];
    
    // Vault types that use weekend/weekday logic
    $specialVaultTypes = ['Oversize Vault', 'Adult Vault', 'Children Vault', 'Bone Vault', 'Infant Vault'];
    
    if (in_array($selectedVaultType, $specialVaultTypes)) {
        // Determine the correct column based on the weekday/weekend selection
        $priceColumn = $selectedWeekday === 'Weekends' ? 'WEEKENDS' : 'WEEKDAYS';
    } else {
        // Default column if no special logic is required
        $priceColumn = 'PRICE';
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT $priceColumn FROM interment_price WHERE NAME = ?");
    $stmt->bind_param("s", $selectedVaultType);
    $stmt->execute();
    $stmt->bind_result($price);

    // Fetch and return the result
    if ($stmt->fetch()) {
        echo json_encode(['price' => $price]);
    } else {
        echo json_encode(['error' => 'Price not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
