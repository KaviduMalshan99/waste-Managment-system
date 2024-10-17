<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="userlogin.css">
</head>
<body>

    <!-- Login Banner -->
    <section class="banner">
    <img src="../../assets/images/user/userloghead.png" alt="usersection" class="banner-img">
    <h1>REGISTER</h1>
</section>

    <!-- Login Form -->
    <section class="login-section">
        <div class="login-box">
            <h2>LOGIN</h2>
            <form action="#" method="POST">
                <div class="input-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="yourname@gmail.com" required>
                </div>

                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="*************" required>
                </div>

                <div class="social-login">
                    <button class="google-login">Log in with Google</button>
                    <button class="facebook-login">Sign up with Facebook</button>
                </div>

                <button type="submit" class="login-btn">Login</button>

                <div class="extra-links">
                    <p>Don’t have an account? <a href="userRegister.php">Create an account</a></p>
                    <a href="#">Forgot your password?</a>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <!-- <footer>
        <div class="footer-content">
            <div class="about">
                <h3>About</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
                <form action="#">
                    <input type="email" placeholder="Enter your email">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="links">
                <h3>Links</h3>
                <ul>
                    <li><a href="#">Request Pickup</a></li>
                    <li><a href="#">Management</a></li>
                    <li><a href="#">Start Service</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="services">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Dumpster Rentals</a></li>
                    <li><a href="#">Bulk Trash Pickup</a></li>
                    <li><a href="#">Waste Removal</a></li>
                    <li><a href="#">Zero Waste</a></li>
                </ul>
            </div>
            <div class="contact">
                <h3>Contact</h3>
                <p>880 Brooklyn Road Street, New Town DC 50002, New York, USA</p>
                <p>Email: needhelp@gmail.com</p>
                <p>Phone: +1 (246) 333-0088</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Copyright 2024 LayerDrops. All Rights Reserved.</p>
        </div>
    </footer> -->

</body>
</html>
