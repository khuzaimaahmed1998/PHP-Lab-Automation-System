<?php

// Include the connection file
require 'connections/testing_connection.php';

// Check if the form is submitted
if (isset($_POST["productidEditt"])) {
    // Retrieve data from the form
    $productid = $_POST["productidEditt"];
    $testingrevise = $_POST["testingreviseEditt"];
    $productcode = $_POST["productcodeEditt"];
    $productname = $_POST["productnameEditt"];
    $testingresult = $_POST["testingresultEditt"];
    $id = $_POST["editid"];

    // SQL query to update the testing process
    $sql = "UPDATE testing_process SET product_id = '$productid', testing_revise = '$testingrevise', product_code = '$productcode', product_name = '$productname', testing_result = '$testingresult' WHERE sno ='$id'";

    // Execute the query
    $result = mysqli_query($con, $sql);

    // Check if the query executed successfully
    if ($result) {
        // Display success message
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        Product Updated Successfully!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        // Redirect to testing records page
        header("Location:../../testing_records.php");
    } else {
        // Display error message if update failed
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Failed updating product. Please try again.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}
?>
