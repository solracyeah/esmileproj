<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "esmile_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'You need to log in to change your password.']);
        exit();
    }

    $user_id = $_SESSION['user_id']; // Assuming the user's ID is stored in the session

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required.']);
        exit();
    }

    if ($new_password !== $confirm_password) {
        echo json_encode(['success' => false, 'error' => 'New password and confirm password do not match.']);
        exit();
    }

    // Get the user's current hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify the current password
    if (!password_verify($current_password, $hashed_password)) {
        echo '<script>alert("current password is incorrect")
        window.location.href = "../../dentistlist.html";
        </script>';
        exit();
    }

    // Hash the new password
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
    $update_stmt->bind_param("si", $new_hashed_password, $user_id);

    if ($update_stmt->execute()) {
        echo "<script>
            alert('Password changed successfully!');
            window.location.href = '../../dentistlist.html'; // Redirect to a dashboard or desired page
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error updating password. Please try again later.');
            window.location.href = 'user-profile-dentist.php'; // Redirect back to the change password page
        </script>";
        exit();
    }
    

    $update_stmt->close();
}

// Close connection
$conn->close();
?>
