<?php
// Require testing connection file
require 'connections/testing_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if "del" is set in the POST request
    if (isset($_POST["del"])) {
        // SQL query to delete all records from testing_process table
        $clearall= "DELETE FROM testing_process";
        
        // Execute the query
        $res= mysqli_query($con, $clearall);

        // Redirect to testing_records.php after deletion
        header("Location: ../../testing_records.php");
    }
}
?>
