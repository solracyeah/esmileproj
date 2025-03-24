<?php
include '../db_connection.php'; // Include your database connection

// Include PHPMailer for sending email notifications
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; // Path to PHPMailer's autoload

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['appointment_id'])) {
    $appointmentId = intval($data['appointment_id']); // Safely cast to integer

    // Prepare SQL query to get appointment details, patient email, and last name from patient_details table
    $query = "SELECT a.user_id, a.title, a.appointment_date, a.appointment_time, u.email, p.last_name 
              FROM appointments a
              JOIN users u ON a.user_id = u.user_id
              JOIN patient_details p ON u.user_id = p.user_id
              WHERE a.appointment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the appointment exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Update the appointment status to 'Cancelled'
        $updateQuery = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $appointmentId);

        if ($updateStmt->execute() && $updateStmt->affected_rows > 0) {
            // Send cancellation email to the patient
            sendCancellationEmail($row['email'], $row['last_name'], $row['title'], $row['appointment_date'], $row['appointment_time']);

            // Respond with success message
            echo json_encode(["status" => "success", "message" => "Appointment cancelled successfully and email sent."]);
        } else {
            // echo json_encode(["status" => "error", "message" => "Failed to cancel appointment or appointment not found."]);
        }
        $updateStmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Appointment not found."]);
    }
    $stmt->close();
}

// Function to send cancellation email notification to the patient
function sendCancellationEmail($email, $last_name, $title, $appointment_date, $appointment_time)
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
        $mail->Subject = 'Appointment Cancelled by You';
        $mail->Body = "
            <div style='border: 2px solid #007BFF; padding: 20px; border-radius: 10px; background-color: #f4f8ff; font-family: Arial, sans-serif;'>
                <div style='text-align: center; margin-bottom: 15px;'>
                    <h2 style='color: #007BFF; margin: 0;'>Mariano Dental Clinic</h2>
                    <p style='margin: 5px 0; font-size: 14px; color: #555;'>Your Trusted Partner in Dental Care</p>
                </div>

                <p>Dear Mr./Ms. {$last_name},</p>

                <p>We confirm that your appointment titled <strong>{$title}</strong>, scheduled on <strong>{$appointment_date}</strong> at <strong>{$appointment_time}</strong>, has been cancelled as per your request.</p>

                <p><strong>Refund Process:</strong><br>
                Your refund will be processed, and you can expect it within 1 to 2 business days. If you have any inquiries regarding your refund, please reach out to our customer service team.</p>

                <p>If you need further assistance, feel free to contact us.</p>

                <p><strong>Contact Us:</strong><br>
                📧 Email: <a href='mailto:support@esmiledental.com' style='color: #007BFF;'>support@esmiledental.com</a><br>
                📞 Phone: +63 912 345 6789</p>

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
