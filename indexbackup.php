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
    <link rel="stylesheet" href="indexcssbackup.css">


    
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
                        </a></p>
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
    
    <!-- <div class="home-inp">
        <form action="#">
            <input type="search" placeholder="Search for Products">
            <input type="submit" placeholder="Search">
        </form>
    </div> -->

   <div class="hometext">
    <model-viewer id="myModelViewer" src="3dmodels/providence logi.gltf" alt="A 3D model of a walking character" 
    shadow-intensity="3" ar animation-name="animation_name" autoplay="speed: 0.5" 
    class="providence3dlogo" camera-orbit="120deg 83deg 3m" >
    </model-viewer>

    
        <h4>Antipolo</h4>
        <h1>Providence <br>Memorial Park</h1>
        <p >"A place where memories live forrever"<br>
            Providence Memorial Park is a private cemetery that offers<br> memorial lot from lawn lot to mausoleums
            
            </p>
            <button class="locate" onclick="openPDF()">How to Locate Descendants</button>
            <button class="locate" onclick="openRequest()">Request for Account Creation</button>

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
        
    </div>

    <div class="about">


        <h1>Providence Memorial Park</h1>
        <p >Providence Memorial Park in Antipolo offers a serene and peaceful environment, perfect<br>
            for honoring and remembering loved ones. Surrounded by lush landscapes and well-maintained gardens, <br>
            the park provides a comforting space where visitors can find solace.The calming pathways, <br>
            lined with trees and blooming flowers, create a reflective atmosphere,  making it a beautiful setting<br>
            for both traditional burial plots and columbarium niches.<br>
            Conveniently located in the tranquil hills of Antipolo, Providence Memorial Park is just far <br>
            enough from the city to offer a quiet retreat, while still being easily accessible for regular visits.<br>
            Its scenic views and tranquil surroundings  offer a place of peace and reflection, making it an <br>
            ideal choice for families seeking a  ideal choice for families seeking a <br>

            
        </p>
            <model-viewer class="providencemap" src="3dmodels/providencemap.gltf" alt="A 3D model of a walking character" 
            shadow-intensity="5" ar animation-name="animation_name" autoplay="speed: 0.5" 
            class="providence3dlogo" camera-orbit="80deg 73deg 3m"> 
            </model-viewer>
            
    </div>
<div class="providencephotos">

<div class="photodescription">
                    <p >Providence Memorial Park in Antipolo offers a serene and peaceful environment, perfect
            for honoring and remembering loved ones. Surrounded by lush landscapes and well-maintained gardens,
            the park provides a comforting space where visitors can find solace.The calming pathways, 
            lined with trees and blooming flowers, create a reflective atmosphere,  making it a beautiful setting
            for both traditional burial plots and columbarium niches.
            Conveniently located in the tranquil hills of Antipolo, Providence Memorial Park is just far 
            enough from the city to offer a quiet retreat, while still being easily accessible for regular visits.


            
        </p>
</div>

<div class="photosofprovidence">
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


</div>

    <div class="footer">
    <div class="footer-column">
        <h3>Contact Us</h3>
        <p>Email: <a href="mailto:info@providencememorial.com">info@providencememorial.com</a></p>
        <p>Phone: (123) 456-7890</p>
        <p>Address: 1234 Memorial Park Lane, Antipolo, Philippines</p>
        <p>Office Hours: Monday - Friday, 9 AM - 5 PM</p>
        <p>Customer Support: <a href="tel:18001234567">1-800-123-4567</a> (24/7)</p>
    </div>
    <div class="footer-column">
        <h3>About Us</h3>
        <p>Providence Memorial Park in Antipolo offers a serene and peaceful environment, perfect for honoring and 
        remembering loved ones.</p>
        <p>Established in 1980, we have been dedicated to providing compassionate and respectful services. Our park is 
        designed to offer comfort and solace to families and friends.</p>
        <p>We also offer various services including burial plots, memorial services, and maintenance of gravesites.</p>
    </div>
    <div class="footer-column">
        <h3>Follow Us</h3>
        <p>Stay connected through our social media channels for updates, events, and more:
        Join our community and be part of our events where we celebrate and honor memories.</p>
        <p>Sign up for our newsletter to receive the latest news and offers directly in your inbox.</p>
        <p><a href="#">Facebook</a> | 
        <a href="#">Twitter</a> | 
        <a href="#">Instagram</a></p>
    </div>
</div>


<!-- 
 <div class="hero-img">
        <img src="photocopymachineweb.png" >
    </div> -->

        
    <script src="hpscript.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
    
</body>
</html>
