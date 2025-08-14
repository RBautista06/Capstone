<?php
include "dbconnection.php";
if (isset($_POST['createacc'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pos = $_POST['position'];
        $sql = "INSERT INTO tbl_accounts (NAME,EMAIL,PASSWORD,POSITION) VALUES ('$name', '$email', '$pass', '$pos')";
        $result = $conn->query($sql);
        if(!$result)
        {
            $errormessage = "Invalid query: ".$conn->error;
        }
        else
        {
            ?>
            <script>
            alert("Account Succesfully Added");
            window.location.href = "listaccs.php";
            </script>
            <?php
        }
}
?>
