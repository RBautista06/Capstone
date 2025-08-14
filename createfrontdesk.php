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
    <link rel="stylesheet" href="createforntdesk.css">
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
  <div class="big-white-box">
  <div class="detailstable">
	<script>
		document.addEventListener('DOMContentLoaded', function() {
    const backButton = document.getElementById('backButton');
    backButton.addEventListener('click', function() {
        window.location.href = 'listaccs.php';
    });
});
	</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const forwardButton = document.getElementById('forwardButton');
    forwardButton.addEventListener('click', function() {
        window.location.href = 'listaccs.php';
    });
});
    </script>
    <div class="passbuttons">
<button type="button" id="forwardButton">
    <ion-icon name="arrow-forward-circle"></ion-icon>
</button>
</div>
  <div class="listaccs3d">
    <model-viewer id="myModelViewer" src="3dmodels/frontdesklogo.gltf" alt="A 3D model of a walking character"
    shadow-intensity="1" ar animation-name="animation_name" autoplay="speed: 0.5"
    class="logolistaccs3d" camera-orbit="20deg 100deg 10m">
    </model-viewer>
  </div>
  <h1><img src="pictures/createfrontdesk.png" alt="" class="small-image"></h1>
  <div class="ownercreation">
<form action="createfrontdesk_process.php" method="post">
<div class="ownername">
  <label for="lastname">Name of Front Desk:</label>
<div class="ownerinputs">
  <input type="text" id="lastname" name="lastname" placeholder="Enter Lastname..." required>
  <input type="text" id="firstname" name="firstname" placeholder="Enter Firstname..." required>
  <input type="text" id="middlename" name="middlename" placeholder="Enter Middlename..." required>
  </div>
</div>
<div class="owneremail">
<div class="emailname">
  <label for="">Email:</label>
  </div>
  <div class="emailinput">
  <input type="text" id="email" name="email" placeholder="Enter Valid Email Address..." required>
  </div>
</div>
<div class="ownercontact">
<div class="contactname">
  <label for="">Contact:</label>
  </div>
  <div class="contactinput">
  <input type="text" id="contact" name="contact" placeholder="Enter Contact Number (09-0000-0000)" required>
  </div>
</div>
<script>
var contactInput = document.getElementById('contact');
var errorSpan = document.getElementById('contactError');
contactInput.addEventListener('input', function(event) {
    var input = event.target.value;
    var regex = /^[0-9]{11}$/;
    if (!regex.test(input)) {
        errorSpan.style.display = 'inline';
    } else {
        errorSpan.style.display = 'none';
    }
});
contactInput.addEventListener('keypress', function(event) {
    if (event.key.match(/[^0-9]/)) {
        event.preventDefault();
    }
});
</script>
<div class="owneraddress">
<div class="addressname">
  <label for="">Address:</label>
  </div>
  <div class="addressinput">
  <input type="text" id="address" name="address" placeholder="Enter Address..." required>
  </div>
</div>
<div class="ownerpassword">
<div class="passwordname">
  <label for="">Password:</label>
  </div>
  <div class="passwordinput">
  <input type="text" id="password" name="password" placeholder="Enter Passwrod..." required>
</div>
</div>
<div class="buttonbg">
	<button type=submit class="btnLogin-popup">CREATE FRONT DESK</button>
	</div>
    </div>
</form>
    </div>
    </div>
    <div id="messageBox" class="messageBox">
    <p id="messageText"></p>
</div>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
        </body>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
</html>
