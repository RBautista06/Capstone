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
    <link rel="stylesheet" href="requestaccount.css">




</head>

<body class="loaded">
    <header>
        <h2 class="logo"></h2>
        <nav class="navigation">
            <a href="index.php">Home</a>
            <a href="requestaccount.php">Request for Account Creation</a>
            <a href="indexservices.php">Services & FaQs</a>
            <a href="aboutus.php">About us</a>

            <button class="btnLogin-popup">Login</button>
        </nav>
    </header>
    <img src="pictures/tree.png" alt="" class="treedesign">
    <img src="pictures/tree.png" alt="" class="treedesign1">

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
                </div>
            </form>
        </div>
    </div>




    <div class="detailstable">
        <h1><img src="pictures/requestowneraccount.png" alt="" class="small-image"></h1>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const backButton = document.getElementById('backButton');

                backButton.addEventListener('click', function() {
                    window.location.href = 'listaccs.php';
                });
            });
        </script>
        <div class="passbuttons">



        </div>
        <div class="listaccs3d">
            <model-viewer id="myModelViewer" src="3dmodels/requestaccount.gltf" alt="A 3D model of a walking character"
                shadow-intensity="1" animation-name="animation_name" autoplay="speed: 0.8"
                class="logolistaccs3d" camera-orbit="20deg 90deg 7m" exposure="0.7">
            </model-viewer>
        </div>



        <div class="ownercreation">

            <form action="requestaccount_process.php" method="POST" enctype="multipart/form-data">
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
                        <label for="">Password :</label>
                    </div>
                    <div class="passwordinput">
                        <input type="password" id="password" name="password" placeholder="Password..." required>
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



    <script src="hpscript.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

</body>

</html>