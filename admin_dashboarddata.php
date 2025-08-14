<?php
include "dbconnection.php";
$year = '2024';
$intermentData = array_fill(0, 12, 0);
$torData = array_fill(0, 12, 0);
$sqlInterment = "SELECT TOTAL_PRICE, DATE_OF_INTERMENT FROM interment_forms WHERE STATUS = 'Mark as done' AND YEAR(DATE_OF_INTERMENT) = '$year'";
$resultInterment = mysqli_query($conn, $sqlInterment);
while ($row = mysqli_fetch_assoc($resultInterment)) {

    $month = (int)date('n', strtotime($row['DATE_OF_INTERMENT'])) - 1;
    $price = (float)str_replace(',', '', $row['TOTAL_PRICE']);
    $intermentData[$month] += $price;
}
$sqlTor = "SELECT TOTAL_PRICE, DATE_OF_TRANSFER FROM transfer_of_rights WHERE YEAR(DATE_OF_TRANSFER) = '$year'";
$resultTor = mysqli_query($conn, $sqlTor);
while ($row = mysqli_fetch_assoc($resultTor)) {
    $month = (int)date('n', strtotime($row['DATE_OF_TRANSFER'])) - 1; // 0-based index for months
    $price = (float)str_replace(',', '', $row['TOTAL_PRICE']);
    $torData[$month] += $price;
}
$response = [
    'intermentPrices' => $intermentData,
    'torPrices' => $torData,
];
echo json_encode($response);
?>
