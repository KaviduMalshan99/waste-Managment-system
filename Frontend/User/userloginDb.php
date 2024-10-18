<?php
include 'db_connect.php'; // Ensure this path is correct

session_start(); // Start a new session or resume the existing one

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // Get the password from POST

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.location.href = 'userlogin.html';</script>";
        exit();
    }
    // SQL to check if the email exists in the database
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(); // Regenerate session ID for security
            $_SESSION['user_id'] = $user['id']; // Store user id in session
            header("Location: userProfile.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password.'); window.location.href = 'userlogin.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href = 'userlogin.html';</script>";
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
