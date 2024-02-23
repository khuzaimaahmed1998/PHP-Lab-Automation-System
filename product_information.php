<?php
// Include the connection to the database
require "assets/php/connections/testing_connection.php";

$result = array();
$count = 1;

// Check if the form is submitted and the required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productCode']) && isset($_POST['testingID'])) {
    // Get the values from the form
    $productCode = $_POST['productCode'];
    $testingID = $_POST['testingID'];

    // Prepare and execute the SQL query to retrieve data based on product code and testing ID
    $sql = "SELECT * FROM testing_process WHERE product_code = ? AND testing_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $productCode, $testingID);
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | Product Information</title>
    <link rel="stylesheet" href="assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container label {
            font-size: 17px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <?php require "assets/php/navbar.php"; ?>
    <br><br>

    <div class="container mt-5" style="min-height: 85vh;">
        <!-- Search bar -->
        <hr>
        <h3 class="text-center">Search bar</h3>
        <hr>
        <!-- Form for searching product information -->
        <form action="product_information.php" method="POST">
            <input type="hidden" name="detailsvalue" id="detailsvalue" value="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="productCode" class="form-label">Product Code</label>
                    <input type="text" class="form-control" name="productCode" id="productCode" placeholder="Enter product code" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="testingID" class="form-label">Testing ID</label>
                    <input type="text" class="form-control" name="testingID" id="testingID" placeholder="Enter testing ID" required>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form><br><br>

        <!-- Table displaying product details -->
        <hr>
        <h3 class="text-center">Search Results</h3>
        <hr>
        <!-- Table to display search results -->
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Code</th>
                    <th>Product ID</th>
                    <th>Testing Revise</th>
                    <th>View Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results from the query
                if ($result instanceof mysqli_result && $result->num_rows > 0) {
                    // Loop through each row of the result
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $row['product_code'] . "</td>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $row['testing_revise'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display a message if no records are found
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table><br><br>

    </div><br><br>

    <!-- Footer -->
    <?php require "assets/php/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/logout.js"></script>
</body>

</html>
