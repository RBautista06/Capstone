<?php
    include_once 'connection.php';

    $sql = "DELET FROM tbl_services WHERE ID='".$_GET['id']."'";
    if(mysqli_query($conn,$sql)){
        echo "Transaction Deleted!";
    } else {
        echo "Error Deleting Transaction: ".mysqli_error($conn);
    }
    mysqli_close($conn);

    echo "<a href='registration.php'>Back to Register Log</a>"
?>