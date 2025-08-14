<?php
include "dbconnection.php";
$query = "SELECT LOT1, LOT2, LOT3, LOT4, LOT5, LOT6, LOT7, LOT8, LOT9, LOT10, LOT11, LOT12,
                 LOT13, LOT14, LOT15, LOT16, LOT17, LOT18, LOT19, LOT20, LOT21, LOT22, LOT23, LOT24
          FROM owners";
$result = $conn->query($query);
$takenLots = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        for ($i = 1; $i <= 24; $i++) {
            $lot = $row['LOT' . $i];
            if (!empty($lot)) {
                $takenLots[] = $lot;
            }
        }
    }
}
echo json_encode($takenLots);
$conn->close();
?>
