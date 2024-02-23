<!-- Restriction to access main page directly without logging in -->
<?php require "assets/php/auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation</title>
    <!-- CSS stylesheets -->
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php require "assets/php/navbar.php"; ?>

    <!-- Welcome Section -->
    <div class="content-container">
        <div class="welcome-message" id="home">
            <!-- Welcome message -->
            <h2>Welcome to Lab Automation</h2>
            <p>Transforming laboratories with cutting-edge automation solutions</p>
        </div>

        <!-- Overview Section -->
        <div class="overview-section" id="about">
            <!-- Brief overview -->
            <h3>Brief Overview</h3>
            <p>Lab Automation is a comprehensive platform designed to streamline laboratory processes and enhance efficiency. With our innovative automation solutions, laboratories can optimize workflows, reduce errors, and accelerate research and development. Our platform offers a range of features including sample tracking, data analysis, equipment integration, and customizable workflows. Whether you're a small research lab or a large-scale testing facility, Lab Automation provides the tools you need to succeed.</p>
        </div>
    </div>
    <br><br><br>
    <!-- Quick Links Cards Section -->
    <div class="container" id="pages">
        <div class="quick-links-section">
            <!-- Quick links -->
            <h3 class="mb-3">Quick Links</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Product Information -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white text-center">
                            <i class="bi bi-info-circle-fill"></i> Product Information
                        </div>
                        <div class="card-body">
                            <p class="card-text">Our product information section provides detailed insights into the features, specifications, and benefits of our automation solutions. From hardware to software, we cover everything you need to know to make informed decisions about implementing automation in your laboratory.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="product_information.php" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <!-- Testing Process -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white text-center">
                            <i class="bi bi-bar-chart-fill"></i> Testing Process
                        </div>
                        <div class="card-body">
                            <p class="card-text">The testing process section outlines the step-by-step procedures involved in our laboratory testing protocols. We detail how samples are collected, prepared, and analyzed using our state-of-the-art equipment and methodologies, ensuring accurate and reliable results every time.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="product_testing.php" class="btn btn-primary">Test Now</a>
                        </div>
                    </div>
                </div>
                <!-- Records List -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white text-center">
                            <i class="bi bi-file-earmark-text-fill"></i> Testing Records
                        </div>
                        <div class="card-body">
                            <p class="card-text">Our testing records section offers access to records and data accumulated throughout the testing phase. These records encapsulate a comprehensive view of all testing activities, including test cases, results, observations. Utilize these records to track progress, identify patterns, and inform decision-making processes effectively.</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="reports.php" class="btn btn-primary">See Records List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><br><br>

    <!-- Contact Us Section -->
    <section class="contact-section py-5" style="background-color: #f8f9fa;">
        <div class="container" id="contact">
            <div class="row">
                <!-- Contact form -->
                <h3>Contact Us</h3>
                <form action="assets/php/contact.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Name" name="name" style="width: 100%;">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" style="width: 100%;">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Message" name="message" rows="3" style="width: 100%;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/php/footer.php"; ?>


    <!-- JavaScript libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/logout.js"></script>
</body>

</html>