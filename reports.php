<?php
// Database connection
require "assets/php/connections/testing_connection.php";

// Default start and end dates
$startDate = date("Y-m-01");
$endDate = date("Y-m-t");

// If form submitted, update start and end dates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    // SQL query to retrieve records between start and end dates
    $sql = "SELECT * FROM testing_process WHERE testing_date BETWEEN '$startDate' AND '$endDate'";
    $result = $con->query($sql);
}

// Function to generate PDF report
function generatePDF($startDate, $endDate)
{
    require('assets/fpdf/fpdf.php');

    global $con;
    // SQL query to retrieve records between start and end dates
    $sql = "SELECT * FROM testing_process WHERE testing_date BETWEEN '$startDate' AND '$endDate'";
    $result = $con->query($sql);

    // Create new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Add report title
    $pdf->Cell(0, 10, 'Testing Process Report', 0, 1, 'C');
    // Add table headers
    $pdf->Cell(30, 10, 'Product ID', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Product Name', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Testing Date', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Testing Type', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Testing Result', 1, 1, 'C');

    // Add records to PDF table
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row["product_id"], 1, 0, 'C');
        $pdf->Cell(50, 10, $row["product_name"], 1, 0, 'C');
        $pdf->Cell(40, 10, $row["testing_date"], 1, 0, 'C');
        $pdf->Cell(40, 10, $row["testing_type"], 1, 0, 'C');
        $pdf->Cell(30, 10, $row["testing_result"], 1, 1, 'C');
    }

    // Output PDF
    ob_clean(); // Clear output buffer
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=Testing_Report.pdf");
    header("Content-Description: PHP Generated Data");
    header("Cache-Control: max-age=0");
    header("Pragma: public");
    header('Content-Length:' . strlen($pdf->Output('', 'S')));
    $pdf->Output('I', 'Testing_Report.pdf');
    exit;
}

// Check if PDF generation is requested
if (isset($_GET['generate_pdf'])) {
    generatePDF($_GET['startDate'], $_GET['endDate']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Automation | Reports</title>
    <!-- Custom Styling for footer -->
    <link rel="stylesheet" href="assets/css/footer.css">
    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php require "assets/php/navbar.php"; ?><br><br>

    <!-- Reports Container -->
    <div class="container mt-5" style="min-height: 85vh;">
        <h2 class="text-center mb-4">Reports</h2>
        <!-- Generate reports section -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <h3>Generate Reports</h3>
                <form id="reportForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo $startDate; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo $endDate; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
            <!-- Reports Display Section -->
            <div class="col-md-6">
                <h3>View Reports</h3>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                    <?php if ($result->num_rows > 0) : ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Testing Date</th>
                                        <th>Testing Type</th>
                                        <th>Testing Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?php echo $row["product_id"]; ?></td>
                                            <td><?php echo $row["product_name"]; ?></td>
                                            <td><?php echo $row["testing_date"]; ?></td>
                                            <td><?php echo $row["testing_type"]; ?></td>
                                            <td><?php echo $row["testing_result"]; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pass start and end dates via URL parameters -->
                        <a href="?generate_pdf=true&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>" class="btn btn-primary">Download Report as PDF</a>
                    <?php else : ?>
                        <p>No records found.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require "assets/php/footer.php"; ?>

    <!-- Bootstrap script link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Logout Validation -->
    <script src="assets/js/logout.js"></script>

</body>

</html>
