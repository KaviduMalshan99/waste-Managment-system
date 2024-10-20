<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Section</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .admin-container {
            display: flex;
            min-height: 00vh;
        }

        .sidebar {
            background-color:#404A3D;
            color: #fff;
            width: 250px;
            padding: 28px;
            min-height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul2 {
            list-style-type: none;
            margin-top: 50px;
        }

        .sidebar ul2 li2 {
            margin: 20px 0px 0px 20px;
        }

        .sidebar ul2 li2 a {
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            display: block;
            padding: 15px;
            border-radius: 20px;
        }

        .sidebar ul2 li2 a:hover {
            background-color: #575757;
        }

        .signout-container {
            text-align: center;
            margin-top: 140%;
            max-width:200px;
        }

        .signout-btn {
            background-color: rgb(231, 14, 14); 
            color: white;
            font-size:22px;
            padding: 12px 22px;
            text-decoration: none;
            border-radius: 10px;
        }

        .signout-btn:hover {
            background-color: rgb(238, 43, 43); 
        }

        .dashboard-boxes {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            margin-top: 20px;
            background-color: rgb(240, 236, 233);
            padding: 30px;
            border-radius: 20px;
        }

        .dashboard-boxes .sec2 {
            display: flex;
            justify-content: space-around;
            padding: 30px;
            border-radius: 20px;
        }

        .box {
            background-color: #000000;
            color: #fff;
            padding: 20px;
            border-radius: 20px;
            width: 200px;
            text-align: center;
        }

        .box h3 {
            margin-bottom: 10px;
        }

        .box p {
            font-size: 24px;
            font-weight: bold;
        }

        .logo-container {
            height: 120px;
            width: 300px;
            display: flex;
            align-items: center;
            margin-left: 30px;
        }

        .logo-container img {
            height: 70px;
            width: 140px;
        }
    </style>
</head>
<body>
    
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-container">
                <img src="../../assets/images/user/sideim.png" alt="sideimage" class="company-logo">
            </div>

            <ul2>
                <li2><a href="userProfile.php">My Profile</a></li2>
                <li2><a href="mywaste.php">Waste Plans</a></li2>
                <li2><a href="">Scheduled Pickup</a></li2>
                <li2><a href="">All Transactions</a></li2>
            </ul2>

            <div class="signout-container">
                <a href="userlogin.php" class="signout-btn">Sign Out</a>
            </div>
        </div>

        <!-- Main Content Area -->
        
        </div>
    </div>
</body>
</html>
