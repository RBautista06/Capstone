<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR VIEW</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <link rel="stylesheet" href="lotlist.css">
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
    
    
  </body>
  <div class="internmentform">
    

  <h1><img src="pictures/listofdecendents70.png" alt="" class="small-image"></h1>
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

        $sql = "SELECT * FROM interment_forms WHERE STATUS = 'Mark as done' ORDER BY DATE_OF_INTERMENT ASC";

        $result = mysqli_query($conn, $sql);

        echo"
		<center>
    <table border=1 id='product-table'>
            <thead>
            <tr>
                <th>Interment ID</th>
                <th>Location</th>
                <th>Deceased name</th>
                <th>Type of Remains</th>
                <th>Date of Death</th>
                <th>Date of Interment</th>

            </tr>
            </thead>
           ";
            while($row = mysqli_fetch_assoc($result)){
                $fullName = $row['FIRSTNAME'] . ' ' . $row['MIDDLENAME'] . ' ' . $row['LASTNAME'];
        echo"
    <tr class='clickable-row'>
                <td>".$row['INTERMENTFORM_ID']."</td>
                <td>".$row['LOCATION_ID']."</td>
                <td>". $fullName ."</td>
                <td>".$row['REMAINS_TYPE']."</td>
                <td>".$row['DATE_OF_DEATH']."</td>
                <td>".$row['DATE_OF_INTERMENT']."</td>
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
    </div>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>