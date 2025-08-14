<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List of Accounts</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="listaccs.css">
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
    
  

    </aside>

  </body>
  <div class="big-white-box">
  <div class="detailstable">
    
    <div class="passbuttons">

    <button type="button" id="backButton">
        <ion-icon name="arrow-back-circle"></ion-icon>
    </button>
    <button type="button" id="forwardButton">
        <ion-icon name="arrow-forward-circle"></ion-icon>
    </button>

    </div>
  <h1><img src="pictures/listofaccounts.png" alt="" class="small-image"></h1>
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search Product Name..." onkeyup="filterTable()">
        <button type="button" onclick="filterTable()"><ion-icon name="search-outline"></ion-icon></button>
    </div>
  <div class="listaccs3d">
    <model-viewer id="myModelViewer" src="3dmodels/listaccs.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="1" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="logolistaccs3d" camera-orbit="20deg 100deg 10m">
    </model-viewer>
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

        $sql = "SELECT * FROM tbl_accounts ORDER BY POSITION";
        $result = mysqli_query($conn, $sql);

        echo"
		<center>
        <table border=1 id='product-table'>
            <thead>
            <tr>
                <th>ACCOUNT ID</th>

                <th>LASTNAME</th>
                <th>FIRSTNAME</th>
                <th>MIDDLENAME</th>
                <th>EMAIL</th>
               <th>PASSWORD</th>
                <th>POSITION</th>


            </tr>
            </thead>
           ";
            while($row = mysqli_fetch_assoc($result)){
        echo"
            <tr>
                <td>".$row['ACCOUNT_ID']."</td>

                <td>".$row['LASTNAME']."</td>
                <td>".$row['FIRSTNAME']."</td>
                <td>".$row['MIDDLENAME']."</td>
                <td>".$row['EMAIL']."</td>" ?>
                <td><?php echo str_repeat('*', strlen($row['PASSWORD'])); ?></td> <?php echo"
                <td>".$row['POSITION']."</td>
                "; ?>

                


                <?php echo"      
                ";
                ?>
                <?php 
                echo"  
            ";
            }
            echo"
            <tr>
            <th colspan=8>"
            ?>
            <script>
              document.addEventListener('DOMContentLoaded', function() {
    const createFrontdeskButton = document.querySelector('.btnLogin-popup');
    const createOwnerButton = document.querySelector('.btnLogin-popup1');

    createFrontdeskButton.addEventListener('click', function() {
        window.location.href = 'createfrontdesk.php';
    });

    createOwnerButton.addEventListener('click', function() {
        window.location.href = 'createowner.php';
    });
});
            </script>
            <div class="wrap">
            <button class="btnLogin-popup">CREATE FRONTDESK</button>
            <button class="btnLogin-popup1">CREATE LOT OWNER</button>
            </div>
            <?php
            echo "
            </th>
            </tr>";
        
        echo"
            </tbody>
        </table>
		</center>
        ";
		 ?>
    </table>
    </div>

    </div>
    </div>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
        </body>
        

    <script src="accountinsert.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
</html>
