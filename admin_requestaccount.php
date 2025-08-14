<!DOCTYPE html>
<html>
<head>
    <title>Admin Request Account</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin_requestaccount.css">
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
    <model-viewer id="model2" src="3dmodels/requestaccountprocess.gltf" alt="A 3D model of a walking character"
        shadow-intensity="1" ar animation-name="animation_name" autoplay="speed: 0.5"
        class="stats3dlogo" camera-orbit="30deg 83deg 8m" camera-controls>
    </model-viewer>
    <?php
include "adminaside.php";
?>
    <div class="internmentform">
        <h1><img src="pictures/accountrequest.png" alt=""></h1>
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
            // Fetch all rows from request_tbl
            $sql = "SELECT * FROM request_tbl";
            $result = mysqli_query($conn, $sql);
            echo "<center>
            <table border=1 id='product-table'>
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Request Type</th>
                        <th>Certificate</th>
                        <th>Account Setup</th>
                        <th>Decline</th>
                    </tr>
                </thead>
                <tbody>";
            // Loop through each row and display data
            while ($row = mysqli_fetch_assoc($result)) {
                $requestId = htmlspecialchars($row['REQUEST_ID']); // Use the ID directly from the row
            echo "
            <tr class='clickable-row'>
                <td>" . $requestId . "</td>
                <td>" . htmlspecialchars($row['NAME']) . "</td>
                <td>" . htmlspecialchars($row['EMAIL']) . "</td>
                <td>" . htmlspecialchars($row['CONTACT']) . "</td>
                <td>" . htmlspecialchars($row['TYPE_OF_REQUEST']) . "</td>
                <td style='text-align: center;'>
                    <a href='" . htmlspecialchars($row['CERTIFICATE']) . "' target='_blank' class='document-link'>
                        <ion-icon name='document'></ion-icon>
                    </a>
                </td>
                <td style='text-align: center;'>";
            $href = 'admin_requestaccountprocess.php?Id=' . $requestId;
            $icon = 'checkbox';
            if ($row['TYPE_OF_REQUEST'] === 'For Lot Owner') {
                $href = 'admin_requestaccountprocess.php?Id=' . $requestId;
                $icon = 'document';
            } elseif ($row['TYPE_OF_REQUEST'] === 'For Transferee') {
                $href = 'admin_transfereerequestaccountprocess.php?Id=' . $requestId;
                $icon = 'document';
            }
            echo "
                    <a href='" . $href . "' target='_blank' class='document-link1'>
                        <ion-icon name='" . $icon . "'></ion-icon>
                    </a>
                </td>
                <td style='text-align: center;'>
                    <a href='#' class='declinebutton' data-request-id='" . $requestId . "'>
                        <ion-icon name='close-circle-outline'></ion-icon>
                    </a>
                </td>
            </tr>";
            }
            echo "
                </tbody>
            </table>
            </center>";
            ?>
        </div>
        <div id="declineModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <form id="declineForm" action="requestaccount_decline.php" method="POST">
                    <input type="hidden" id="declineRequestId" name="request_id" readonly>
                    <label for="reason">Enter Reason:</label>
                    <textarea id="reason" name="reason" rows="6" required></textarea>
                    <button type="submit">Decline</button>
                </form>
            </div>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById("declineModal");
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on the decline link, open the modal
        document.querySelectorAll('.declinebutton').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var requestId = this.getAttribute('data-request-id');
                document.getElementById('declineRequestId').value = requestId;
                modal.style.display = "block";
                modal.classList.remove('closing'); // Ensure no closing animation class is active
            });
        });
        // Function to close the modal with animation
        function closeModal() {
            modal.classList.add('closing'); // Add the closing animation class
            modal.addEventListener('animationend', function () {
                modal.style.display = "none"; // Hide modal after animation ends
                modal.classList.remove('closing'); // Remove closing class for reuse
            }, { once: true }); // Ensure the event listener triggers only once
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = closeModal;
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    });
</script>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>
</html>
