<?php
include "dbconnection.php";
$lastname = trim($_POST['lastname']);
$firstname = trim($_POST['firstname']);
$middlename = trim($_POST['middlename']);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$contact = trim($_POST['contact']);
$address = trim($_POST['address']);
$password = trim($_POST['password']);
$position = 'Front Desk';
$name = $firstname . ' ' . $middlename . ' ' . $lastname;
$conn->begin_transaction();
try {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_accounts WHERE EMAIL = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($email_count);
    $stmt->fetch();
    $stmt->close();
    if ($email_count > 0) {
        ?>
            <script>
            window.location.href = "createfrontdesk.php";
            alert("Email already taken, please Enter Another Email");
            </script>
        <?php
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO tbl_accounts (NAME, LASTNAME, FIRSTNAME, MIDDLENAME, EMAIL, CONTACT, ADDRESS, PASSWORD, POSITION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssssss', $name, $lastname, $firstname, $middlename, $email, $contact, $address, $password, $position);
    if (!$stmt->execute()) {
        throw new Exception("Error inserting into tbl_accounts: " . $stmt->error);
    }
    $conn->commit();
    echo '<script>alert("Successfully Created a Front Desk Account"); window.location.href = "createfrontdesk.php";</script>';
} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to create Front Desk: " . $e->getMessage();
}
$stmt->close();
$conn->close();
?>
