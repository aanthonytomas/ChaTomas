<?php
require_once "includes/functions.php";

start_session_if_not_started();

// Check if the user is already logged in
if (is_logged_in()) {
    header("location: chat.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="welcome-container">
            <h1>Welcome to Chat App</h1>
            <p>Connect with friends and chat in real-time!</p>
            <div class="button-group">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn">Register</a>
            </div>
        </div>
    </div>
</body>
</html>