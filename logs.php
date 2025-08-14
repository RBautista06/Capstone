<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR VIEW</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="logs.css">
  </head>
  <body>

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
    
  <?php
include "adminaside.php";
?>
    
  </body>
  <div class="internmentform">
  <h1><img src="pictures/activitylog.png" alt="" class="small-image"></h1>
 <div class="detailstable">
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search Product Name..." onkeyup="filterTable()">
        <button type="button" onclick="filterTable()"><ion-icon name="search-outline"></ion-icon></button>
    </div>



    <script>
    function filterTable() {
        var searchValue = document.getElementById("search-input").value.toLowerCase();
        
        if (searchValue === "") {
            // If the search box is empty, refresh the page
            window.location.reload(); // Refreshes the current page
            return; // Exit the function to avoid further processing
        }

        var table = document.getElementById("product-table");
        var rows = table.getElementsByTagName("tr");

        // Loop through all rows in the table (excluding the header)
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var found = false;

            // Loop through all cells in the row
            var cells = row.getElementsByTagName("td");
            for (var j = 0; j < cells.length; j++) {
                var cellText = cells[j].innerText.toLowerCase();

                // Check if the search value is found in any cell
                if (cellText.includes(searchValue)) {
                    found = true;
                    break;
                }
            }

            // Show or hide the row based on whether the search value is found
            row.style.display = found ? '' : 'none';
        }
    }

</script>
        <?php
        include "dbconnection.php";

        $sql = "SELECT * FROM tbl_log ORDER BY DATETIME DESC";
        $result = mysqli_query($conn, $sql);

        echo"
		<center>
    <table border=1 id='product-table'>
            <thead>
            <tr>
                <th>LOG ID</th>
                <th>EMAIL</th>
                <th>POSITION</th>
                <th>ACTION</th>
                <th>DATETIME</th>
            </tr>
            </thead>
           ";
            while($row = mysqli_fetch_assoc($result)){
        echo"
            <tr class='clickable-row'>
                <td>".$row['ID']."</td>
                <td>".$row['EMAIL']."</td>
                <td>".$row['POSITION']."</td>
                <td>".$row['ACTION']."</td>
                <td>".$row['DATETIME']."</td>
            </tr>";
            }
        
        echo"
            </tbody>
        </table>
		</center>
        ";
   
		 ?>
    </table>
    </div>


    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  

</html>