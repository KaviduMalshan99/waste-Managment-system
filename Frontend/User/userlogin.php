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
            <form action="userloginDb.php" method="POST">
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



</body>
</html>
