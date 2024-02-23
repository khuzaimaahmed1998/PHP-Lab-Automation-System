<?php

// Including connection file
require "connections/connection.php";

// Starting session if not already started
if (!isset($_SESSION)) {
    session_start();
}

// Retrieving user's email from session
$userEmail = $_SESSION["Email"];

// SQL query to select user information
$query = "SELECT First_Name, Last_Name, Contact, Role FROM user_info WHERE Email = ?";

// Preparing and executing the query
$stmt = $con->prepare($query);
$stmt->bind_param("s", $userEmail);
$stmt->execute();

// Binding result variables
$stmt->bind_result($firstName, $lastName, $contact, $role);

// Fetching the result
$stmt->fetch();

// Closing the statement
$stmt->close();

// Storing user information in session variables
$_SESSION["firstName"] = $firstName;
$_SESSION["lastName"] = $lastName;
$_SESSION["contact"] = $contact;
$_SESSION["role"] = $role;
?>
