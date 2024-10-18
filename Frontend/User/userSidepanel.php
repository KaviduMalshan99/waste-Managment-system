<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        aside {
            width: 280px; 
            height: 100vh; 
            background-color: #404A3D; 
            color: white; 
            position: fixed; 
            left: 0; 
            top: 0; 
            padding-top: 20px; 
            box-shadow: 4px 0 10px rgba(0,0,0,0.5);
            overflow-y: auto; /* Adds scroll */
        }

        aside ul {
            list-style: none; 
            padding: 0; 
            margin: 0;
        }

        aside ul li a {
            display: flex; 
            align-items: center; 
            padding: 15px 20px; 
            color: white; 
            text-decoration: none; 
            font-size: 16px; 
            transition: background-color 0.3s; /* Smooth transition for hover effect */
            border-bottom: 1px solid #556; /* Darker border for more depth */
        }

        aside ul li a:hover {
            background-color: #506450; /* Slightly lighter green for hover */
            cursor: pointer;
        }

        aside ul li a i {
            width: 30px; /* Ensures icons align well */
            text-align: center;
            margin-right: 15px; /* More space between icon and text */
        }
    </style>
</head>
<body>

    <!-- Banner Section with Inline Styles -->
    <aside>
        <ul>
            <li><a href="/profile"><i class="fas fa-user"></i> MY Profile</a></li>
            <li><a href="/waste-plan"><i class="fas fa-recycle"></i> Waste Plan</a></li>
            <li><a href="/payment"><i class="fas fa-credit-card"></i> Payment</a></li>
            <li><a href="/reviews"><i class="fas fa-star"></i> My Reviews</a></li>
            <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
    </aside>

</body>
</html>
