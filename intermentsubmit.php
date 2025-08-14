<?php
include "dbconnection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from $_POST array
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $dateOfBirth = $_POST['dateborn'];
    $dateOfDeath = $_POST['datedeath'];
    $age = $_POST['age'];
    $dateOfInterment = $_POST['dateinterment'];
    $dayOfInterment = $_POST['dayinterment'];
    $timeOfInterment = $_POST['timeinterment'];
    $remainsType = $_POST['remains'];
    $VAULTType = $_POST['vaultype'];
    $locationId = $_POST['location'];
    $intermentOption = $_POST['typeoption'];
    $dayservice = $_POST['weekday'];
    $funeralService = $_POST['funeral'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $epitaph = $_POST['epitaph'];
    $specialInstruction = $_POST['special'];
    $tentRentalNum = $_POST['tentQuantity'];
    $chairRentalNum = $_POST['chairQuantity'];
    $paymentOption = $_POST['paymentOption'];
    $chairPrice = 15 * $chairRentalNum;
    $tentPrice = 1000 * $tentRentalNum;
    // Fetch interment price from the database based on VAULTType
    $sqlPrice = "SELECT PRICE FROM interment_price WHERE NAME = '$VAULTType'";
    $resultPrice = $conn->query($sqlPrice);
    if ($resultPrice && $resultPrice->num_rows > 0) {
        $row = $resultPrice->fetch_assoc();
        $intermentPrice = floatval(str_replace(',', '', $row['PRICE'])); // Remove commas from the price
    } else {
        // Handle if price not found for the given VAULTType
        $intermentPrice = 0; // Set default price or handle error as needed
    }
    $totalPrice = $chairPrice + $tentPrice + $intermentPrice;
    // Convert totalPrice to the appropriate format before insertion
    $totalPriceFormatted = number_format($totalPrice, 2, '.', ',');
    session_start();
    $accountId = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
    // Determine the file inputs based on the remains type
    switch ($remainsType) {
        case 'Adult Fresh Body':
        case 'Infant Fresh Body':
        case 'Children Fresh Body':
        case 'URN':
            $fileInputs = ['file1', 'file2', 'file3', 'file4', 'file5'];
            break;
        case 'Bone':
            $fileInputs = ['file1', 'file2', 'file3', 'file4', 'file5', 'file6'];
            break;
        case 'Exhumation':
            $fileInputs = ['file1', 'file2', 'file3'];
            break;
        default:
            $fileInputs = ['file1', 'file2', 'file3', 'file4', 'file5', 'file6'];
            break;
    }
    // Construct the list of columns and values for the INSERT INTO statement
    $columns = "STATUS,ACCOUNT_ID, LASTNAME, FIRSTNAME, MIDDLENAME, DATE_OF_BIRTH, DATE_OF_DEATH, AGE, DATE_OF_INTERMENT,
                DAY_OF_INTERMENT, DAYOFWEEK, TIME, REMAINS_TYPE, VAULT_TYPE, LOCATION_ID, INTERMENT_OPTION,
                FUNERAL_SERVICE, LENGTH, WIDTH, HEIGHT, EPITAPH, SPECIAL_INSTRUCTIONS, TENTRENTALNUM, CHAIRRENTALNUM,
                INTERMENT_PRICE, CHAIR_PRICE, TENT_PRICE, PAYMENT_OPTION, TOTAL_PRICE";
    $values = "'Pending','$accountId', '$lastname', '$firstname', '$middlename', '$dateOfBirth', '$dateOfDeath', '$age',
               '$dateOfInterment', '$dayOfInterment', '$dayservice', '$timeOfInterment', '$remainsType', '$VAULTType',
               '$locationId', '$intermentOption', '$funeralService', '$length', '$width', '$height', '$epitaph',
               '$specialInstruction', '$tentRentalNum', '$chairRentalNum', '$intermentPrice', '$chairPrice',
               '$tentPrice', '$paymentOption', '$totalPriceFormatted'";
    // Add file input values to the columns and values list
    foreach ($fileInputs as $fileInput) {
        $fileName = isset($_FILES[$fileInput]['name']) ? $_FILES[$fileInput]['name'] : 'NONE';
        if ($fileName !== 'NONE') {
            $file_extension = pathinfo($fileName, PATHINFO_EXTENSION);
            ${$fileInput . '_new_name'} = $fileInput . '_' . uniqid() . '.' . $file_extension;
            $columns .= ", $fileInput";
            $values .= ", '" . ${$fileInput . '_new_name'} . "'";
        } else {
            $columns .= ", $fileInput";
            $values .= ", 'NONE'";
        }
    }
    // Construct the SQL query
    $sql = "INSERT INTO interment_forms ($columns) VALUES ($values)";
    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        $insertedId = $conn->insert_id;
        $directory = "intermentproposals/" . $insertedId;
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true)) {
                die('Failed to create directories...');
            }
        }
        // Move uploaded files to the directory
        foreach ($fileInputs as $index => $fileInput) {
            if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == UPLOAD_ERR_OK) {
                move_uploaded_file($_FILES[$fileInput]['tmp_name'], $directory . "/" . ${$fileInput . '_new_name'});
            }
        }
        echo '<script>alert("Interment Form Submitted Successfully!"); window.location.href = "intermentform.php?Id=' . $accountId . '";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
