<?php
include "dbconnection.php";

$lastname = trim($_POST['lastname']);
$firstname = trim($_POST['firstname']);
$middlename = trim($_POST['middlename']);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$contact = trim($_POST['contact']);
$address = trim($_POST['address']);
$password = trim($_POST['password']);
$reqtype = trim($_POST['reqtype']);
$name = $firstname . ' ' . $middlename . ' ' . $lastname;

$certificate = $_FILES['certificate']['name'];
$certificateTmpName = $_FILES['certificate']['tmp_name'];

$uploadDirectory = 'request_certificate/';
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

$allowedFileTypes = ['pdf', 'png', 'jpg', 'jpeg'];
$fileExtension = strtolower(pathinfo($certificate, PATHINFO_EXTENSION));

// Check for strong password
if (!isStrongPassword($password)) {
    echo '<script>alert("Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a digit, and a special character."); window.location.href = "requestaccount.php";</script>';
    $conn->close();
    exit;
}

// Check if the email already exists in the request_tbl or owners table
$emailCheckQuery = "SELECT 1 FROM request_tbl WHERE EMAIL = '$email' 
                    UNION 
                    SELECT 1 FROM tbl_accounts WHERE EMAIL = '$email'";
$emailCheckResult = $conn->query($emailCheckQuery);

if ($emailCheckResult->num_rows > 0) {
    echo '<script>alert("Email already exists. Please use a different email."); window.location.href = "requestaccount.php";</script>';
    $conn->close();
    exit;
}

if (in_array($fileExtension, $allowedFileTypes)) {
    $query = "INSERT INTO request_tbl (NAME, FIRSTNAME, MIDDLENAME, LASTNAME, EMAIL, CONTACT, ADDRESS, PASSWORD,TYPE_OF_REQUEST) 
              VALUES ('$name', '$firstname', '$middlename', '$lastname', '$email', '$contact', '$address', '$password','$reqtype')";

    if ($conn->query($query) === true) {
        $requestId = $conn->insert_id;

        $newCertificateName = $requestId . '.' . $fileExtension;
        $certificatePath = $uploadDirectory . $newCertificateName;

        if (move_uploaded_file($certificateTmpName, $certificatePath)) {
            $updateQuery = "UPDATE request_tbl SET CERTIFICATE = '$certificatePath' WHERE REQUEST_ID = $requestId";
            if ($conn->query($updateQuery) === true) {
                echo '<script>alert("Request has been sent. Please wait for 1-3 days for account creation."); window.location.href = "requestaccount.php";</script>';
            } else {
                echo "Error updating record with certificate path: " . $conn->error;
            }
        } else {
            echo '<script>alert("Failed to upload certificate."); window.location.href = "requestaccount.php";</script>';
        }
    } else {
        echo "Error inserting record: " . $conn->error;
    }
} else {
    echo '<script>alert("Upload file types are strictly: PDF, JPG, JPEG, and PNG."); window.location.href = "requestaccount.php";</script>';
}

$conn->close();

// Function to check if the password is strong
function isStrongPassword($password) {
    // Define the password strength criteria
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}
?>
