<?php
// Authentication Check
session_start();
// Check if user is already logged in, redirect to main page if true
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
  <title>Lab Automation | Login</title>
  <!-- Custom styling for LRS (Login Register System) -->
  <link rel="stylesheet" href="assets/css/login-register.css">
  <!-- Bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <!-- Login Container -->
  <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="content">
      <h2 class="text-center">Login</h2>
      <hr>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          require "assets/php/connections/connection.php";
          // Default Value of Login
          $login = false;

          // Check if found "email" and "pass"
          if (isset($_POST["email"]) && isset($_POST["pass"])) {
            $email = $_POST["email"];
            $pass = $_POST["pass"];

            // Select Values from user_info table for Specific Email
            $sqlexist = "SELECT * FROM user_info WHERE Email ='$email'";
            $result = mysqli_query($con, $sqlexist);

            $Rows = mysqli_num_rows($result);
            // Check if Email data is == 1
            if ($Rows == 1) {
              while ($Item = mysqli_fetch_assoc($result)) {
                // Check if password is correct
                if (password_verify($pass, $Item["Password"])) {
                  // Change Default value to True
                  $login = true;
                  // Save Email in Session
                  $_SESSION["Email"] = $email;
                  $_SESSION["loggedIN"] = true;
                  // Redirect user to main page
                  header("location: main.php");
                  exit;
                }
              }
            }
          }
          // If login is unsuccessful, display error message
          if (!$login) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Invalid Email or Password!
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
          }
        }
        ?>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="name@example.com">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <input type="password" name="pass" class="form-control" placeholder="Enter Your Password">
        </div>
        <div class="d-grid gap-2" style="margin-top: 20px;">
          <button type="submit" class="btn btn-primary">Login</button>
        </div><br>
        <div class="text-center">
          Don't have an account? <a href="signup.php" class="link-secondary">Register Now</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap script link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
