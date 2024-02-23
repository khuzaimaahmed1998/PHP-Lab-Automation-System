<?php
// Including testing connection file
require "assets/php/connections/testing_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Remake Failed Products
    if (isset($_POST["productRemake"])) {
        $productID = $_POST["productRemake"];
        // Update remake_required column for the targeted product
        $sql = "UPDATE testing_process SET remake_required = 'Yes' WHERE product_id = '$productID'";
        // Execute the query
        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Product marked for remake successfully!');</script>";
        } else {
            echo "Error updating record: " . $con->error;
        }
    }
    
    // Coordinate Further Testing
    if (isset($_POST["coordinateTesting"])) {
        $testingID = $_POST["coordinateTesting"];
        // Update testing_type and next_testing_step for the targeted testing
        $sql = "UPDATE testing_process SET testing_type = 'Further Testing', next_testing_step = 'Coordinate with CPRI' WHERE testing_id = '$testingID'";
        // Execute the query
        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Further testing coordinated successfully!');</script>";
        } else {
            echo "Error updating record: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | Financial Management</title>
    <!-- Custom styling for footer -->
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php require "assets/php/navbar.php"; ?><br><br>

    <!-- Financial Management Container -->
    <div class="container mt-5" style="min-height: 65vh;">
        <h2 class="text-center mb-4">Financial Management</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <h3>Handle Financial Aspects</h3>
                <!-- Form for handling financial aspects -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Input field for remaking failed products -->
                    <div class="mb-3">
                        <label for="productRemake" class="form-label">Remake Failed Products</label>
                        <input type="text" class="form-control" id="productRemake" name="productRemake" placeholder="Enter product ID">
                    </div>
                    <!-- Input field for coordinating further testing -->
                    <div class="mb-3">
                        <label for="coordinateTesting" class="form-label">Coordinate Further Testing</label>
                        <input type="text" class="form-control" id="coordinateTesting" name="coordinateTesting" placeholder="Enter testing ID">
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>View Financial Reports and Analytics</h3>
                <!-- View reports button -->
                <div class="mt-3">
                    <a href="reports.php" class="btn btn-success">View Reports</a>
                </div>
                <!-- View analytics button -->
                <div class="mt-3">
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#analyticsModal">View Analytics</button>
                </div>
            </div>
        </div>
        <!-- Analytics Modal -->
        <div class="modal fade" id="analyticsModal" tabindex="-1" aria-labelledby="analyticsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="analyticsModalLabel">Analytics</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Testing Summary</h5>
                        <?php
                        // Query to fetch testing summary
                        $sql = "SELECT COUNT(*) AS total_products, 
                                    SUM(CASE WHEN testing_result = 'Pass' THEN 1 ELSE 0 END) AS passed_products,
                                    SUM(CASE WHEN testing_result = 'Fail' THEN 1 ELSE 0 END) AS failed_products
                                FROM testing_process";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Display testing summary
                            echo "<p>Total Products: " . $row["total_products"] . "</p>";
                            echo "<p>Passed Products: " . $row["passed_products"] . "</p>";
                            echo "<p>Failed Products: " . $row["failed_products"] . "</p>";
                        } else {
                            echo "No data available";
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>

    <!-- Footer -->
    <?php require "assets/php/footer.php"; ?>

    <!-- Bootstrap script link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Logout Validation -->
    <script src="assets/js/logout.js"></script>

</body>

</html>
