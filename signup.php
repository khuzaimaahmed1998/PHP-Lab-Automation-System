<?php
// Starting session
session_start();
// Redirecting to main.php if already logged in
if (isset($_SESSION["loggedIN"]) && $_SESSION["loggedIN"] === true) {
    header("location: main.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab Automation | Signup</title>
    <link rel="stylesheet" href="assets/css/login-register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="content">
            <h2 class="text-center">Signup</h2>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <?php
                // Processing form data when form is submitted
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    // Including connection file
                    require "assets/php/connections/connection.php";

                    // Checking if form fields are set
                    if (isset($_POST["fn"]) && isset($_POST["ln"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["contact"])) {
                        $firstname = $_POST["fn"];
                        $lastname = $_POST["ln"];
                        $email = $_POST["email"];
                        $pass = $_POST["password"];
                        $cpass = $_POST["confirm_password"];
                        $contact = $_POST["contact"];

                        // Checking if email already exists
                        $emailexist = "SELECT * FROM user_info WHERE Email ='$email' ";
                        $result = mysqli_query($con, $emailexist);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Email already exist!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        } elseif (empty($firstname) || empty($lastname) || empty($email) || empty($pass) || empty($cpass) || empty($contact)) {
                            // Displaying error if any field is empty
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        * All fields are required!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        } elseif ($pass == $cpass) {
                            // Hashing password and inserting into database if passwords match
                            $hash = password_hash($pass, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO user_info (First_Name, Last_Name, Email, Password, Contact) VALUES ('$firstname', '$lastname', '$email', '$hash', '$contact')";
                            mysqli_query($con, $sql);

                            // Redirecting to login.php after successful signup
                            header("Location: login.php");
                            exit();
                        } else {
                            // Displaying error if passwords don't match
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Passwords doesn't match!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        }
                    }
                }
                ?>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="fn" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="fn" placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="ln" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="ln" placeholder="Last name" aria-label="Last name">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com">
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="number" class="form-control" name="contact" placeholder="Phone Number">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="col">
                            <label for="cpass" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div><br>
                <div class="text-center">
                    Already have an account? <a href="login.php" class="link-secondary">Login</a>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
