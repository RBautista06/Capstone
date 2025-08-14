<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR VIEW</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="frontdesk_transaction.css">
  </head>
  <body>
  <aside class="sidebar">
      <div class="logo">
        <img src="pictures/providence_logo.png" alt="logo">
        <h2>ADMINISTRATOR</h2>
      </div>
      <div class="wrapper">
      <ul class="links">
        <h4>Sales</h4>
        <li>
          <span class="material-symbols-outlined">dashboard</span>
          <a href="admindashboard.php">Dashboard</a>
        </li>
        <li>
            <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
            <a href="adminapplicationinterment.php">
            Transactions</a>
        </li>
        <li>
            <span class="material-symbols-outlined"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
            <a href="lotlist.php">List of <br>Decendents</a>
        </li>
        <hr>
        <h4>Accounts</h4>
        <li>
          <span class="material-symbols-outlined">person</span>
          <a href="listaccs.php" class="listaccs">List of Accounts</a>
        </li>
        <li>
          <span class="material-symbols-outlined">group</span>
          <a href="logs.php">Activity Log</a>
        </li>
        <hr>
        <h4>Main-menu</h4>
        <li>
          <span class="material-symbols-outlined">settings</span>
          <a href="#">Settings</a>
        </li>
        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="index.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
    </aside>
    <div class="internmentform">
    <h1><img src="pictures/listoftransactions.png" alt=""></h1>
<div class="detailstable">
<div class="search-bar">
        <input type="text" id="search-input" placeholder="Search Name..." onkeyup="filterTable()">
        <button type="button" onclick="filterTable()"><ion-icon name="search-outline"></ion-icon></button>
    </div>
    <script>
function filterTable() {
    var searchValue = document.getElementById("search-input").value.toLowerCase();
    if (searchValue === "") {
        window.location.reload();
        return;
    }
    var table = document.getElementById("product-table");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var found = false;
        var cells = row.getElementsByTagName("td");
        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].innerText.toLowerCase();
            if (cellText.includes(searchValue)) {
                found = true;
                break;
            }
        }
        row.style.display = found ? '' : 'none';
    }
}
</script>
<?php
include "dbconnection.php";
$sql = "SELECT * FROM tbl_transaction ";
$result = mysqli_query($conn, $sql);
echo "
<center>
<table border=1 id='product-table'>
    <thead>
           <th>Transaciton ID</th>
            <th>Order Type</th>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Amount Paid</th>
            <th>Prepared By</th>
            <th>Invoice</th>
    </thead>
    <tbody>
";
while ($row = mysqli_fetch_assoc($result)) {;
    $intermentorederid = $row['TRANSACTION_ID'];
    $customerNameQuery = "SELECT * FROM interment_forms WHERE INTERMENTFORM_ID = '$intermentorederid'";
    $customerNameResult = mysqli_query($conn, $customerNameQuery);
    $customerNameRow = mysqli_fetch_assoc($customerNameResult);
                        echo "
                        <tr class='clickable-row' >
                            <td>" . htmlspecialchars($row['TRANSACTION_ID']) . "</td>
                            <td>" . htmlspecialchars($row['ORDER_TYPE']) . "</td>
                            <td>" . htmlspecialchars($row['ORDER_ID']) . "</td>
                            <td>" . htmlspecialchars($row['CUSTOMER_NAME']) . "</td>
                            <td> ₱ " . htmlspecialchars($row['PAYMENT_PRICE']) . "</td>
                            <td>" . htmlspecialchars($row['PREPARED_BY']) . "</td>
                            <td style='padding-left: 2.5%;'>
                            <a href='".$row['INVOICE_FILE']."' target='_blank' class='document-link'>
                            <ion-icon name='document'></ion-icon>
                            </a>
                            </td>
                            </tr>";
                            }
                            echo "
                            </tbody>
                            </table>
                            </center>
                            ";
?>
</div>
</div>
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
