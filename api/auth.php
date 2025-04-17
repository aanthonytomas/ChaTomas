<?php
require_once "../includes/db.php";
require_once "../includes/functions.php";

// Set header to JSON
header('Content-Type: application/json');

// Start the session
start_session_if_not_started();

// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Process authentication request
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($data['action'])) {
            switch ($data['action']) {
                case 'login':
                    if (isset($data['username']) && isset($data['password'])) {
                        $username = secure_input($data['username']);
                        $password = $data['password']; // Don't escape password before verification
                        
                        if (authenticate_user($username, $password)) {
                            echo json_encode(["success" => true, "username" => $username]);
                        } else {
                            echo json_encode(["error" => "Invalid username or password"]);
                        }
                    } else {
                        echo json_encode(["error" => "Username and password are required"]);
                    }
                    break;
                    
                case 'register':
                    if (isset($data['username']) && isset($data['email']) && isset($data['password'])) {
                        $username = secure_input($data['username']);
                        $email = secure_input($data['email']);
                        $password = $data['password']; // Don't escape password before hashing
                        
                        if (register_user($username, $email, $password)) {
                            echo json_encode(["success" => true]);
                        } else {
                            echo json_encode(["error" => "Error registering user"]);
                        }
                    } else {
                        echo json_encode(["error" => "All fields are required"]);
                    }
                    break;
                    
                case 'logout':
                    // Unset all session variables
                    $_SESSION = array();
                    
                    // Destroy the session
                    session_destroy();
                    
                    echo json_encode(["success" => true]);
                    break;
                    
                default:
                    echo json_encode(["error" => "Invalid action"]);
                    break;
            }
        } else {
            echo json_encode(["error" => "Action is required"]);
        }
        break;
        
    default:
        echo json_encode(["error" => "Method not allowed"]);
        break;
}
?>