<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.37.1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Providence Memorial Park
    </title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="index_mediaquery.css">
    <link rel="stylesheet" href="indexnavbar_meduaquery.css">
    <script src="hpscript.js">
    </script>
</head>
<header>
    <div class="dropdown-menu">
        <button class="close-btn">&times;</button>
        <li><a href="index.php">Home</a></li>
        <li><a href="requestaccount.php">Request for Account Creation</a></li>
        <li><a href="indexservices.php">Services & FaQs</a></li>
        <li><a href="aboutus.php">About us</a></li>
        <li><button class="btnLogin-popup">Login</button></li>
    </div>
    <div class="navbar">
        <div class="logo"></div>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="requestaccount.php">Request for Account Creation</a></li>
            <li><a href="indexservices.php">Services & FaQs</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><button class="btnLogin-popup">Login</button></li>
        </ul>
        <div class="toggle-btn">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const wrapper = document.querySelector('.wrapper');
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
</header>
<script>
    function openPDF() {
        var pdfPath = 'paymentinstruction/How-to-Locate-Decendent-3.pdf';
        window.open(pdfPath, '_blank');
    }
    function openRequest() {
        var RequestPath = 'requestaccount.php';
        window.location.href = RequestPath;
    }
</script>
<div class="wrapper">
    <span class="iconclose">
        <ion-icon name="close"></ion-icon>
    </span>
    <div class="form-box login">
        <h2>Login</h2>
        <form method=POST action="login.php">
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name=email required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name=pass required>
                <label>Password</label>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn" name=sub>Login</button>
            <div class="login-register">
                <p>Don't have an account?
                    <a href="#" class="register-link">
                        Sign-up
                    </a>
                </p>
            </div>
        </form>
    </div>
    <div class="form-box register">
        <h2>Sign-up</h2>
        <form method=POST action="signup.php">
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" name=Firstname required>
                <label>Firstname</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" name=Middlename required>
                <label>Middlename</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" name=Lastname required>
                <label>Lastname</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name=regemail required>
                <label>Email</label>
            </div>
            <div class="input-box" oninput="showPasswordHint()" onblur="hidePasswordHint()">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="regpass" required>
                <label>Password</label>
                <div class="password-hint">
                    Password must be at least 8 characters long, include at least one uppercase letter, and contain at least one special character (@, #, $, etc.).
                </div>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="checkmark-done-circle"></ion-icon></span>
                <input type="password" name=passcon required>
                <label>Password Confirmation</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="call"></ion-icon></span>
                <input type="text" name=contact required>
                <label>Contact</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="location"></ion-icon></span>
                <input type="text" name=address required>
                <label>Address</label>
            </div>
            <div class="remember-forgot">
                <label class="tooltip">
                    <input type="checkbox" id="terms-checkbox" onclick="toggleSignupButton()" required>
                    I agree to the terms and conditions
                    <span class="tooltiptext">By creating an account on our website, you agree to abide by
                        our terms and conditions, including rules on account security, user conduct, and content ownership.</span>
                </label>
            </div>
            <button type="submit" class="btn" name=signup>Sign-up</button>
            <div class="login-register">
                <p>Already have an account?
                    <a href="#" class="login-link">
                        Login
                    </a>
            </div>
        </form>
    </div>
</div>
<div class="firstdiv">
    <div class="firstdiv-picture1">
        <img class="img-banner" src="pictures/provilogoside3d.png" alt="">
    </div>
    <div class="firstdiv-info">
        <h2>Antipolo</h2>
        <h3>Providence Memorial Park</h3>
        <h4>Antipolo Providence Memorial Park</h4>
        <p>"A place where memories live forever"<br>
            Providence Memorial Park is a private cemetery that offers memorial lot from lawn lot to mausoleums
        </p>
        <br>
        <div class="firstdiv-buttons">
            <button class="locate" onclick="openPDF()">How to Locate Descendants</button>
            <button class="locate" onclick="openRequest()">Request for Account Creation</button>
        </div>
    </div>
    <div class="firstdiv-picture">
        <model-viewer id="myModelViewer" src="3dmodels/providence logi.gltf" alt="A 3D model of a walking character"
            shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5"
            class="providence3dlogo" camera-orbit="120deg 83deg 1m">
        </model-viewer>
    </div>
</div>
<div class="seconddiv">
    <div class="seconddiv-picture1">
        <img class="seconddiv-banner" src="pictures/map.png" alt="">
    </div>
    <div class="seconddiv-info">
        <p>
            Providence Memorial Park in Antipolo offers a serene and peaceful environment, perfect for honoring and remembering loved ones, Surrounded by lush landscapes and well-maintained gardens, the park provides a conforting space where visitors can find solace. The calming pathways, lined with trees and blooming flowers, create a reflective atmosphere, making it a beautiful setting for bot traditional burial plots and columbarium niches.
            <br>
            <br>
            Conviniently located in the tranqiul hills of Antipolo, Prividence Memorial Park is just far enough from the city to offer a quiet retreat, while still being easily accessible for regular visits. It's scenic views and tranquil sorroundings offer a place of peace and reflection, making it an ideal choice for families seeking a ideal choice for families.
        </p>
    </div>
    <div class="seconddiv-picture2">
        <img class="seconddiv-banner" src="pictures/map.png" alt="">
    </div>
    <!-- <div class="seconddiv-picture">
            <model-viewer class="providencemap" src="3dmodels/providencemap.gltf" alt="A 3D model of a walking character"
                    shadow-intensity="5" ar animation-name="animation_name" autoplay="speed: 0.5"
                    camera-orbit="80deg 73deg 1m">
            </model-viewer>
        </div> -->
</div>
<div class="thirddiv">
    <div class="thirddiv-info">
        <p>
            Providence Memorial Park in Antipolo offers a serene and peacefule environment, perfect for honoring and remembering loved ones, Surrounded by lush landscapes and well-maintained gardens, the park provides a conforting space where visitors can find solace. The calming pathways, lined with trees and blooming flowers, create a reflective atmosphere, making it a beautiful setting for bot traditional burial plots and columbarium niches.
            <br>
            <br>
            Conviniently located in the tranqiul hills of Antipolo, Prividence Memorial Park is just far enough from the city to offer a quiet retreat, while still being easily accessible for regular visits. It's scenic views and tranquil sorroundings offer a place of peace and reflection, making it an ideal choice for families seeking a ideal choice for families.
        </p>
    </div>
    <div class="thirddiv-photo">
        <div class="container" onclick="return false;">
            <div class="box">
                <img src="pictures/pmp2.jpg" alt="Photo 1">
            </div>
            <div class="box">
                <img src="pictures/pmp2.jpg" alt="Photo 2">
            </div>
            <div class="box">
                <img src="pictures/pmp3.jpg" alt="Photo 3">
            </div>
            <div class="box">
                <img src="pictures/pmp4.jpg" alt="Photo 4">
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            const boxes = document.querySelectorAll('.box');
            const secondBox = boxes[1];
            // Set the default hovered state to the second box initially
            secondBox.classList.add('hovered');
            boxes.forEach(box => {
                box.addEventListener('mouseover', () => {
                    // Remove 'hovered' from all boxes and add it to the currently hovered box
                    boxes.forEach(b => b.classList.remove('hovered'));
                    box.classList.add('hovered');
                });
                box.addEventListener('mouseout', () => {
                    // Restore the 'hovered' state to the second box when hovering out of any box
                    boxes.forEach(b => b.classList.remove('hovered'));
                    secondBox.classList.add('hovered');
                });
            });
        };
    </script>
