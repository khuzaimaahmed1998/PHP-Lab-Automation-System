<!-- Authentication Check -->
<?php require "assets/php/auth.php";  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | Product Records List</title>
    <!-- Footer CSS -->
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS v4.6.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Inline Style -->
    <style>
        .container label {
            font-size: 17px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <?php
    // Include navigation bar
    require "assets/php/navbar.php";
    ?>
    <br><br>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="assets/php/edit.php">

                        <input type="hidden" name="editid" id="editidd">
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Product ID</label>
                            <input type="text" class="form-control" name="productidEditt" id="productidEdit">
                        </div>
                        <div class="mb-3">
                            <label for="testing_revise" class="form-label">Testing Revise</label>
                            <input type="text" class="form-control" name="testingreviseEditt" id="testingreviseEdit">
                        </div>
                        <div class="mb-3">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" class="form-control" name="productcodeEditt" id="productcodeEdit">
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="productnameEditt" id="productnameEdit">
                        </div>
                        <div class="mb-3">
                            <label for="testing_result" class="form-label">Testing Result</label>
                            <input type="text" class="form-control" name="testingresultEditt" id="testingresultEdit">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php
    // Include connection script
    require 'assets/php/connections/testing_connection.php';

    // Delete record if deletevalue is set
    if (isset($_GET["deletevalue"])) {
        $sno = $_GET["deletevalue"];

        $sql = "DELETE FROM testing_process WHERE sno = '$sno'";
        $result =  mysqli_query($con, $sql);

        if ($result) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Targeted Record has been deleted successfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Failed to delete the record. Please try again later.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
    ?>

    <div class="container mt-5" style="min-height: 85vh;">
        <!-- Testing Records Table -->
        <div class="table-responsive">
            <table class="table table-sm" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Testing ID</th>
                        <th>Product ID</th>
                        <th>Testing Revise</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Testing Result</th>
                        <?php
                        // Include user data script if the role is Admin
                        require "assets/php/user_data.php";
                        if (isset($_SESSION["role"]) == "Admin") { ?>
                            <th>Actions</th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require "assets/php/connections/testing_connection.php";

                    $query = "SELECT * FROM testing_process ";
                    $result = $con->query($query);
                    $count = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $row["testing_id"] . "</td>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["testing_revise"] . "</td>";
                            echo "<td>" . $row["product_code"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["testing_result"] . "</td>";
                            if ($_SESSION["role"] == "Admin") {
                                echo "<td><button type='button' class='btn btn-primary edit' id=" . $row["sno"] . " >Edit</button>  <button type='button' class='btn btn-danger delete' id=" . $row["sno"] . ">Delete</button></td>";
                            } else {
                                echo "<td>Restricted</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>
                            <td colspan='4'>No products found</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table><br><br>

            <?php if ($_SESSION["role"] == "Admin") {
                echo "<form action='assets/php/clearall.php' method='POST'>
                <input type='hidden' name='del'>
                <div class='d-grid gap-2 col-6 mx-auto'>
                    <button class='btn btn-danger ClearAll' type='submit'>Clear All</button>
                </div>
            </form>";
            }  ?>
        </div>
    </div>

    <?php require "assets/php/footer.php"; ?>

    <!-- Delete Script -->
    <script src="assets/js/delete.js"></script>
    <!-- Clear All Script -->
    <script src="assets/js/clearall.js"></script>
    <!-- jQuery Slim -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap v5.3.2 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        // Edit Functionality
        Edits = document.getElementsByClassName("edit");

        Array.from(Edits).forEach((element) => {
            element.addEventListener("click", (e) => {

                tr = e.target.parentNode.parentNode;

                product_id = tr.getElementsByTagName("td")[2].innerText;
                testing_revise = tr.getElementsByTagName("td")[3].innerText;
                product_code = tr.getElementsByTagName("td")[4].innerText;
                product_name = tr.getElementsByTagName("td")[5].innerText;
                testing_result = tr.getElementsByTagName("td")[6].innerText;

                productidEdit.value = product_id;
                testingreviseEdit.value = testing_revise;
                productcodeEdit.value = product_code;
                productnameEdit.value = product_name;
                testingresultEdit.value = testing_result;

                editidd.value = e.target.id;

                $('#editModal').modal('toggle');
            });
        });
    </script>
</body>

</html>
