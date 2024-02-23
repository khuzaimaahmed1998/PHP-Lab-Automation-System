<?php

// Including connection file
require 'connections/connection.php';

// Checking if POST data is set
if (isset($_POST["firstnameEditt"])) {
    // Retrieving data from POST
    $first_name = $_POST["firstnameEditt"];
    $last_name = $_POST["lastnameEditt"];
    $email = $_POST["emailEditt"];
    $contact = $_POST["contactEditt"];
    $role = $_POST["roleEditt"];
    $id = $_POST["editid"];

    // SQL query to update user information
    $sql = "UPDATE user_info SET First_Name = '$first_name', Last_Name = '$last_name', Email = '$email', Contact = '$contact', Role = '$role' WHERE ID ='$id'";

    // Executing the query
    $result = mysqli_query($con, $sql);

    // Checking if query execution was successful
    if ($result) {
        // Displaying success message if update was successful
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> User Information Updated Successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        // Redirecting to user_management.php
        header("Location:../../user_management.php");
    } else {
        // Displaying error message if update was unsuccessful
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> Unable to Update the User Information. Please try again later
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
?>
