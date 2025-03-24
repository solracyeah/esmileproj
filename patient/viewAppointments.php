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

  <title>Appointments - Esmile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&family=Poppins:wght@100;400;700&family=Raleway:wght@100;400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="patient-dashboard.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">ESMILE</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="patient-dashboard.php">
          <i class="ri-dashboard-line"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-user-settings-line"></i></i><span>Calendar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-calendar-line"></i></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="viewAppointments.php">
              <i class="bi bi-circle"></i><span>View Appointments</span>
            </a>
          </li>
          <li>
            <a href="setAppointment.php">
              <i class="bi bi-circle"></i><span>Set Appointment</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->


      <!-- End Tables Nav -->


      <!-- End Charts Nav -->
      <li class="nav-item">
          <a class=nav-link collapsed href="patientHistory.php">
              <i class="bi bi-clock-history"></i> <span>Patient History</span>
          </a>
      </li>

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
      <h1>View Appointments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dentist.html">Home</a></li>
          <li class="breadcrumb-item">Appointments</li>
          <li class="breadcrumb-item active">View Appointments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
              <div class="appointments-section">
                <h5 class="section-title">Upcoming Appointments</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Cancel Request Modal -->
    <div class="modal fade" id="cancelRequestModal" tabindex="-1" aria-labelledby="cancelRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelRequestModalLabel">Request Appointment Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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


  </main><!-- End Main -->

  <script>
  let appointments = [];
  const userId = <?php echo json_encode($user_id); ?>;

  function renderAppointments() {
      const appointmentsSection = document.querySelector('.appointments-section');
      appointmentsSection.innerHTML = `<h5 class="section-title">Upcoming Appointments</h5><br>`;

      const now = new Date(); // Get the current date and time

      // Filter and sort appointments by date and time (soonest first)
      const upcomingAppointments = appointments
  .filter(appt => new Date(appt.appointment_date + 'T' + appt.appointment_time) > now)
  .sort((a, b) => new Date(a.appointment_date + 'T' + a.appointment_time) - new Date(b.appointment_date + 'T' + b.appointment_time));


      upcomingAppointments.forEach(appt => {
          const isCancelled = appt.status === "Cancelled";
          const isCancelRequested = appt.status === "Cancel Requested";
          const appointmentDateTime = new Date(appt.appointment_date + 'T' + appt.appointment_time);

          appointmentsSection.innerHTML += `
          <div class="appointment-card d-flex justify-content-between align-items-center p-3 border mb-2">
              <div>
                  <p class="mb-1"><strong>${appt.title}</strong></p>
                  <p class="text-muted mb-0">${appointmentDateTime.toLocaleString()}</p>
                  ${isCancelRequested ? `<p class="text-danger">Cancellation Requested: ${appt.cancel_reason}</p>` : ''}
              </div>
              ${isCancelled 
                  ? `<button class="btn btn-outline-danger btn-sm" disabled>Cancelled</button>` 
                  : (isCancelRequested
                      ? `<button class="btn btn-outline-danger btn-sm" disabled>Cancel Request Sent</button>` 
                      : `<button class="btn btn-outline-danger btn-sm request-cancel-btn" data-appointment-id="${appt.appointment_id}">
                          Cancel Request
                      </button>`) 
              }
          </div>`;
      });

      // Add event listeners to all Request Cancel buttons
      const cancelButtons = document.querySelectorAll('.request-cancel-btn');
      cancelButtons.forEach(button => {
          button.addEventListener('click', function () {
              const appointmentId = this.getAttribute('data-appointment-id');
              openCancelRequestModal(appointmentId);
          });
      });
  }



  // Function to open the Cancel Request Modal
  function openCancelRequestModal(appointmentId) {
      const appointmentIdInput = document.getElementById('appointmentIdInput');
      appointmentIdInput.value = appointmentId;  // Make sure this value is correct
      const cancelRequestModal = new bootstrap.Modal(document.getElementById('cancelRequestModal'));
      cancelRequestModal.show();
  }

  // Fetch appointments from the server
  async function fetchAppointments() {
      try {
          const response = await fetch('getAppointments.php');
          if (!response.ok) throw new Error('Network error');
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

  // Submit the cancel request
  document.getElementById('submitCancelRequest').addEventListener('click', async function () {
      const appointmentId = document.getElementById('appointmentIdInput').value;
      const reason = document.getElementById('reasonDropdown').value;

      if (!reason) {
          alert("Please select a reason for cancellation.");
          return;
      }

      try {
          const response = await fetch("cancelRequest.php", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json",
              },
              body: JSON.stringify({ appointment_id: appointmentId, user_id: userId, reason }),
          });

          const data = await response.json();
          if (data.status === "success") {
              alert(data.message);
              fetchAppointments(); // Refresh appointments after successful request
          } else {
              alert("Error: " + data.message);
          }
      } catch (error) {
          console.error('Error submitting cancel request:', error);
          alert('There was an error submitting the cancel request.');
      }

      // Close modal after submission
      const cancelRequestModal = bootstrap.Modal.getInstance(document.getElementById('cancelRequestModal'));
      cancelRequestModal.hide();
  });

  // Initialize and fetch appointments on page load
  document.addEventListener('DOMContentLoaded', fetchAppointments);

</script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>
