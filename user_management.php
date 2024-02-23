<?php
// Authentication check
require "assets/php/auth.php";

// Database connection
require "assets/php/connections/connection.php";

// SQL query
$sql = "SELECT * FROM user_info";

// Filtering by role if set
if(isset($_POST['roleFilter'])) {
    $selectedRole = $_POST['roleFilter'];
    if($selectedRole != 'All Roles') {
        $sql = "SELECT * FROM user_info WHERE Role='$selectedRole'";
    }
}

// Execute SQL query
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | User Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS v4.6.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Footer CSS -->
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body>
    <?php require "assets/php/navbar.php"; ?><br><br>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="assets/php/users_edit.php">

                        <input type="hidden" name="editid" id="editidd">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstnameEditt" id="firstnameEdit">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastnameEditt" id="lastnameEdit">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="emailEditt" id="emailEdit">
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="number" class="form-control" name="contactEditt" id="contactEdit">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" name="roleEditt" id="roleEdit">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5" style="min-height: 82vh">
        <hr>
        <h2 class="text-center">User Management</h2>
        <hr>
        <?php
        // Database connection
        require 'assets/php/connections/connection.php';

        // Delete user record if deletevalue is set
        if (isset($_GET["deletevalue"])) {
            $sno = $_GET["deletevalue"];

            $sql = "DELETE FROM user_info WHERE ID = '$sno'";
            $delete_result =  mysqli_query($con, $sql);

            if ($delete_result) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                User Deleted Successfully!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Error in deleting the user!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            }
        }
        ?>

        <div class="mb-3">
            <!-- Filter by Role Form -->
            <form action="" method="POST" id="roleForm">
                <label for="roleFilter" class="form-label" style="font-weight: 500;">Filter by Role:</label>
                <select class="form-select" name="roleFilter" id="roleFilter" onchange="this.form.submit()">
                    <option value="All Roles">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </form>
        </div>
        <!-- Users Table -->
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $row['First_Name'] . "</td>";
                    echo "<td>" . $row['Last_Name'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Contact'] . "</td>";
                    echo "<td>" . $row['Role'] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-primary btn-sm edit' id=" . $row['ID'] . ">Edit</button>&nbsp;";
                    echo "<button class='btn btn-danger btn-sm delete' id=" . $row['ID'] . ">Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php require "assets/php/footer.php"; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS v4.6.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Users Delete Script -->
    <script src="assets/js/users_delete.js"></script>
    <!-- Logout Script -->
    <script src="assets/js/logout.js"></script>
    <script>
        // Data Table
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        // Users Role Filter
        document.addEventListener("DOMContentLoaded", function() {
            var roleFilter = document.getElementById('roleFilter');
            var roleForm = document.getElementById('roleForm');

            roleFilter.addEventListener('change', function() {
                roleForm.submit();
            });

            var selectedRole = "<?php echo isset($_POST['roleFilter']) ? $_POST['roleFilter'] : ''; ?>";
            if (selectedRole) {
                document.querySelector('#roleFilter [value="' + selectedRole + '"]').selected = true;
            }
        });

        // Edit Users
        Edits = document.getElementsByClassName("edit");

        Array.from(Edits).forEach((element) => {
            element.addEventListener("click", (e) => {

                tr = e.target.parentNode.parentNode;

                first_name = tr.getElementsByTagName("td")[1].innerText;
                last_name = tr.getElementsByTagName("td")[2].innerText;
                email = tr.getElementsByTagName("td")[3].innerText;
                contact = tr.getElementsByTagName("td")[4].innerText;
                role = tr.getElementsByTagName("td")[5].innerText;

                firstnameEdit.value = first_name;
                lastnameEdit.value = last_name;
                emailEdit.value = email;
                contactEdit.value = contact;
                roleEdit.value = role;

                editidd.value = e.target.id;

                $('#editModal').modal('toggle');
            });
        });
    </script>
</body>

</html>
