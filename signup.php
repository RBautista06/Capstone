<?php
// Include the database connection
include "dbconnection.php";
if (isset($_POST['signup'])) {
    // Ensure all required fields are not empty
    if (
        !empty($_POST['Firstname']) &&
        !empty($_POST['Middlename']) &&
        !empty($_POST['Lastname']) &&
        !empty($_POST['regemail']) &&
        !empty($_POST['regpass']) &&
        !empty($_POST['passcon']) &&
        !empty($_POST['address']) &&
        !empty($_POST['contact'])
    ) {
        $firstname = $_POST['Firstname'];
        $middlename = $_POST['Middlename'];
        $lastname = $_POST['Lastname'];
        $email = $_POST['regemail'];
        $pass = $_POST['regpass'];
        $conpass = $_POST['passcon'];
        $comaddress = $_POST['address'];
        $contact = $_POST['contact'];
        // Concatenate Firstname, Middlename, and Lastname to create the full name
        $name = $firstname . ' ' . $middlename . ' ' . $lastname;
        // Password validation: 8+ characters, at least one uppercase letter, one special character
        $passwordPattern = "/^(?=.*[A-Z])(?=.*[@#$%^&*()_+=]).{8,}$/";
        if (!preg_match($passwordPattern, $pass)) {
            // Password does not meet requirements
            ?>
            <script>
            alert("Password must be at least 8 characters long, include at least one uppercase letter, and contain at least one special character (@, #, $, etc.)");
            window.history.back(); // Go back to the form
            </script>
            <?php
            exit;
        }
        // Check if the email is already taken
        $checkEmailQuery = "SELECT COUNT(*) FROM tbl_accounts WHERE EMAIL = ?";
        $checkStmt = mysqli_prepare($conn, $checkEmailQuery);
        if ($checkStmt) {
            mysqli_stmt_bind_param($checkStmt, "s", $email);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_bind_result($checkStmt, $emailCount);
            mysqli_stmt_fetch($checkStmt);
            mysqli_stmt_close($checkStmt); // Close the check statement to avoid "Commands out of sync" error
            if ($emailCount > 0) {
                // Email is already taken
                ?>
                <script>
                alert("Email is already taken. Please use a different email address.");
                window.history.back();
                </script>
                <?php
                exit;
            } else {
                if ($pass == $conpass) {
                    // Hash the password before storing it
                    // Insert new account
                    $insertQuery = "INSERT INTO tbl_accounts (FIRSTNAME, MIDDLENAME, LASTNAME, NAME, EMAIL, PASSWORD, POSITION, ADDRESS, CONTACT) VALUES (?, ?, ?, ?, ?, ?, 'Visitor', ?, ?)";
                    $insertStmt = mysqli_prepare($conn, $insertQuery);
                    if ($insertStmt) {
                        mysqli_stmt_bind_param($insertStmt, "ssssssss", $firstname, $middlename, $lastname, $name, $email, $pass, $comaddress, $contact);
                        if (mysqli_stmt_execute($insertStmt)) {
                            // Account successfully created
                            ?>
                            <script>
                            alert("Account Successfully Created, Continue to Login!!");
                            window.location.href = "index.php";
                            </script>
                            <?php
                        } else {
                            // Error executing the statement
                            echo "Error executing the statement: " . mysqli_stmt_error($insertStmt);
                        }
                        mysqli_stmt_close($insertStmt);
                    } else {
                    }
                } else {
                    // Passwords do not match
                    ?>
                    <script>
                    alert("Passwords do not match. Please try again.");
                    window.history.back(); // Go back to the form
                    </script>
                    <?php
                }
            }
        } else {
            // Error preparing the email check statement
            echo "Error preparing the email check statement: " . mysqli_error($conn);
        }
    } else {
        ?>
        <script>
        alert("All fields are required.");
        window.history.back(); // Go back to the form
        </script>
        <?php
    }
}
?>
