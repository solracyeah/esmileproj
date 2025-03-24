<?php
// Include database connection
include 'db_connection.php';

if (isset($_GET['patient_id'])) {
    $patient_id = intval($_GET['patient_id']); // Ensure it's an integer
    $query = "SELECT * FROM patient_details WHERE P_ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Patient not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare the query']);
    }
} else {
    echo json_encode(['error' => 'Patient ID not provided']);
}

$conn->close();
?>
