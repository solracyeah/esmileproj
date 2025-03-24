<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages-login.html");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get appointment ID
    $appointment_id = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : 0;
    $reference_number = isset($_POST['reference_number']) ? trim($_POST['reference_number']) : '';

    if ($appointment_id === 0 || empty($reference_number)) {
        echo "Invalid appointment ID or reference number.";
        exit();
    }

    // Check if a file was uploaded
    if (isset($_FILES['payment_screenshot']) && $_FILES['payment_screenshot']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/payments/';
        $fileName = time() . "_" . basename($_FILES['payment_screenshot']['name']); // Unique filename
        $uploadFile = $uploadDir . $fileName;

        // Ensure the upload directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the destination
        if (move_uploaded_file($_FILES['payment_screenshot']['tmp_name'], $uploadFile)) {
            try {
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'esmile_db');

                if ($conn->connect_error) {
                    throw new Exception("Database connection failed: " . $conn->connect_error);
                }

                // Save the file path and reference number in the database
                $stmt = $conn->prepare("
                    UPDATE appointments
                    SET payment_screenshot = ?, reference_number = ?
                    WHERE appointment_id = ?
                ");
                $stmt->bind_param("ssi", $uploadFile, $reference_number, $appointment_id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    // Redirect to a success page
                    header("Location: paymentSuccess.html");
                    exit();
                } else {
                    echo "No record updated. Please check your appointment ID.";
                    exit();
                }
            } catch (Exception $e) {
                // Handle errors
                error_log("Error: " . $e->getMessage());
                echo "Failed to save payment information.";
            }
        }
    }
}
