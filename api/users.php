<?php
require_once "../includes/db.php";
require_once "../includes/functions.php";

// Set header to JSON
header('Content-Type: application/json');

// Start the session
start_session_if_not_started();

// Check if user is logged in
if (!is_logged_in()) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Get users
        $users = get_users();
        echo json_encode($users);
        break;
        
    default:
        echo json_encode(["error" => "Method not allowed"]);
        break;
}
?>