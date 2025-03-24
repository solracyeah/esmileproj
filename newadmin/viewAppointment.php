<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: ../pages-login.html");
    exit();
}
$user_id = $_SESSION['user_id'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Esmile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Add this line for jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then add the Bootstrap script -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <style>
    .appointments-section {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
      }
  
      .appointment-card {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
      }
  
      .appointment-card:hover {
        transform: translateY(-3px);
        background-color: #e9ecef;
      }
    </style>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="d-none d-lg-block">ESMILE</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>

    </header>



  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="ri-dashboard-line"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-user-settings-line"></i></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="adminlist.html">
              <i class="bi bi-circle"></i><span>Admin List</span>
            </a>
          </li>
          <li>
            <a href="addadmin.html">
              <i class="bi bi-circle"></i><span>Add Admin</span>
            </a>
          </li>
          <!-- <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Edit Admin</span>
            </a>
          </li>
          <li> -->
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-nurse-line"></i></i><span>Dentist</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="dentistlist.html">
              <i class="bi bi-circle"></i><span>Dentist List</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Add Dentist</span>
            </a>
          </li>
          <!-- <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Edit Dentist</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-id-card-line"></i></i><span>Patient</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="patientlist.html">
              <i class="bi bi-circle"></i><span>Patient List</span>
            </a>
          </li>
          <li>
            <a href="addpatient.html">
              <i class="bi bi-circle"></i><span>Add Patient</span>
            </a>
          </li>
          <!-- <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Edit Patient</span>
            </a>
          </li> -->
        </ul>
      </li>

      <!-- End Tables Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#calendar-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-user-settings-line"></i></i><span>Calendar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="calendar-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="calendar.php">
              <i class="bi bi-circle"></i><span>View Calendar</span>
            </a>
          </li>
          <!-- <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Today's Appointments (gawin list)</span>
            </a>
          </li> -->
          <!-- <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Edit Admin</span>
            </a>
          </li> -->
          <li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-calendar-line"></i></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="viewAppointment.php">
              <i class="bi bi-circle"></i><span>View Appointment</span>
            </a>
          </li>
          <li>
          <a href="setAppointment.php">
              <i class="bi bi-circle"></i><span>Add Appointment</span>
            </a>
          </li>
          <li>
          <a href="archivedAppointment.php">
              <i class="bi bi-circle"></i><span>Archived Appointments</span>
            </a>
          </li>
          
        </ul>
      </li>
      <!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../pages-login.html" onclick="return confirm('Are you sure you want to sign out?');">
          <i class="ri-login-box-line"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Manage Appointments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Manage Appointments</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="appointments-section">
                        <h5 class="section-title">Manage Appointments</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for cancel request -->
    <div class="modal fade" id="cancelRequestModal" tabindex="-1" aria-labelledby="cancelRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelRequestModalLabel">Request Appointment Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="patientNameDisplay"></p>  <!-- Display patient's name here -->
                    <form id="cancelRequestForm">
                        <input type="hidden" id="appointmentIdInput">
                        <div class="mb-3">
                            <label for="reasonDropdown" class="form-label">Reason for Cancellation</label>
                            <select id="reasonDropdown" class="form-select" required>
                                <option value="" disabled selected>Select Reason for Cancellation</option>
                                <option value="Change of plans">Change of Plans</option>
                                <option value="Health issues">Health Issues</option>
                                <option value="Schedule conflict">Schedule Conflict</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="submitCancelRequest">Submit Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Disapproval Reason -->
    <div class="modal fade" id="disapproveReasonModal" tabindex="-1" aria-labelledby="disapproveReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveReasonModalLabel">Select Reason for Disapproval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="disapproveReasonForm">
                        <input type="hidden" id="disapproveAppointmentIdInput">
                        <div class="mb-3">
                            <label for="disapproveReasonDropdown" class="form-label">Reason for Disapproval</label>
                            <select id="disapproveReasonDropdown" class="form-select" required>
                                <option value="" disabled selected>Select Reason for Disapproval</option>
                                <option value="Insufficient Information">Insufficient Information</option>
                                <option value="Unavailable Time Slot">Unavailable Time Slot</option>
                                <option value="Patient Not Eligible">Patient Not Eligible</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="submitDisapproveReason">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Proof of Payment -->
    <div class="modal fade" id="paymentProofModal" tabindex="-1" aria-labelledby="paymentProofModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentProofModalLabel">Proof of Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="paymentScreenshot" alt="Proof of Payment" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
</main><!-- End Main -->

<script>
// Variable to hold appointments data
let appointments = [];
const defaultImagePath = "/newesmile/patient/uploads/payments/default.png";

// Utility function to handle payment proof image
function handlePaymentProof(paymentScreenshot) {
    const paymentImage = document.getElementById('paymentScreenshot');
    
    // Clear any existing error messages
    const modalBody = document.querySelector('#paymentProofModal .modal-body');
    removeExistingError(modalBody);

    // If no payment proof available, show default image
    if (!paymentScreenshot || paymentScreenshot.trim() === "" || paymentScreenshot === "NULL") {
        console.warn("No payment screenshot provided");
        paymentImage.src = defaultImagePath;
        showErrorMessage(modalBody, 'No payment proof available');
        return;
    }

    // Clean up the file path to prevent duplication
    const cleanFileName = paymentScreenshot.replace(/^uploads\/payments\//, '');
    const paymentScreenshotURL = constructScreenshotURL(paymentScreenshot, cleanFileName);

    // Verify the image exists before setting it
    loadImage(paymentScreenshotURL, paymentImage, modalBody);
}

// Function to remove existing error messages
function removeExistingError(modalBody) {
    const existingError = modalBody.querySelector('.text-danger');
    if (existingError) existingError.remove();
}

// Function to construct the correct screenshot URL
function constructScreenshotURL(paymentScreenshot, cleanFileName) {
    if (paymentScreenshot.startsWith('http')) {
        return paymentScreenshot;
    } else if (paymentScreenshot.startsWith('/')) {
        return `${window.location.origin}${paymentScreenshot}`;
    } else {
        return `/newesmile/patient/uploads/payments/${cleanFileName}`;
    }
}

// Function to load the image and handle errors
function loadImage(url, paymentImage, modalBody) {
    const img = new Image();
    img.onload = () => {
        paymentImage.src = url;
    };

    img.onerror = () => {
        console.warn("Failed to load payment proof image:", url);
        paymentImage.src = defaultImagePath;
        showErrorMessage(modalBody, 'Unable to load payment proof image');
    };

    img.src = url;
}

// Helper function to show error messages in the modal
function showErrorMessage(modalBody, message) {
    const errorMsg = document.createElement('p');
    errorMsg.className = 'text-danger mt-2 mb-0';
    errorMsg.textContent = message;
    modalBody.appendChild(errorMsg);
}

// Function to render appointments
function renderAppointments() {
    const appointmentsSection = document.querySelector('.appointments-section');
    appointmentsSection.innerHTML = `<h5 class="section-title">Appointment Request/s</h5><br>`;

    // Sort appointments from latest to oldest
    appointments.sort((a, b) => {
        const appointmentA = new Date(a.appointment_date + 'T' + a.appointment_time);
        const appointmentB = new Date(b.appointment_date + 'T' + b.appointment_time);
        return appointmentB - appointmentA; // Descending order (latest first)
    });

    appointments.forEach(appt => {
        const isCancelled = appt.status === "Cancelled";
        const isCancelRequested = appt.status === "Cancel Requested";
        const isApproved = appt.status === "Approved";
        const isDisapproved = appt.status === "Disapproved";

        const appointmentDateTime = new Date(appt.appointment_date + 'T' + appt.appointment_time);

        appointmentsSection.innerHTML += `
            <div class="appointment-card d-flex justify-content-between align-items-center p-3 border mb-2">
                <div>
                    <p class="mb-1"><strong>${appt.patient_name}</strong></p>
                    <p class="mb-1"><strong>${appt.title}</strong></p>
                    <p class="text-muted mb-0">${appointmentDateTime.toLocaleString()}</p>
                    ${isCancelRequested ? `<p class="text-danger">Cancellation Requested: ${appt.cancel_reason}</p>` : ''}

                    <!-- Move Proof of Payment button here below patient name -->
                    <button type="button" class="btn btn-info btn-sm mt-2" id="proofOfPaymentBtn" data-bs-toggle="modal" data-bs-target="#paymentProofModal" data-payment-screenshot="${appt.payment_screenshot}">Proof of Payment</button>
                </div>
                <div class="d-flex flex-column gap-1">
                ${isCancelled 
                      ? `<button class="btn btn-sm btn-danger w-100" disabled>Cancelled</button>` 
                      : (isCancelRequested
                          ? `<button class="btn btn-sm btn-warning w-100" id="approveCancelBtn" data-appointment-id="${appt.appointment_id}">Approve Cancel</button>` 
                          : (isApproved
                              ? `<button class="btn btn-sm btn-success w-100" disabled>Approved</button>`
                              : (isDisapproved
                                  ? `<button class="btn btn-sm btn-secondary w-100" disabled>Disapproved</button>` 
                                  :  
                                      `<button class="btn btn-sm btn-primary w-100" id="approveApptBtn" data-appointment-id="${appt.appointment_id}">Approve</button>
                                      <button class="btn btn-sm btn-danger w-100 mt-1" id="disapproveApptBtn" data-appointment-id="${appt.appointment_id}">Disapprove</button>`
                                  )
                              )
                          )
                      }
              </div>
            </div>
        `;
    });

    // Add event listeners for buttons after the content is dynamically rendered
    addEventListeners();
}

// Function to add event listeners after appointment content is rendered
function addEventListeners() {
    // Approve Cancel buttons
    document.querySelectorAll('#approveCancelBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const appointmentId = event.target.getAttribute('data-appointment-id');
            approveCancelRequest(appointmentId);
        });
    });

    // Approve Appointment buttons
    document.querySelectorAll('#approveApptBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const appointmentId = event.target.getAttribute('data-appointment-id');
            approveAppointmentRequest(appointmentId);
        });
    });

    // Disapprove Appointment buttons (Fix typo here)
    document.querySelectorAll('#disapproveApptBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const appointmentId = event.target.getAttribute('data-appointment-id');
            disapproveAppointmentRequest(appointmentId); // Correct function name
        });
    });

    // Proof of Payment button click event
    document.querySelectorAll('#proofOfPaymentBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const paymentScreenshot = event.target.getAttribute('data-payment-screenshot');
            
            // Handle payment proof image
            handlePaymentProof(paymentScreenshot);
        });
    });
}

