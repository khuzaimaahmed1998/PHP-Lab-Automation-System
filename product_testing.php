<?php
require "assets/php/auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | Product Testing</title>
    <!-- Custom styling for footer -->
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Increasing font-size and font-weight for labels */
        .container label {
            font-size: 17px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php require "assets/php/navbar.php"; ?><br><br>

    <!-- Testing Form Container -->
    <div class="container mt-5" style="min-height: 85vh;">
        <div class="row mb-4">
            <div class="col-md-12">
                <?php
                // Check if form is submited
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    require "assets/php/connections/testing_connection.php";
                    // Check if found "testing_id"
                    if (isset($_POST["testing_id"])) {
                        // Variables of every input fields values

                        $testing_id = $_POST["testing_id"];
                        $product_id = $_POST["product_id"];
                        $testing_revise = $_POST["testing_revise"];
                        $product_code = $_POST["product_code"];
                        $product_name = $_POST["product_name"];
                        $product_description = isset($_POST["product_description"]) ? $_POST["product_description"] : null;
                        $product_price = isset($_POST["testing_price"]) ? $_POST["testing_price"] : null;
                        $testing_date = $_POST["testing_date"];
                        $testing_type = $_POST["testing_type"];
                        $testing_result = $_POST["testing_result"];
                        $remake_required = isset($_POST["remake_required"]) ? $_POST["remake_required"] : null;
                        $next_testing_step = $_POST["next_testing_step"];
                        $created_at = $_POST["created_at"];
                        $remarks = isset($_POST["remarks"]) ? $_POST["remarks"] : null;
                        $testing_duration = isset($_POST["testing_duration"]) ? $_POST["testing_duration"] : null;
                        $last_modified_at = $_POST["last_modified_at"];
                        $modified_by = $_POST["modified_by"];
                        $product_category = $_POST["product_category"];
                        $product_type = $_POST["product_type"];
                        $manufacturer = isset($_POST["manufacturer"]) ? $_POST["manufacturer"] : null;
                        $expiry = isset($_POST["expiry_date"]) ? $_POST["expiry_date"] : null;

                        // Query to store data in testing_process table
                        $sql = "INSERT INTO testing_process (product_code, product_id, product_name, product_description, product_price, testing_id, testing_date, testing_type, testing_result, remake_required, next_testing_step, created_at, remarks, testing_duration, last_modified_at, modified_by, testing_revise, product_category, product_type, manufacturer, expiry_date) VALUES ('$product_code', '$product_id', '$product_name', '$product_description', '$product_price', '$testing_id', '$testing_date', '$testing_type', '$testing_result', '$remake_required', '$next_testing_step', '$created_at', '$remarks', '$testing_duration', '$last_modified_at', '$modified_by', '$testing_revise', '$product_category', '$product_type', '$manufacturer', '$expiry')";
                        // Query Execution
                        $result = mysqli_query($con, $sql);

                        // Check if query executed successfully, show success message
                        if ($result) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Product has been added successfully. <a href='testing_records.php'>See records!</a>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                            // Else show error message
                        } else {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Oops! Something went wrong while adding the product. Please try again later or contact support for assistance.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                    }
                }

                ?>


                <h3>Add New Product</h3>
                <form id="product_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-4">
                        <label for="testing_id" class="form-label">Testing ID</label>
                        <input type="text" class="form-control" id="testing_id" name="testing_id" readonly aria-label="Testing ID">
                    </div>
                    <div class="mb-4">
                        <label for="product_id" class="form-label">Product ID</label>
                        <input type="text" class="form-control" id="product_id" name="product_id" placeholder="Product ID" aria-label="Product ID" oninput="checkProductID()" required>
                    </div>
                    <div class="mb-4">
                        <label for="testing_revise" class="form-label">Testing Revise</label>
                        <input type="text" class="form-control" id="testing_revise" name="testing_revise" placeholder="Testing Revise" aria-label="Testing Revise" required>
                    </div>
                    <div class="mb-4">
                        <label for="product_code" class="form-label">Product Code</label>
                        <input type="text" class="form-control" name="product_code" placeholder="Product Code" aria-label="Product Code" required>
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name" placeholder="Product Name" aria-label="Product Name" required>
                    </div>
                    <div class="mb-4">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" name="product_description" rows="3"></textarea>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input type="number" class="form-control" name="product_price" placeholder="Product Price" aria-label="Product Price">
                            </div>
                            <div class="col">
                                <label for="testing_date" class="form-label">Testing Date</label>
                                <input type="date" class="form-control" name="testing_date" aria-label="Testing Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="testing_type" class="form-label">Testing Type</label>
                        <select class="form-select" name="testing_type" aria-label="Testing Type" required>
                            <option selected disabled>Select Testing Type</option>
                            <option value="Physical">Physical</option>
                            <option value="Chemical">Chemical</option>
                            <option value="Microbiological">Microbiological</option>
                            <option value="Analytical">Analytical</option>
                            <option value="Molecular">Molecular</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="product_category" class="form-label">Product Category</label>
                        <select class="form-select" name="product_category" aria-label="Product Category" required>
                            <option selected disabled>Select Product Category</option>
                            <?php
                            require "assets/php/connections/testing_connection.php";

                            $sql = "SELECT category_id, category_name FROM product_categories";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="product_type" class="form-label">Product Type</label>
                                <input type="text" class="form-control" name="product_type" placeholder="Enter Product Type" aria-label="Product Type" required>
                            </div>
                            <div class="col">
                                <label for="testing_result" class="form-label">Testing Result</label>
                                <input type="text" class="form-control" name="testing_result" placeholder="Testing Result" aria-label="Testing Result" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Remake Required?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="remake_required" id="remake_yes" value="Yes">
                            <label class="form-check-label" for="remake_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="remake_required" id="remake_no" value="No">
                            <label class="form-check-label" for="remake_no">No</label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col">
                                <label for="next_testing_step" class="form-label">Next Testing Step</label>
                                <input type="text" class="form-control" name="next_testing_step" placeholder="Next Testing Step" aria-label="Next Testing Step" required>
                            </div>
                            <div class="col">
                                <label for="created_at" class="form-label">Created At</label>
                                <input type="datetime-local" class="form-control" name="created_at" aria-label="Created At" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="remarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control" name="remarks" placeholder="Remarks" aria-label="Remarks">
                    </div>
                    <div class="mb-4">
                        <label for="testing_duration" class="form-label">Testing Duration</label>
                        <select class="form-select" id="testing_duration_select" name="testing_duration" aria-label="Testing Duration">
                            <option selected disabled>Select Testing Duration</option>
                            <option value="1 hour">1 hour</option>
                            <option value="2 hours">2 hours</option>
                            <option value="3 hours">3 hours</option>
                            <option value="other">Other</option>
                        </select>
                        <div id="other_duration" style="display: none;">
                            <input type="text" class="form-control mt-2" id="custom_duration" name="testing_duration" placeholder="Enter Custom Duration">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="last_modified_at" class="form-label">Last Modified At</label>
                        <input type="datetime-local" class="form-control" name="last_modified_at" aria-label="Last Modified At" required>
                    </div>
                    <div class="mb-4">
                        <label for="modified_by" class="form-label">Modified By</label>
                        <?php require "assets/php/user_data.php"; ?>
                        <input type="text" class="form-control" name="modified_by" value="<?php echo $firstName . "&nbsp;" . $lastName ?>" aria-label="Testing Duration" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="manufacturer" aria-label="Manufacturer">
                    </div>
                    <div class="mb-4">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="expiry_date" aria-label="Expiry Date" aria-describedby="expiry_date_icon" hidden>
                            <button class="btn btn-outline-secondary" type="button" id="expiry_date_icon"><i class="bi bi-calendar"></i></button>
                        </div>
                    </div><br>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                    <a href="testing_records.php" class="float-end" style="font-size: 18px; font-weight: 500">See Records List</a>
                </form>



            </div>
        </div>
    </div><br><br><br>

    <!-- Footer -->
    <?php require "assets/php/footer.php"; ?>
    <!-- Bootstrap script link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Logout validation -->
    <script src="assets/js/logout.js"></script>
    <!-- Form Validation -->
    <script src="assets/js/form_validation.js"></script>
</body>

</html>