<?php
require_once "includes/functions.php";

// Initialize the session
start_session_if_not_started();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>