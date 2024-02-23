<?php
// Start the session
session_start();

// Check if the logout form is submitted via POST method and logout button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page after logout
    header("refresh:1;url=login.php"); 
    // Exit the script
    exit;
}
?>
