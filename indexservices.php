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
    <link rel="stylesheet" href="indexservices.css">
    <link rel="stylesheet" href="indexservices_mediaquery.css">
    <link rel="stylesheet" href="indexnavbar_meduaquery.css">



</head>

<body class="loaded">

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

        <div class="top-section">
            <div class="firstdiv-picture1">
                <img class="img-banner" src="pictures/intermentform.png" alt="">
            </div>
            
            <div class="firsttext">
                <h1>Providence Services</h1>
                <p>
                    "A place where memories live forever"<br>
                    Providence Services is dedicated to providing a range of interment solutions designed<br>
                    to meet the diverse needs of our clients. Our services encompass various interment processes,<br>
                    ensuring that every family can find a respectful and fitting option for their loved ones.<br>
                    Whether you are seeking traditional burial, or other memorialization choices,<br>
                    our team is committed to guiding you through each step<br>
                    with compassion and professionalism.
                </p>

            </div>

            <div class="text3dlogo">
                <model-viewer src="3dmodels/Intermentformlight.gltf" alt="A 3D model of a walking character"
                    shadow-intensity="1" ar animation-name="animation_name" autoplay="speed: 0.5"
                    class="providencegem" camera-orbit="45deg 73d 100m" auto-rotate camera-controls>
                </model-viewer>
            </div>
        </div>

        <div class="bottom-section">
            <h2>Service Price List</h2>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Weekdays</th>
                        <th>Weekends</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include 'dbconnection.php';

                    // Fetch data from the interment_price table
                    $sql = "SELECT NAME, PRICE, WEEKDAYS, WEEKENDS FROM interment_price";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row["NAME"]) . "</td>
                                <td> ₱ " . htmlspecialchars($row["PRICE"]) . "</td>
                                <td> ₱ " . htmlspecialchars($row["WEEKDAYS"]) . "</td>
                                <td> ₱ " . htmlspecialchars($row["WEEKENDS"]) . "</td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No data available</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>


    <div class="about">
        <div class="faqtitle">
            <h1>Providence Memorial Park - Frequently Asked Questions (FAQs)</h1>
        </div>
        <div class="faqinside">
            <h2>1. What types of burial options are available at Providence Memorial Park?</h2>
            <p>Providence Memorial Park offers various burial options, including lawn lots, estate lots, and mausoleums. Lawn lots are smaller, where each burial is done individually. Estate lots are larger and can accommodate mausoleums or multiple burials.</p>

            <h2>2. Can I pre-purchase a lot for future use?</h2>
            <p>Yes, many individuals choose to invest in a lot before it's needed. This ensures that a burial space is available for their loved ones when the time comes. Pre-purchasing allows for better planning and avoids future stress.</p>

            <h2>3. What is the process for scheduling an interment?</h2>
            <p>To schedule an interment, you must first ensure that you have a death certificate and, if applicable, a transfer permit if the deceased is coming from outside Antipolo. After securing these documents and completing the payment for the lot, you can schedule the burial at the park’s office.</p>

            <h2>4. Is there assistance provided for locating burial sites?</h2>
            <p>Yes, the park uses a block and lot system similar to housing developments. For example, sections like "Evergreen Memories" or "Reflection of Life" are labeled by blocks and lots. Clients are provided with a map to easily locate their loved one's resting place.</p>

            <h2>5. What are the maintenance services provided at the park?</h2>
            <p>Providence Memorial Park maintains the general upkeep of the grounds, including grass cutting and pathway maintenance. However, individual grave cleaning is typically handled by the lot owner or their family. The park’s maintenance team will include the grave in grass cutting if it is in the path of the equipment.</p>

            <h2>6. What are the operating hours of the cemetery?</h2>
            <p>Our operating hours are from 8 AM to 6 PM daily, with extended hours for holidays and special occasions.</p>

            <h2>7. How do I schedule an interment or memorial service?</h2>
            <p>You can schedule an interment or memorial service by contacting our office. We recommend reaching out at least one week in advance.</p>

            <h2>8. Does Providence Memorial Park offer pre-need services?</h2>
            <p>Yes, we offer pre-need services to help families plan ahead for future memorial needs.</p>
        </div>
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