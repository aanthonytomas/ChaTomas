<?php
require_once "includes/functions.php";

// Check if user is logged in
redirect_if_not_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | Chat App</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h1>Chat App</h1>
            <div class="user-info">
                Welcome, <span id="username"><?php echo sanitize_output($_SESSION["username"]); ?></span>
                <a href="logout.php" class="btn btn-small">Logout</a>
            </div>
        </div>
        
        <div class="chat-main">
            <div class="chat-sidebar">
                <h3>Online Users</h3>
                <ul id="users-list">
                    <!-- User list will be populated dynamically -->
                </ul>
            </div>
            
            <div class="chat-messages">
                <div id="messages">
                    <!-- Messages will be populated dynamically -->
                </div>
            </div>
        </div>
        
        <div class="chat-form-container">
            <form id="chat-form">
                <input type="text" id="message" placeholder="Type a message..." required autocomplete="off">
                <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Send</button>
            </form>
        </div>
    </div>
    
    <script>
        // Pass the current user's data to JavaScript
        const currentUser = {
            id: <?php echo $_SESSION["id"]; ?>,
            username: "<?php echo sanitize_output($_SESSION["username"]); ?>"
        };
    </script>
    <script src="assets/js/chat.js"></script>
</body>
</html>