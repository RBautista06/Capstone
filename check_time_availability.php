<?php
include 'dbconnection.php';
if (isset($_POST['date'])) {
    $selected_date = $_POST['date'];
    $query = $conn->prepare("
        SELECT TIME AS TIME FROM interment_forms WHERE DATE_OF_INTERMENT = ?
        UNION
        SELECT TIME_OF_TRANSFER AS TIME FROM transfer_of_rights WHERE DATE_OF_TRANSFER = ?
    ");
    $query->bind_param("ss", $selected_date, $selected_date);
    $query->execute();
    $result = $query->get_result();
    $reserved_times = array();
    while ($row = $result->fetch_assoc()) {
        $reserved_times[] = $row['TIME'];
    }
    echo json_encode($reserved_times);
}
