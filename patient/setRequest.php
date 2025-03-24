<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages-login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $appointment_titles = $_POST['appointment_title'] ?? [];
    $appointment_date = trim($_POST['appointment_date'] ?? '');
    $appointment_time = trim($_POST['appointment_time'] ?? '');
    $bring_companion = isset($_POST['bring_companion']) ? 1 : 0;

    // Companion data
    $companions = [];
    if ($bring_companion) {
        for ($i = 1; $i <= 3; $i++) {
            $name = trim($_POST["companion_name_$i"] ?? '');
            $relationship = trim($_POST["companion_relation_$i"] ?? '');

            if (!empty($name) && !empty($relationship)) {
                $companions[] = [
                    'name' => $name,
                    'relationship' => $relationship
                ];
            }
        }
    }

    // Validate inputs
    if (empty($appointment_titles) || empty($appointment_date) || empty($appointment_time)) {
        echo "All fields are required.";
        exit();
    }

    // Reformat the date and time
    try {
        $appointment_date = (new DateTime($appointment_date))->format('Y-m-d');
        $appointment_time = (new DateTime($appointment_time))->format('H:i:s');
    } catch (Exception $e) {
        echo "Invalid date or time format.";
        exit();
    }

    try {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'esmile_db');

        // Check for duplicate appointments
        $checkStmt = $conn->prepare("
            SELECT COUNT(*) 
            FROM appointments 
            WHERE appointment_date = ? AND appointment_time = ?
        ");
        $checkStmt->bind_param("ss", $appointment_date, $appointment_time);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            header("Location: AppointmentExist.html");
            exit();
        }

        // Insert a single appointment
        $stmt = $conn->prepare("
            INSERT INTO appointments (user_id, title, appointment_date, appointment_time) 
            VALUES (?, ?, ?, ?)
        ");

        // Combine all selected titles into a single string
        $combined_titles = implode(", ", $appointment_titles);

        // Insert the appointment
        $stmt->bind_param("isss", $user_id, $combined_titles, $appointment_date, $appointment_time);
        $stmt->execute();

        // Get the ID of the inserted appointment
        $appointment_id = $stmt->insert_id;

        $stmt->close();

        // Insert companions if applicable
        if ($bring_companion && $appointment_id && !empty($companions)) {
            $companionStmt = $conn->prepare("
                INSERT INTO companions (appointment_id, name, relationship) 
                VALUES (?, ?, ?)
            ");

            foreach ($companions as $companion) {
                $companionStmt->bind_param("iss", $appointment_id, $companion['name'], $companion['relationship']);
                $companionStmt->execute();
            }

            $companionStmt->close();
        }

        $conn->close();

        // Redirect to payment page
        if ($appointment_id) {
            header("Location: paymentPage.php?appointment_id=$appointment_id");
            exit();
        } else {
            echo "Error: No appointment was created.";
            exit();
        }

    } catch (mysqli_sql_exception $e) {
        error_log("Database error: " . $e->getMessage());
        header("Location: ErrorPage.html");
        exit();
    }
}
?>