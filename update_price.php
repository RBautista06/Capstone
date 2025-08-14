<?php
include "dbconnection.php";

$serviceId = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$weekdays = $_POST['weekdays'];
$weekends = $_POST['weekends'];

// Sanitize the input
$serviceId = mysqli_real_escape_string($conn, $serviceId);
$name = mysqli_real_escape_string($conn, $name);
$price = mysqli_real_escape_string($conn, $price);
$weekdays = mysqli_real_escape_string($conn, $weekdays);
$weekends = mysqli_real_escape_string($conn, $weekends);

$sql = "UPDATE interment_price 
        SET NAME = '$name', PRICE = '$price', WEEKDAYS = '$weekdays', WEEKENDS = '$weekends' 
        WHERE ID = '$serviceId'";

if (mysqli_query($conn, $sql)) {
    echo "Price updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
