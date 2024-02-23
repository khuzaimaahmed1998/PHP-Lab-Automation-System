<?php
// Establishing connection to the database
$con = mysqli_connect("localhost", "root", "", "testing_process");

// Checking if connection is successful
if (!$con) {
    // If connection fails, display error message and terminate script
    die("Connection Failed: " . mysqli_connect_error());
}
?>
