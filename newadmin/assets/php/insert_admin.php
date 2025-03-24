<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "esmile_db"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data and sanitize inputs
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['Email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$re_password = mysqli_real_escape_string($conn, $_POST['re_password']);
$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
$permissions = mysqli_real_escape_string($conn, $_POST['permissions']);

// Check if passwords match
if ($password !== $re_password) {
    echo "Error: Passwords do not match!";
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if username or email already exists
$sql = "SELECT * FROM users WHERE username='$username' OR Email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Error: Username or email is already taken!";
    exit;
}

// Insert user into 'users' table
$sql = "INSERT INTO users (username, Email, password, role) VALUES ('$username', '$email', '$hashed_password', 'admin')";
if ($conn->query($sql) === TRUE) {
    // Get the last inserted user_id
    $user_id = $conn->insert_id;

    // Insert admin details into 'admin_details' table
    $sql = "INSERT INTO admin_details (user_id, username, permissions, First_Name, Middle_Name, Last_Name, Email)
            VALUES ('$user_id', '$username', '$permissions', '$first_name', '$middle_name', '$last_name', '$email')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../adminlist.html");
    echo "<script>
            alert('Successfully added!');
          </script>";
} else {
    echo "Error inserting into admin_details: " . $conn->error;
}
} else {
    echo "Error inserting into users: " . $conn->error;
}

// Close the connection
$conn->close();
?>
