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
        // Get messages
        if (isset($_GET['last_id'])) {
            $last_id = secure_input($_GET['last_id']);
            $messages = get_new_messages($last_id);
        } else {
            $messages = get_messages();
        }
        
        echo json_encode($messages);
        break;
        
    case 'POST':
        // Save a new message
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($data['message']) && !empty($data['message'])) {
            $message = secure_input($data['message']);
            $sender_id = $_SESSION["id"];
            
            $message_id = save_message($sender_id, $message);
            
            if ($message_id) {
                // Get the newly created message to return it
                $new_messages = get_new_messages($message_id - 1);
                echo json_encode($new_messages);
            } else {
                echo json_encode(["error" => "Error saving message"]);
            }
        } else {
            echo json_encode(["error" => "Message cannot be empty"]);
        }
        break;
        
    default:
        echo json_encode(["error" => "Method not allowed"]);
        break;
}
?>