<?php
// Start the session
session_start();

// Check if session variable "loggedIN" is not set or not true
if (!isset($_SESSION["loggedIN"]) || $_SESSION["loggedIN"] != true) {
    // Redirect to login.php
    header("location:login.php");
    exit;
}
?>
