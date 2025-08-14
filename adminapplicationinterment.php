<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR VIEW</title>
    <!-- Linking Google font link for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="adminapplicationinterment.css">
    <link rel="stylesheet" href="adminapplicationinterment.js">
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
          <a href="logs.php">Log-in Time</a>
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
<main class="content">
    <!-- Big white box content goes here -->
    <div class="big-white-box">
        <h1><img src="pictures/listoftransactions.png" alt="" class="small-image"></h1>
        <div class="invoicetable">
            </div>
        </div>
    </div>
</main>
</body>
<model-viewer id="myModelViewer" src="3dmodels/providence logi.gltf" alt="A 3D model of a walking character"
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="providence3dlogo" camera-orbit="120deg 83deg 3m">
    </model-viewer>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
<script src="adminapplicationinterment.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
