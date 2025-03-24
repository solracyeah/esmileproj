<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: ../pages-login.html");
    exit();
}

// Fetch the user_id from the session
$user_id = $_SESSION['user_id'];

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get the form data
    $appointment_title = isset($_POST['appointment_title']) ? $_POST['appointment_title'] : '';
    $appointment_date = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
    $appointment_time = isset($_POST['appointment_time']) ? $_POST['appointment_time'] : '';

    // Validate form data
    if (empty($appointment_title) || empty($appointment_date) || empty($appointment_time)) {
        // Handle missing data (optional)
        echo "All fields are required.";
        exit();
    }

    // Database connection (adjust to your settings)
    $conn = new mysqli('localhost', 'root', '', 'esmile_db');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, title, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_id, $appointment_title, $appointment_date, $appointment_time);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect the user back to the 'viewAppointments.php' page upon success
        header("Location: viewAppointment.php");
        exit();
    } else {
        // Handle failure (optional)
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
