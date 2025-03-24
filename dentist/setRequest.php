<?php

session_start();

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Check if the dentist is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages-login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'esmile_db');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get and validate form data
    $appointment_title = $_POST['appointment_title'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $appointment_time = $_POST['appointment_time'] ?? '';
    $patient_id = $_POST['patient_name'] ?? '';
    $appointment_notes = $_POST['appointment_notes'] ?? '';

    if (empty($appointment_title) || empty($appointment_date) || empty($appointment_time) || empty($patient_id)) {
        echo json_encode(['status' => 'error', 'message' => 'All required fields must be filled out']);
        exit();
    }

    // Check if the selected time slot is available
    $check_sql = "SELECT COUNT(*) as count FROM appointments WHERE appointment_date = ? AND appointment_time = ? AND status != 'Cancel Request'";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $appointment_date, $appointment_time);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // Instead of echoing JSON, output HTML with a modal to display the error message.
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Time Slot Unavailable</title>
            <!-- Include Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <!-- Modal -->
            <div class="modal fade" id="timeSlotModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Time Slot Unavailable</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="redirectBack()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            This time slot is already booked. Please select another time.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="redirectBack()">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include jQuery and Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                // Show the modal on page load
                $(document).ready(function(){
                    $("#timeSlotModal").modal("show");
                });
                // Redirect back after closing the modal (adjust URL as needed)
                function redirectBack() {
                    window.location.href = "setAppointment.php";
                }
            </script>
        </body>
        </html>';
        exit();
    }
    $check_stmt->close();

    // Fetch patient details
    $patient_sql = "SELECT pd.user_id, pd.Last_Name, CONCAT(pd.First_Name, ' ', pd.Last_Name) as full_name, u.email 
        FROM patient_details pd 
        JOIN users u ON pd.user_id = u.user_id 
        WHERE pd.P_ID = ?";
    $patient_stmt = $conn->prepare($patient_sql);
    $patient_stmt->bind_param("i", $patient_id);
    $patient_stmt->execute();
    $patient_result = $patient_stmt->get_result();
    $patient_data = $patient_result->fetch_assoc();
    $patient_user_id = $patient_data['user_id'];
    $patient_full_name = $patient_data['full_name'];
    $patient_last_name = $patient_data['Last_Name']; // Extract last name separately
    $patient_email = $patient_data['email'];
    $patient_stmt->close();

    $status = 'Approved';

    // Insert appointment into database
    $stmt = $conn->prepare("INSERT INTO appointments (user_id, title, appointment_date, appointment_time, status, created_at, patient_name, notes) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?, ?)");
    $stmt->bind_param("issssss", $patient_user_id, $appointment_title, $appointment_date, $appointment_time, $status, $patient_full_name, $appointment_notes);
    if ($stmt->execute()) {
        // Send email to the patient
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'miguel.carlosc27@gmail.com'; // Set your SMTP username
            $mail->Password = 'koos laff hvio oevy'; // Set your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('miguel.carlosc27@gmail.com', 'E-Smile Dental');
            $mail->addAddress($patient_email, $patient_full_name);
            
            $mail->isHTML(true);
            $mail->Subject = 'Appointment Confirmation';
            $mail->Body = "
            <div style='border: 2px solid #007BFF; padding: 20px; border-radius: 10px; background-color: #f4f8ff; font-family: Arial, sans-serif;'>
                <div style='text-align: center; margin-bottom: 15px;'>
                    <h2 style='color: #007BFF; margin: 0;'>Mariano Dental Clinic</h2>
                    <p style='margin: 5px 0; font-size: 14px; color: #555;'>Your Trusted Partner in Dental Care</p>
                </div>
        
                <p>Dear Mr./Ms. {$patient_last_name},</p>
        
                <p>We are pleased to inform you that your appointment titled <strong>{$appointment_title}</strong> has been successfully scheduled.</p>
        
                <p><strong>Appointment Date:</strong> {$appointment_date}<br>
                <strong>Appointment Time:</strong> {$appointment_time}</p>
        
                <p>We greatly appreciate your trust in our services and look forward to assisting you at your scheduled appointment time. If you need to make any changes, please contact us at your earliest convenience.</p>
        
                <p>If you have any further questions or require additional information, feel free to reach out to our team.</p>
        
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
            error_log("Email sending failed: " . $mail->ErrorInfo);
        }

        header("Location: appointment-success.html");
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error creating appointment: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
