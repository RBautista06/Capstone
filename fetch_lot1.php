<?php
include "dbconnection.php"; // Assuming this file contains database connection code

if (isset($_GET['io_id'])) {
    $io_id = $_GET['io_id'];

    $sql = "SELECT LOT1 FROM owners WHERE IO_ID = :io_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':io_id', $io_id, PDO::PARAM_INT); // Assuming IO_ID is an integer, adjust if necessary
    $stmt->execute();

    $lot1 = $stmt->fetchColumn();

    if ($lot1) {
        echo $lot1;
    } else {
        echo "No LOT1 found for IO_ID: $io_id";
    }
} else {
    echo "Error: IO_ID parameter is missing.";
}
?>