// Function to approve appointment request
async function approveAppointmentRequest(appointmentId) {
    try {
        const response = await fetch("approveAppointmentRequest.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ appointment_id: appointmentId }),
        });

        const data = await response.json();
        if (data.status === "success") {
            alert(data.message);
            window.location.reload(); // Refresh the page
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error('Error approving appointment request:', error);
        alert('There was an error approving the appointment request.');
    }
}

// Function to approve cancel request
async function approveCancelRequest(appointmentId) {
    try {
        const response = await fetch("approveCancelRequest.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ appointment_id: appointmentId }),
        });

        const data = await response.json();
        if (data.status === "success") {
            alert("Appointment cancelled successfully!");
            window.location.reload(); // Refresh the page
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error('Error approving cancel request:', error);
        alert('There was an error approving the cancel request.');
    }
}

// Function to disapprove appointment request (new function)
async function disapproveAppointmentRequest(appointmentId) {
    try {
        const response = await fetch("DisaproveAppointmentRequest.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ appointment_id: appointmentId })
        });

        const data = await response.json();
        if (data.status === "success") {
            alert("Appointment disapproved successfully!");
            fetchAppointments(); // Refresh appointments after disapproval
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error('Error disapproving appointment:', error);
        alert('There was an error disapproving the appointment request.');
    }
}

