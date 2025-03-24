<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages-login.html");
    exit();
}

$appointment_id = isset($_GET['appointment_id']) ? intval($_GET['appointment_id']) : 0;
if ($appointment_id === 0) {
    header("Location: bookAppointment.php"); // Redirect to booking page
    exit();
}

$reservation_fee = 500;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <link href="assets/css/custom.css" rel="stylesheet">
    <style>
        .payment .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .payment .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #012970;
        }
        .payment ul {
            list-style-type: none;
            padding: 0;
        }
        .payment ul li {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .payment .btn-primary {
            background-color: #4154f1;
            border-color: #4154f1;
        }
        .payment .btn-primary:hover {
            background-color: #2b39cc;
            border-color: #2b39cc;
        }
    </style>
</head>
<body>
    <main class="container"><br>
        <section class="section payment">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="pagetitle"><br>
                                <h1>Payment Page</h1>
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item">Appointments</li>
                                        <li class="breadcrumb-item active">Payment</li>
                                    </ol>
                                </nav>
                            </div>
                            <h5 class="card-title">Reservation Fee</h5>
                            <p class="card-text">Amount: <strong>PHP <?php echo number_format($reservation_fee, 2); ?></strong></p>
                            <p>Please complete your payment using the details below:</p>
                            <ul>
                                <li><strong>GCash Number:</strong> 09123456789</li>
                                <li><strong>Account Name:</strong> eSmile Dental Clinic</li>
                            </ul>
                            <p>After completing your payment, upload a screenshot below:</p>
                            <form action="uploadPayment.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
                                
                                <div class="mb-3">
                                    <label for="referenceNumber" class="form-label">Reference Number</label>
                                    <input type="text" class="form-control" id="referenceNumber" name="reference_number" placeholder="Enter GCash Reference Number" pattern="[0-9]{13}" title="Reference number must be exactly 13 digits" required>
                                </div>

                                <div class="mb-3">
                                    <label for="paymentScreenshot" class="form-label">Upload Screenshot</label>
                                    <input type="file" class="form-control" id="paymentScreenshot" name="payment_screenshot" accept="image/*" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Submit Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
