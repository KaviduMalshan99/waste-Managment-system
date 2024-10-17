<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="userRegister.css"> <!-- Link to your CSS file -->
</head>
<body>

    <!-- Banner Section -->
    <section class="banner">
    <img src="../../assets/images/user/userloghead.png" alt="usersection" class="banner-img">
    <h1>REGISTRATION</h1>
</section>

    <!-- Registration Form Section -->
    <section class="registration-section">
        <div class="registration-box">
            <h2>REGISTRATION</h2>
            <form action="#" method="POST">
                <div class="form-groupregis">
                    <label for="first-name">First Name :</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>

                <div class="form-groupregis">
                    <label for="last-name">Last Name :</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>

                <div class="form-groupregis">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-groupregis">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-groupregis">
                    <label for="confirm-password">Confirmed Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>

                <!-- <div class="form-groupregis">
                    <label for="area">Select your Area:</label>
                    <input type="text" id="area" name="area" placeholder="Use Google Map">
                </div> -->

                <div class="form-groupregis">
                    <input type="checkbox" id="privacy" name="privacy" required>
                    <label for="privacy">Accept privacy & Policy</label>
                </div>

                <button type="submit" class="register-btn">Register Now</button>

                <p class="already-account">Already have an Account? <a href="userlogin.php">Log In</a></p>
                </form>
        </div>
    </section>

 
</body>
</html>
