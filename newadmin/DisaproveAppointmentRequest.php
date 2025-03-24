<?php
// Include your database connection
include('../db_connection.php');

// Include PHPMailer for sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; // Path to PHPMailer's autoload

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the raw POST data (sent from JavaScript)
$data = json_decode(file_get_contents('php://input'), true);

// Ensure the appointment_id and reason exist in the POST data
if (isset($data['appointment_id']) && isset($data['reason'])) {
    $appointment_id = $data['appointment_id'];
    $reason = $data['reason'];

    // Prepare the SQL query to fetch appointment details (including patient's last name and email)
    $sql = "SELECT a.user_id, a.title, a.appointment_date, a.appointment_time, u.email, p.last_name 
            FROM appointments a 
            JOIN users u ON a.user_id = u.user_id
            JOIN patient_details p ON u.user_id = p.user_id
            WHERE a.appointment_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database query preparation failed']);
        exit;
    }

    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the appointment exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Update the appointment status to 'Disapproved' and store the reason
        $updateSql = "UPDATE appointments SET status = 'Disapproved', disapprove_reason = ? WHERE appointment_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        if (!$updateStmt) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare update query']);
            exit;
        }

        $updateStmt->bind_param("si", $reason, $appointment_id);

        if ($updateStmt->execute()) {
            // Send email to the patient
            if (sendDisapprovalEmail($row['email'], $row['last_name'], $row['title'], $row['appointment_date'], $row['appointment_time'], $reason)) {
                // Respond with success message
                echo json_encode(['status' => 'success', 'message' => 'Appointment disapproved and email sent successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to send email']);
            }
        } else {
            // If there's an error while updating, return an error message
            echo json_encode(['status' => 'error', 'message' => 'Failed to disapprove appointment: ' . $updateStmt->error]);
        }
    } else {
        // echo json_encode(['status' => 'error', 'message' => 'Appointment not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid appointment_id or missing reason']);
}

$conn->close();

// Function to send email notification to the patient
function sendDisapprovalEmail($email, $last_name, $title, $appointment_date, $appointment_time, $reason)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Example: Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'miguel.carlosc27@gmail.com'; // Your email address
        $mail->Password = 'koos laff hvio oevy';  // Use app password or environment variable
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('miguel.carlosc27@gmail.com', 'E-Smile Dental');
        $mail->addAddress($email); // Patient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Disapproved - Mariano Dental Clinic';
        $mail->Body = "
            <div style='border: 2px solid #007BFF; padding: 20px; border-radius: 10px; background-color: #f4f8ff; font-family: Arial, sans-serif;'>
                <div style='text-align: center; margin-bottom: 15px;'>
                    <h2 style='color: #007BFF; margin: 0;'>Mariano Dental Clinic</h2>
                    <p style='margin: 5px 0; font-size: 14px; color: #555;'>Your Trusted Partner in Dental Care</p>
                </div>

                <p>Dear Mr./Ms. {$last_name},</p>

                <p>We regret to inform you that your appointment titled <strong>{$title}</strong>, scheduled on <strong>{$appointment_date}</strong> at <strong>{$appointment_time}</strong>, has been disapproved.</p>

                <p><strong>Reason for Disapproval:</strong> {$reason}</p>

                <p>We sincerely apologize for any inconvenience this may cause. If you need further assistance or would like to discuss this matter, please do not hesitate to contact us.</p>

                <p><strong>Refund Process:</strong><br>
                Your refund will be processed, and you can expect it within 1 to 2 business days. If you have any inquiries regarding your refund, please reach out to our customer service team.</p>

                <p><strong>Contact Us:</strong><br>
                📧 Email: <a href='mailto:support@esmiledental.com' style='color: #007BFF;'>support@esmiledental.com</a><br>
                📞 Phone: +63 912 345 6789</p>

                <p>Thank you for your understanding. We hope to serve you better in the future.</p>

                <p>Best regards,<br>
                <strong>Mariano Dental Clinic</strong></p>

                <hr style='border: 0; height: 1px; background-color: #ccc; margin: 20px 0;'>

                <p style='text-align: center; font-size: 12px; color: #777;'>
                    This is a system-generated email. Please do not reply.
                </p>
            </div>
        ";


        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
        return false;
    }
}
?>
