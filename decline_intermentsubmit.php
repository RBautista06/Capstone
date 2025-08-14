<?php

include "dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve INTERMENTFORM_ID from URL
    $intermentId = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

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
    $totalPriceFormatted = number_format($totalPrice, 2, '.', ',');

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

    // Check if the record exists for the given intermentId
    $sqlCheck = "SELECT INTERMENTFORM_ID, ACCOUNT_ID FROM interment_forms WHERE INTERMENTFORM_ID = '$intermentId'";
    $resultCheck = $conn->query($sqlCheck);

    if ($resultCheck && $resultCheck->num_rows > 0) {
        // Record exists, get INTERMENTFORM_ID and ACCOUNT_ID
        $row = $resultCheck->fetch_assoc();
        $insertedId = $row['INTERMENTFORM_ID']; // Get the existing record ID
        $accountId = $row['ACCOUNT_ID']; // Get the ACCOUNT_ID

        // File upload handling
        $directory = "intermentproposals/" . $insertedId;
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true)) {
                die('Failed to create directories...');
            }
        }
        
        // Prepare file columns and their new file names
        $fileUpdates = [];
        foreach ($fileInputs as $fileInput) {
            if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == UPLOAD_ERR_OK) {
                $file_extension = pathinfo($_FILES[$fileInput]['name'], PATHINFO_EXTENSION);
                ${$fileInput . '_new_name'} = $fileInput . '_' . uniqid() . '.' . $file_extension;
                
                // Delete the existing file if it exists
                $existingFilePath = $directory . "/" . ${$fileInput . '_new_name'};
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath); // Delete the file
                }
        
                // Move the new file to the directory
                move_uploaded_file($_FILES[$fileInput]['tmp_name'], $existingFilePath);
                $fileUpdates[] = "$fileInput = '" . ${$fileInput . '_new_name'} . "'";
            }
        }
        // Construct the SQL update query
        $sqlUpdate = "UPDATE interment_forms SET 
            LASTNAME='$lastname', 
            FIRSTNAME='$firstname', 
            MIDDLENAME='$middlename', 
            DATE_OF_BIRTH='$dateOfBirth', 
            DATE_OF_DEATH='$dateOfDeath', 
            AGE='$age', 
            DATE_OF_INTERMENT='$dateOfInterment', 
            DAY_OF_INTERMENT='$dayOfInterment', 
            DAYOFWEEK='$dayservice', 
            TIME='$timeOfInterment', 
            REMAINS_TYPE='$remainsType', 
            VAULT_TYPE='$VAULTType', 
            LOCATION_ID='$locationId', 
            INTERMENT_OPTION='$intermentOption', 
            FUNERAL_SERVICE='$funeralService', 
            LENGTH='$length', 
            WIDTH='$width', 
            HEIGHT='$height', 
            EPITAPH='$epitaph', 
            SPECIAL_INSTRUCTIONS='$specialInstruction', 
            TENTRENTALNUM='$tentRentalNum', 
            CHAIRRENTALNUM='$chairRentalNum', 
            INTERMENT_PRICE='$intermentPrice', 
            CHAIR_PRICE='$chairPrice', 
            TENT_PRICE='$tentPrice', 
            PAYMENT_OPTION='$paymentOption', 
            TOTAL_PRICE='$totalPriceFormatted',
            STATUS='Pending'";
        
        // Add file updates to the query if there are any files uploaded
        if (!empty($fileUpdates)) {
            $sqlUpdate .= ", " . implode(", ", $fileUpdates);
        }

        $sqlUpdate .= " WHERE INTERMENTFORM_ID = '$intermentId'";

        if ($conn->query($sqlUpdate) === TRUE) {
            echo '<script>alert("Interment Form Updated and Submitted Successfully!");window.location.href="customer_declinedinterment.php?Id=' . $accountId . '";</script>';
        } else {
            echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
        }
        } else {
            echo '<script>alert("Record not found for the given INTERMENTFORM_ID!");window.location.href="customer_declinedinterment.php?Id=' . $accountId . '";</script>';
        }
        } else {
            echo '<script>alert("Invalid request!");window.location.href="customer_declinedinterment.php?Id=' . $accountId . '";</script>';
        }
$conn->close();
?>
