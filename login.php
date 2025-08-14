<?php
include "dbconnection.php";
if (isset($_POST['sub'])) {
    $user = $_POST['email'];
    $pass = $_POST['pass'];
    // Query to check if the user exists
    $sql = "SELECT * FROM tbl_accounts WHERE EMAIL = '$user' AND PASSWORD = '$pass'";
    $result0 = $conn->query($sql);
    // If the user is found in the database
    if ($result0->num_rows > 0) {
        $row1 = $result0->fetch_assoc();
        $pos1 = $row1['POSITION'];
        $customerId = $row1['ACCOUNT_ID']; // Get the ACCOUNT_ID
        // Log the login action
        $sql1 = "INSERT INTO tbl_log (EMAIL, POSITION, ACTION, DATETIME)
                VALUES ('$user', '$pos1', 'Logged in', NOW())";
        $result1 = $conn->query($sql1);
        // Redirect based on the user's position
        if ($pos1 == 'Administrator') {
            ?>
            <script>
                alert("WELCOME ADMIN!");
                window.location.href = "admindashboard.php";
            </script>
            <?php
        } elseif ($pos1 == 'Lot Owner') {
            ?>
            <script>
                window.location.href = "customermap.php?Id=<?php echo $customerId; ?>";
            </script>
            <?php
        } elseif ($pos1 == 'Visitor') {
            ?>
            <script>
                window.location.href = "visitorspage.php?Id=<?php echo $customerId; ?>";
            </script>
            <?php
        } elseif ($pos1 == 'Front Desk') {
            ?>
            <script>
                window.location.href = "frontdeskdashboard.php?Id=<?php echo $customerId; ?>";
            </script>
            <?php
        } elseif ($pos1 == 'Previous Lot Owner') {
            ?>
            <script>
                window.location.href = "previouslotowner_page.php?Id=<?php echo $customerId; ?>";
            </script>
            <?php
        }
    } else {
        // If the credentials are wrong
        ?>
        <script>
            alert("Wrong Username and Password!!");
            window.location.href = "index.php";
        </script>
        <?php
    }
}
?>
