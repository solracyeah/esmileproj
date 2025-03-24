<?php
header('Content-Type: application/json');

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'esmile_db');

// Check for database connection errors
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Query to fetch all dentist data
$sql = "SELECT dentist_id, First_Name, Middle_Name, Last_Name, DOB, Mobile_no, Sex, Email FROM dentist_details";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Initialize an array to hold the dentist data
    $dentists = [];

    // Loop through the result set and populate the dentists array
    while ($row = $result->fetch_assoc()) {
        $dentists[] = $row;
    }

    // Return the dentist data as JSON
    echo json_encode($dentists);
} else {
    // No data found
    echo json_encode(['error' => 'No dentists found']);
}

// Close the database connection
$conn->close();
?>
