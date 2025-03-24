<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esmile_db"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data and sanitize inputs
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$re_password = mysqli_real_escape_string($conn, $_POST['re_password']);
$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
$sex = mysqli_real_escape_string($conn, $_POST['sex']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$mobile_no = mysqli_real_escape_string($conn, $_POST['mobile_no']);
$license_number = mysqli_real_escape_string($conn, $_POST['license_number']);
$specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
$contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);

// Check if passwords match
if ($password !== $re_password) {
    echo "Error: Passwords do not match!";
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if email or username already exists
$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Error: Username or email is already taken!";
    exit;
}

// Insert user into 'users' table
$sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', 'dentist')";
if ($conn->query($sql) === TRUE) {
    // Get the last inserted user_id
    $user_id = $conn->insert_id;

    // Insert dentist details into 'dentist_details' table
    $sql = "INSERT INTO dentist_details (user_id, username, first_name, middle_name, last_name, email, sex, dob, mobile_no, license_number, specialization, contact_info) 
            VALUES ('$user_id', '$username', '$first_name', '$middle_name', '$last_name', '$email', '$sex', '$dob', '$mobile_no', '$license_number', '$specialization', '$contact_info')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../dentistlist.html");
        echo "<script>
                alert('Successfully added!');
              </script>";
    } else {
        echo "Error inserting into dentist_details: " . $conn->error;
    }
} else {
    echo "Error inserting into users: " . $conn->error;
}

// Close the connection
$conn->close();
?>
