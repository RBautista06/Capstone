<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.37.1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Account
    </title>
    <link rel="stylesheet" href="requestaccount.css">
    <link rel="stylesheet" href="requestaccount_mediaquery.css">
    <link rel="stylesheet" href="indexnavbar_meduaquery.css">
    <script src="hpscript.js">    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.8.1/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.8.1/dist/ionicons/ionicons.js"></script>
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
<div class="detailstable">
    <h1>
        <img src="pictures/requestowneraccount.png" alt="" class="small-image">
    </h1>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.getElementById('backButton');
            backButton.addEventListener('click', function() {
                window.location.href = 'listaccs.php';
            });
        });
    </script>
    <div class="listaccs3d">
        <model-viewer id="myModelViewer" src="3dmodels/requestaccount.gltf" alt="A 3D model of a walking character"
            shadow-intensity="1" animation-name="animation_name" autoplay="speed: 0.8"
            class="logolistaccs3d" camera-orbit="20deg 90deg 7m" exposure="0.7">
        </model-viewer>
    </div>
    <div class="listaccs3dpicture">
        <img class="img-banner" src="pictures/requestaccount.png" alt="">
    </div>
    <div class="ownercreation">
        <form action="requestaccount_process.php" method="POST" enctype="multipart/form-data">
            <div class="typeofrequest">
                <div class="reqinputdiv">
                        <input type="radio" name="reqtype" id="reqtype" value="For Lot Owner" required> <label>For Lot Owner Account</label>
                </div>
                <div class="reqinputdiv">
                        <input type="radio" name="reqtype" id="reqtype" value="For Transferee" required>  <label>For Trasferee Lot Owner Account</label>
                </div>
            </div>
            <div class="ownername">
                <label for="lastname">Name of the Owner:</label>
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
                    <input type="text" id="email" name="email" placeholder="Enter Valid Email Address... (@gmail.com)" required>
                </div>
            </div>
    <div class="ownerpassword">
        <div class="passwordname">
            <label for="password">Password:</label>
        </div>
        <div class="passwordinput">
            <input type="password" id="password" name="password" placeholder="Password..." required>
            <span id="togglePassword" onclick="togglePasswordVisibility()">
                <ion-icon name="eye-outline"></ion-icon>
            </span>
        </div>
<div id="passwordError" class="error-message">
    <p>Note: The password must include at least one uppercase letter, one numeral, and one special character.</p>
</div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword").firstElementChild;
            if (passwordField.type === "password") {
                passwordField.type = "text"; // Show the password
                toggleIcon.setAttribute("name", "eye-off-outline"); // Change to eye-off icon
            } else {
                passwordField.type = "password"; // Hide the password
                toggleIcon.setAttribute("name", "eye-outline"); // Change to eye icon
            }
        }
        // Password validation
        const passwordField = document.getElementById("password");
        const passwordError = document.getElementById("passwordError");
        passwordField.addEventListener("input", function() {
            const passwordValue = passwordField.value;
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/;  // Regex for capital letter, number, and special character
            if (passwordPattern.test(passwordValue)) {
                passwordError.style.display = "none"; // Hide error message
            } else {
                passwordError.style.display = "block"; // Show error message
            }
        });
    </script>
<div class="ownercontact">
    <div class="contactname">
        <label for="">Contact:</label>
    </div>
    <div class="contactinput">
        <input type="text" id="contact" name="contact" placeholder="Enter Contact Number (09-0000-0000)" required>
    </div>
    <div id="contactError" class="error-message" style="display: none;">
        <p>Contact number must start with "09" and be 11 digits long.</p>
    </div>
</div>
<script>
    var contactInput = document.getElementById('contact');
    var errorSpan = document.getElementById('contactError');
    contactInput.addEventListener('input', function(event) {
        var input = event.target.value;
        // Update regex to ensure it starts with "09" and is 11 digits long
        var regex = /^09[0-9]{9}$/;
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
                    <label for="">Complete Address:</label>
                </div>
                <div class="addressinput">
                    <input type="text" id="address" name="address" placeholder="Enter Address..." required>
                </div>
            </div>
            <div class="ownercertificate">
                <div class="certificatename">
                    <label for="">Certificate of Ownership:</label>
                </div>
                <div class="certificateinput">
                    <input type="file" id="certificate" name="certificate" required>
                </div>
            </div>
            <div class="buttonbg">
                <button type=submit class="btnLogin-popup1">Request Lot Owner Account</button>
            </div>
    </div>
    </form>
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
</div>
<div id="messageBox" class="messageBox">
    <p id="messageText"></p>
</div>
<script>
    function openPDF() {
        var pdfPath = 'paymentinstruction/How-to-Locate-Decendent-3.pdf';
        window.open(pdfPath, '_blank');
    }
    function openRequest() {
        var RequestPath = 'requestaccount.php';
        window.open(RequestPath, '_blank');
    }
</script>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
</body>
</html>