</div>
<div class="footer">
    <div class="footer-column">
        <h3>Contact Us</h3>
        <p><ion-icon name="mail"></ion-icon> &nbsp; Email: &nbsp; <a href="mailto:info@providencememorial.com">info@providencememorial.com</a></p>
        <p><ion-icon name="call"></ion-icon>&nbsp; Phone:&nbsp; (123) 456-7890</p>
        <p><ion-icon name="location"></ion-icon>&nbsp; Address:&nbsp; 1234 Memorial Park Lane, Antipolo, Philippines</p>
        <p><ion-icon name="time"></ion-icon>&nbsp; Office Hours: &nbsp; Monday - Friday, 9 AM - 5 PM</p>
        <p><ion-icon name="person"></ion-icon>&nbsp;&nbsp;Customer Support:<a href="tel:18001234567">1-800-123-4567</a> (24/7)</p>
    </div>
    <div class="footer-column">
        <h3>About Us</h3>
        <p><ion-icon name="logo-ionic"></ion-icon> &nbsp; Providence Memorial Park in Antipolo offers a serene and peaceful environment, perfect for honoring and
            remembering loved ones.</p>
        <p><ion-icon name="logo-ionic"></ion-icon> &nbsp; Established in 1980, we have been dedicated to providing compassionate and respectful services. Our park is
            designed to offer comfort and solace to families and friends.</p>
    </div>
    <div class="footer-column">
        <h3>Follow Us</h3>
        <p><ion-icon name="logo-ionic"></ion-icon> &nbsp; Stay connected through our social media channels for updates, events, and more:
            Join our community and be part of our events where we celebrate and honor memories.</p>
        <p><ion-icon name="logo-ionic"></ion-icon> &nbsp; Sign up for our newsletter to receive the latest news and offers directly in your inbox.</p>
        <p><a href="#"><ion-icon name="logo-facebook"></ion-icon>&nbsp;Facebook</a></p>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
</body>
</html>