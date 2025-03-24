<?php
// Include your database connection
include('../db_connection.php');

// Include PHPMailer for sending email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; // Path to PHPMailer's autoload

// Get the raw POST data (sent from JavaScript)
$data = json_decode(file_get_contents('php://input'), true);

// Ensure the appointment_id exists in the POST data
if (isset($data['appointment_id'])) {
    $appointment_id = $data['appointment_id'];

    // Prepare the SQL query to fetch appointment details (including patient's email and last name)
    $sql = "SELECT a.user_id, a.title, a.appointment_date, a.appointment_time, u.email, p.last_name 
            FROM appointments a 
            JOIN users u ON a.user_id = u.user_id
            JOIN patient_details p ON u.user_id = p.user_id
            WHERE a.appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the appointment exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Update the appointment status to 'Approved'
        $updateSql = "UPDATE appointments SET status = 'Approved' WHERE appointment_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $appointment_id);

        if ($updateStmt->execute()) {
            // Send email to the patient
            sendApprovalEmail($row['email'], $row['title'], $row['appointment_date'], $row['appointment_time'], $row['last_name']);
            
            // Respond with success message
            echo json_encode(['status' => 'success', 'message' => 'Appointment approved and email sent successfully!']);
        } else {
            // If there's an error while updating, return an error message
            echo json_encode(['status' => 'error', 'message' => 'Failed to approve appointment: ' . $updateStmt->error]);
        }
    } else {
        // echo json_encode(['status' => 'error', 'message' => 'Appointment not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid appointment_id']);
}

$conn->close();

// Function to send email notification to the patient
function sendApprovalEmail($email, $title, $appointment_date, $appointment_time, $last_name)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Example: Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'miguel.carlosc27@gmail.com'; // Your email address
        $mail->Password = 'koos laff hvio oevy';  // Your email password (consider using an app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('miguel.carlosc27@gmail.com', 'E-Smile Dental');
        $mail->addAddress($email); // Patient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Approval Confirmation';
        $mail->Body = "
            <div style='border: 2px solid #007BFF; padding: 20px; border-radius: 10px; background-color: #f4f8ff; font-family: Arial, sans-serif;'>
                <div style='text-align: center; margin-bottom: 15px;'>
                    <h2 style='color: #007BFF; margin: 0;'>Mariano Dental Clinic</h2>
                    <p style='margin: 5px 0; font-size: 14px; color: #555;'>Your Trusted Partner in Dental Care</p>
                </div>

                <p>Dear Mr./Ms. {$last_name},</p>

                <p>We are pleased to inform you that your appointment titled <strong>{$title}</strong> has been successfully scheduled.</p>

                <p><strong>Appointment Date:</strong> {$appointment_date}<br>
                <strong>Appointment Time:</strong> {$appointment_time}</p>

                <p>We greatly appreciate your trust in our services and are looking forward to assisting you at your scheduled appointment time. Should you need to make any changes to your appointment, feel free to contact us at your earliest convenience.</p>

                <p>If you have any further questions or require additional information, please do not hesitate to reach out to our team.</p>

                <p><strong>Contact Us:</strong><br>
                📧 Email: <a href='mailto:support@esmiledental.com' style='color: #007BFF;'>support@esmiledental.com</a><br>
                📞 Phone: +63 912 345 6789</p>

                <p>Thank you for choosing E-Smile Dental. We look forward to seeing you soon!</p>

                <p>Best regards,<br>
                <strong>Mariano Dental Clinic</strong></p>

                <hr style='border: 0; height: 1px; background-color: #ccc; margin: 20px 0;'>

                <p style='text-align: center; font-size: 12px; color: #777;'>
                    This is a system-generated email. Please do not reply.
                </p>
            </div>
        ";



        $mail->send();
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
}
?>
