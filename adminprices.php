<!DOCTYPE html>
<html>
<head>
    <title>Transaction List</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="adminprices.css">
</head>
<model-viewer id="myModelViewer" src="3dmodels/frontdesklogo.gltf" alt="A 3D model of a walking character"
    shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="providence3dlogo" camera-orbit="180deg 90deg 150m">
</model-viewer>
<div class="sidebackground">
</div>
<div class="rightbackground">
</div>
<model-viewer id="myModelViewer" src="3dmodels/ADMINISTRATORTEXT.gltf" alt="A 3D model of a walking character"
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="admintext3d" camera-orbit="340deg 83deg 200m" camera-controls>
</model-viewer>
<body>
<?php
include "adminaside.php";
?>
    <div class="internmentform">
    <h1><img src="pictures/serviceprices.png" alt=""></h1>
<div class="detailstable">
<model-viewer id="myModelViewer" src="3dmodels/PAYMENT.gltf" alt="A 3D model of a walking character"
    shadow-intensity="1" ar animation-name="animation_name" autoplay="speed: 0.1"
    class="stats3dlogo" camera-orbit="0deg 90deg 100m">
</model-viewer>
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
$sql = "SELECT * FROM interment_price";
$result = mysqli_query($conn, $sql);
echo "
<center>
<table border=1 id='product-table'>
    <thead>
        <th>Service ID</th>
        <th>Service Name</th>
        <th>Price</th>
        <th>Weekdays Price</th>
        <th>Weekends Price</th>
        <th>Update</th>
    </thead>
    <tbody>
";
while ($row = mysqli_fetch_assoc($result)) {
    $intermentorederid = $row['ID'];
    echo "
    <tr class='clickable-row'>
        <td>" . htmlspecialchars($row['ID']) . "</td>
        <td>" . htmlspecialchars($row['NAME']) . "</td>
        <td> ₱ " . htmlspecialchars($row['PRICE']) . "</td>
        <td> ₱ " . htmlspecialchars($row['WEEKDAYS']) . "</td>
        <td> ₱ " . htmlspecialchars($row['WEEKENDS']) . "</td>
        <td style='padding-left: 2.5%;'>
            <a href='#' data-id='" . htmlspecialchars($row['ID']) . "' class='document-link'>
                Update Price
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
<div id="white-box" class="white-box">
    <h2><img src="pictures/updateprice.png" alt=""></h2>
    <form id="update-form">
        <table>
            <tr>
                <td><label for="service-id">Service ID:</label></td>
                <td>
                <span class="currency">&nbsp;&nbsp;
                  <input type="text" id="service-id" name="id" readonly>
                  </span>
                </td>
            </tr>
            <tr>
                <td><label for="service-name">Service Name:</label></td>
                <td>
                <span class="currency">&nbsp;&nbsp;
                  <input type="text" id="service-name" name="name" readonly>
                  </span>
                </td>
            </tr>
            <tr>
                <td><label for="price">Price:</label></td>
                <td>
                    <div class="input-wrapper">
                    <span class="currency">₱
                        <input type="text" id="price" name="price">
                    </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label for="weekdays">Weekdays Price:</label></td>
                <td>
                    <div class="input-wrapper">
                    <span class="currency">₱
                        <input type="text" id="weekdays" name="weekdays">
                       </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label for="weekends">Weekends Price:</label></td>
                <td>
                    <div class="input-wrapper">
                    <span class="currency">₱
                        <input type="text" id="weekends" name="weekends">
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class = "buttonbg"colspan="2">
                    <button class="btnLogin-popup1" type="button" onclick="updatePrice()">Save Changes</button>
                    <button class="btnLogin-popup"type="button" onclick="closeWhiteBox()">Cancel</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<!-- Add JavaScript -->
<script>
document.querySelectorAll('.document-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-id');
        fetchDetails(id);
    });
});
function fetchDetails(id) {
    fetch(`fetching_price_details.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('service-id').value = data.ID;
                document.getElementById('service-name').value = data.NAME;
                document.getElementById('price').value = data.PRICE;
                document.getElementById('weekdays').value = data.WEEKDAYS;
                document.getElementById('weekends').value = data.WEEKENDS;
                document.getElementById('white-box').style.display = 'block';
            }
        })
        .catch(error => console.error('Error fetching details:', error));
}
function closeWhiteBox() {
    document.getElementById('white-box').style.display = 'none';
}
function updatePrice() {
    var form = document.getElementById('update-form');
    var formData = new FormData(form);
    fetch('update_price.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert('Price updated successfully!');
        closeWhiteBox();
        location.reload(); // Reload the page to reflect changes
    })
    .catch(error => console.error('Error updating price:', error));
}
</script>
</div>
</div>
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
