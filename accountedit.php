<?php
include "dbconnection.php";
if (isset($_POST["updatestock"]))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pos = $_POST['position'];
    $id = $_POST['id'];

    $sqlUpdate = "UPDATE tbl_accounts SET ACCOUNT_ID = '$id', NAME = '$name', EMAIL = '$email', POSITION = '$pos', PASSWORD = '$pass' WHERE ACCOUNT_ID = '$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Updated Successfully!";
        header("Location:listaccs.php");
    }else{
        die("Something went wrong");
    }
}
?>