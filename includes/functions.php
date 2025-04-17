<?php
// Start session if not already started
function start_session_if_not_started() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Function to check if user is logged in
function is_logged_in() {
    start_session_if_not_started();
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

// Function to redirect if not logged in
function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("location: login.php");
        exit;
    }
}

// Function to escape user inputs for security
function secure_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

// Function to sanitize output
function sanitize_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>