// Function to display the modal and set the appointment ID for disapproval
function showDisapproveReasonModal(appointmentId) {
    // Set the appointment ID in the hidden input field
    document.getElementById("disapproveAppointmentIdInput").value = appointmentId;
    // Show the modal
    $('#disapproveReasonModal').modal('show');
}

// Function to handle submitting the disapproval reason
async function submitDisapproveReason() {
    const appointmentId = document.getElementById("disapproveAppointmentIdInput").value;
    const reason = document.getElementById("disapproveReasonDropdown").value;

    if (!reason) {
        alert("Please select a reason for disapproval.");
        return;
    }

    const isConfirmed = confirm("Are you sure you want to disapprove this appointment?");
    if (!isConfirmed) {
        alert("Appointment disapproval canceled.");
        return;
    }

    try {
        const response = await fetch("DisaproveAppointmentRequest.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ appointment_id: appointmentId, reason: reason })
        });

        const data = await response.json();
        if (data.status === "success") {
            alert("Appointment disapproved successfully!");
            window.location.reload(); // Refresh the page
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error('Error disapproving appointment:', error);
        alert('There was an error disapproving the appointment request.');
    }
}

// Add event listener for the submit button in the modal
document.getElementById("submitDisapproveReason").addEventListener("click", submitDisapproveReason);

// Function to add event listeners after appointment content is rendered
function addEventListeners() {
    // Approve Cancel buttons
    document.querySelectorAll('#approveCancelBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const appointmentId = event.target.getAttribute('data-appointment-id');
            approveCancelRequest(appointmentId);
        });
    });

    // Approve Appointment buttons
    document.querySelectorAll('#approveApptBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const appointmentId = event.target.getAttribute('data-appointment-id');
            approveAppointmentRequest(appointmentId);
        });
    });

    // Disapprove Appointment buttons
    document.querySelectorAll('#disapproveApptBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const appointmentId = event.target.getAttribute('data-appointment-id');
            showDisapproveReasonModal(appointmentId); // Show the modal instead of directly disapproving
        });
    });

    // Proof of Payment button click event
    document.querySelectorAll('#proofOfPaymentBtn').forEach(button => {
        button.addEventListener('click', function (event) {
            const paymentScreenshot = event.target.getAttribute('data-payment-screenshot');
            
            // Handle payment proof image
            handlePaymentProof(paymentScreenshot);
        });
    });
}

// Function to fetch appointments
async function fetchAppointments() {
    try {
        const response = await fetch('getAppointments.php');
        const data = await response.json();
        if (data.status === "success") {
            appointments = data.appointments;
            renderAppointments();
        } else {
            alert("Error fetching appointments: " + data.message);
        }
    } catch (error) {
        console.error('Error fetching appointments:', error);
        alert('There was an error fetching appointments.');
    }
}

// Initialize and fetch appointments on page load
document.addEventListener('DOMContentLoaded', fetchAppointments);

</script>


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      <!-- &copy; Copyright <strong><span>ESMILE</span></strong>. All Rights Reserved -->
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- wowowow</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>