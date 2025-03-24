<?php
include 'db_connection.php';

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // verify the password (unhashed)
        if ($password === $user['Password']) {
            $_SESSION['user_id'] = $user['P_ID'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['account_type'] = $user['account_type'];

            // redirect to the landing page based on role 
            switch ($user['account_type']) {
                case 'admin':
                    header("Location: adminside.html");
                    break;
                case 'dentist':
                    header("Location: index.html");
                    break;
                case 'patient':
                default:
                    header("Location: patientside.html");
                    break;
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that username.";
    }

    $stmt->close();
} else {
    echo "Please fill in both username and password.";
}

$conn->close();
?>
