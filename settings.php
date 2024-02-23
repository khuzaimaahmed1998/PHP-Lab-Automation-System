<?php
// Including connection and user data files
require "assets/php/connections/connection.php";
require "assets/php/user_data.php";

// Starting session if not already started
if (!isset($_SESSION)) {
    session_start();
}

// Initializing variables
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$email = $_SESSION['Email'];
$contact = $_SESSION['contact'];
$currentPassword = $newPassword = $confirmPassword = "";
$currentPasswordErr = $passwordMatchErr = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validating current password
    if (empty(trim($_POST["currentPassword"]))) {
        $currentPasswordErr = "* Required";
    } else {
        $currentPassword = trim($_POST["currentPassword"]);
    }

    // Validating new password and confirmation
    if (!empty($_POST["newPassword"])) {
        $newPassword = trim($_POST["newPassword"]);
        $confirmPassword = trim($_POST["confirmPassword"]);
        if ($newPassword != $confirmPassword) {
            $passwordMatchErr = "* Passwords don't match";
        }
    }

    // If no errors, proceed with update
    if (empty($currentPasswordErr) && empty($passwordMatchErr)) {
        // Checking current password
        $query = "SELECT Password FROM user_info WHERE Email = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        // If current password is valid
        if (password_verify($currentPassword, $hashedPassword)) {
            // Updating password if new password is provided
            if (!empty($newPassword)) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updatePasswordQuery = "UPDATE user_info SET Password = ? WHERE Email = ?";
                $updatePasswordStmt = $con->prepare($updatePasswordQuery);
                $updatePasswordStmt->bind_param("ss", $hashedNewPassword, $email);
                $updatePasswordStmt->execute();
                $updatePasswordStmt->close();
            }

            // Updating other fields
            $firstName = trim($_POST["firstName"]);
            $lastName = trim($_POST["lastName"]);
            $contact = trim($_POST["contact"]);

            $updateQuery = "UPDATE user_info SET First_Name = ?, Last_Name = ?, Contact = ? WHERE Email = ?";
            $updateStmt = $con->prepare($updateQuery);
            $updateStmt->bind_param("ssss", $firstName, $lastName, $contact, $email);
            $updateStmt->execute();
            $updateStmt->close();

            // Updating session variables
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['contact'] = $contact;

            // Success message
            $successMessage = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Settings Updated Successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } else {
            $currentPasswordErr = "* Invalid Password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | Settings</title>
    <link rel="stylesheet" href="assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php require "assets/php/navbar.php"; ?><br><br>

    <!-- Settings Container -->
    <div class="container mt-5" style="min-height: 70vh;">
        <h2>Settings</h2>
        <hr>
        <!-- Displaying success message if exists -->
        <?php if (isset($successMessage)) : echo $successMessage; ?>
        <?php endif; ?>
        <!-- Settings Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="First Name">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Last Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email Address" readonly>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" placeholder="Contact Number">
            </div>
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control <?php echo (!empty($currentPasswordErr)) ? 'is-invalid' : ''; ?>" id="currentPassword" name="currentPassword">
                <span class="error"><?php echo $currentPasswordErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control <?php echo ((!empty($passwordMatchErr) && !empty($_POST["newPassword"])) ? 'is-invalid' : ''); ?>" id="confirmPassword" name="confirmPassword">
                <span class="error"><?php echo $passwordMatchErr; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Update Settings</button><br><br><br>
        </form>
    </div>

    <?php require "assets/php/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
