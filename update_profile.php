<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    include 'dbconnection.php';

    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $profile_picture = $_FILES["profile-picture"];

    $account_id = isset($_SESSION['ACCOUNT_ID']) ? $_SESSION['ACCOUNT_ID'] : (isset($_GET['Id']) ? intval($_GET['Id']) : 0);

    // Concatenate first name, middle name, and last name to form the full name
    $name = $firstname . " " . $middlename . ". " . $lastname;

    // Check if a file is uploaded
    if ($profile_picture['error'] === UPLOAD_ERR_OK) {
        $profile_picture_filename = $account_id . "." . pathinfo($profile_picture["name"], PATHINFO_EXTENSION);
    } else {
        // No file uploaded, keep the existing profile value
        $profile_picture_filename = "";
    }

    $sql = "UPDATE tbl_accounts SET LASTNAME=?, FIRSTNAME=?, MIDDLENAME=?, CONTACT=?, ADDRESS=?, PASSWORD=?, NAME=?";
    $params = array($lastname, $firstname, $middlename, $contact, $address, $password, $name);

    // Add profile picture to update query if a file is uploaded
    if ($profile_picture_filename !== "") {
        $sql .= ", PROFILE=?";
        $params[] = $profile_picture_filename;
    }

    $sql .= " WHERE ACCOUNT_ID=?";
    $params[] = $account_id;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);

    if ($stmt->execute()) {

        // Upload profile picture if a file is uploaded
        if ($profile_picture_filename !== "") {
            $target_dir = "profilepics/";
            $target_file = $target_dir . $profile_picture_filename;
            move_uploaded_file($profile_picture["tmp_name"], $target_file);
        }

        $stmt->close();
        $conn->close();

        ?>
        <script>
            alert("Account Successfully Updated!");
            window.location.href = "accountsettings.php?Id=<?php echo $account_id; ?>"; 
        </script>
        <?php
        exit;
    } else {
        echo "Error updating account: " . $conn->error;
    }
}
?>
