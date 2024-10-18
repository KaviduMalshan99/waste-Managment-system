<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="userRegister.css"> <!-- Link to your CSS file -->
    <style>
        .toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        .toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
    <script>
        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "toast show";
            setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
        }

        function redirectToLogin() {
            window.location.href = "userlogin.php";
        }
    </script>
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
            <form id="registrationForm" action="userDb.php" method="POST">
                <div class="form-row">
                    <div class="form-groupregis">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-groupregis">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" placeholder="Enter valid email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-groupregis">
                        <label for="contact">Contact Number:</label>
                        <input type="tel" id="contact" name="contact" placeholder="Enter contact number" required>
                    </div>
                    <div class="form-groupregis">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="**********" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-groupregis">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="**********" required>
                    </div>
                    <div class="form-groupregis">
                        <label for="street_address">Street Address:</label>
                        <input type="text" id="street_address" name="street_address" placeholder="Enter your street address" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-groupregis">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="Enter your city" required>
                    </div>
                    <div class="form-groupregis">
                        <label for="postal_code">Postal Code:</label>
                        <input type="text" id="postal_code" name="postal_code" placeholder="Enter postal code">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-groupregis">
                        <label for="state_province">State/Province:</label>
                        <input type="text" id="state_province" name="state_province" placeholder="Enter state or province">
                    </div>
                    <div class="form-groupregis">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Enter your country" required>
                    </div>
                </div>

                <div class="form-groupregis" style="flex-basis: 100%;">
                    <input type="checkbox" id="privacy" name="privacy" required>
                    <label for="privacy">Accept Privacy & Policy</label>
                </div>

                <button type="submit" class="register-btn">Register Now</button>
                <p class="already-account">Already have an Account? <a href="userlogin.php">Log In</a></p>
            </form>
        </div>
    </section>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>

</body>
</html>
