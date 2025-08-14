<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.37.1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Account Settings</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="accountsettings.css">
    <link rel="stylesheet" href="customersidebar.css" type="text/css" />
        <link rel="stylesheet" href="accountsettings_mediaquery.css">
</head>
<!-- <model-viewer id="myModelViewer" src="3dmodels/accountlogorevised.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="providence3dlogo" camera-orbit="180deg 90deg 150m">
</model-viewer>
<div class="sidebackground">

</div>
<div class="rightbackground">

</div>

<model-viewer id="myModelViewer" src="3dmodels/LOTOWNERTEXT.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="admintext3d" camera-orbit="340deg 83deg 300m" camera-controls>
</model-viewer> -->
<?php

include 'dbconnection.php';


$account_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;

if ($account_id > 0) {

    $query = "SELECT * FROM tbl_accounts WHERE ACCOUNT_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {

        $account = $result->fetch_assoc();
    } else {
        echo "Account not found.";
        exit;
    }
} else {
    echo "Invalid account ID.";
    exit;
}


$stmt->close();
$conn->close();
?>
<div class="toggle-btn">
    <ion-icon name="menu-outline"></ion-icon>
</div>
<div class="dropdown-menu">
    
    <button class="close-btn">&times;</button>

    <div class="logosidebar">
    <h2><?php echo htmlspecialchars($account['LASTNAME'] . ', ' . $account['FIRSTNAME']); ?></h2>
    <?php
    if(empty($account['PROFILE'])) {
        $default_profile_photo = "defaultprofile.jpeg";
        echo '<img src="profilepics/' . $default_profile_photo . '" alt="logo">';
    } else {
        echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="logo">';
    }
    ?>


    </div>
                 <h4>Tabs</h4>
                <li>
                    
                    <a href="visitorspage.php?Id=<?php echo $account_id; ?>">Providence Map</a>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                </li>

                <h4>Main-menu</h4>
                <li>
				
                    <a href="visitorsettings.php?Id=<?php echo $account_id; ?>">Settings</a>
                    <span class="material-symbols-outlined"><ion-icon name="settings-outline"></ion-icon></span>
                </li>
                <li class="logout-link">
				
                    <a href="index.php">Logout</a>
                    <span class="material-symbols-outlined"><ion-icon name="log-out-outline"></ion-icon></span>
                </li>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.querySelector('.toggle-btn');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const closeBtn = document.querySelector('.dropdown-menu .close-btn');
        const btnPopups = document.querySelectorAll('.btnLogin-popup'); // Select all login buttons
        const iconClose = document.querySelector('.iconclose');

        // Toggle dropdown menu
        toggleBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown menu
        closeBtn.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });

        // Add event listeners to all login buttons
        btnPopups.forEach((btn) => {
            btn.addEventListener('click', () => {
                wrapper.classList.add('active-popup'); // Show the login popup
                dropdownMenu.classList.remove('show'); // Close the dropdown menu
                console.log('Login button clicked: active-popup class added, dropdown menu closed');
            });
        });

        // Close the popup
        iconClose.addEventListener('click', () => {
            wrapper.classList.remove('active-popup');
            console.log('Close icon clicked: active-popup class removed');
        });
    });
</script>
<body>
    <aside class="sidebar">
    <div class="logo">
    <?php
    if(empty($account['PROFILE'])) {
        $default_profile_photo = "defaultprofile.jpeg";
        echo '<img src="profilepics/' . $default_profile_photo . '" alt="logo">';
    } else {
        echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="logo">';
    }
    ?>
    <h2><?php echo htmlspecialchars($account['LASTNAME'] . ', ' . $account['FIRSTNAME']); ?></h2>

</div>
        <div class="wrapper">
            <ul class="links">
                <h4>Tabs</h4>
                <li>
                    <span class="material-symbols-outlined"><ion-icon name="folder-outline"></ion-icon></span>
                    <a href="visitorspage.php?Id=<?php echo $account_id; ?>">Providence Map</a>
                </li>

                <h4>Main-menu</h4>
                <li>
				<span class="material-symbols-outlined"><ion-icon name="settings-outline"></ion-icon></span>
                    <a href="visitorsettings.php?Id=<?php echo $account_id; ?>">Settings</a>
                </li>
                <li class="logout-link">
				<span class="material-symbols-outlined"><ion-icon name="log-out-outline"></ion-icon></span>
                    <a href="index.php">Logout</a>
                </li>
            </ul>
        </div>
    </aside>

    
<div class="internmentform">
    <h1><img src="pictures/accountsettings.png" alt=""></h1>

<div class="detailstable">
<div class="picture">

<div class="listaccs3d1">
    <model-viewer id="myModelViewer" src="3dmodels/settingsrevise.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="0"  ar animation-name="animation_name" autoplay="speed: 0.5"  exposure = ".8"
    class="logolistaccs3d1" camera-orbit="20deg 100deg 60m">
    </model-viewer>
  </div>
  <?php

if(empty($account['PROFILE'])) {

    $default_profile_photo = "defaultprofile.jpeg";

    echo '<img src="profilepics/' . $default_profile_photo . '" alt="Default Profile Picture">';
} else {
    // If not empty, display the profile photo
    echo '<img src="profilepics/' . htmlspecialchars($account['PROFILE']) . '" alt="Profile Picture">';
}
?>
<?php

$name = htmlspecialchars($account['NAME']); 

?>



</div>

<div class="updateform">
    <h1><?php echo "$name";?></h1>
<form action="update_profile.php?Id=<?php echo $account_id; ?>" method="post" enctype="multipart/form-data">

    <div class="form-container">
        <div class="formlabels">
            <label for="lastname">Last Name:</label>
            <label for="firstname">First Name:</label>
            <label for="middlename">Middle Name:</label>
            <label for="contact">Contact:</label>
            <label for="address">Address:</label>
            <label for="password">Password:</label>
            <label for="profile-picture">Change Profile Picture:</label>
        </div>

        <div class="forminputs">
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($account['LASTNAME']); ?>" required>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($account['FIRSTNAME']); ?>" required>
            <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($account['MIDDLENAME']); ?>">
            <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($account['CONTACT']); ?>" required>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($account['ADDRESS']); ?>" required>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($account['PASSWORD']); ?>" required>
            <input type="file" id="profile-picture" name="profile-picture" accept="image/*">
        </div>
            
    </div>
            <input type="submit" value="Update Profile">

</form>
    </div>


</div>


</div>
    <div class="rightbackground">
        <model-viewer id="myModelViewer" src="3dmodels/accountlogorevised.gltf" alt="A 3D model of a walking character"
            shadow-intensity="0.5" ar animation-name="animation_name" autoplay="speed: 0.5"
            class="providence3dlogo" camera-orbit="180deg 90deg 150m">
        </model-viewer>
        <model-viewer id="myModelViewer" src="3dmodels/VISITORTEXT.gltf" alt="A 3D model of a walking character"
            shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
            class="admintext3d" camera-orbit="10deg 90deg 300m" camera-controls>
        </model-viewer>
    </div>
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</body>

</html>
