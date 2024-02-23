<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <?php
    // Function to set active class for navigation item
    function setActive($page)
    {
        // Getting current page path
        $path = $_SERVER['REQUEST_URI'];
        // Checking if the page path contains the specified page
        if (strpos($path, $page) !== false) {
            echo 'active';
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light navbar-custom">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="main.php"><img src="assets/imgs/logo.png" alt="Lab Automation" height="30"></a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <?php require "user_data.php"; ?>

                    <!-- Navigation Items -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo setActive('main.php'); ?>" href="main.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo setActive('product_testing.php'); ?>" href="product_testing.php">Product Testing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo setActive('testing_records.php'); ?>" href="testing_records.php">Records List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo setActive('product_information.php'); ?>" href="product_information.php">Product Information</a>
                    </li>

                    <!-- Conditional Navigation Items for Admin -->
                    <?php if ($_SESSION["role"] == "Admin") : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo setActive('reports.php'); ?>" href="reports.php">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo setActive('financial_management.php'); ?>" href="financial_management.php">Financial Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo setActive('user_management.php'); ?>" href="user_management.php">Users</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person"></i> <?php echo $_SESSION["firstName"]; ?>
                </a>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li>
                        <!-- Logout Form -->
                        <form id="logoutForm" action="logout.php" method="post">
                            <button type="button" class="dropdown-item" onclick="confirmLogout()">Logout</button>
                            <input type="hidden" name="logout">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap script link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Logout script -->
    <script src="assets/js/logout.js"></script>
</body>

</html>
