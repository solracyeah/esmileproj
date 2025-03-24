<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: ../pages-login.html");
    exit();
}

// Get the logged-in user_id from the session
$user_id = $_SESSION['user_id'];

// Hard-code P_ID to be the same as user_id
$P_ID = $user_id;

// Debugging (optional)
error_log("P_ID is hardcoded to: " . $P_ID);
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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../newadmin/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dentist.html" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <span class="d-none d-lg-block">ESMILE</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="dentist.html">
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
          <a href="appointments.html">
            <i class="bi bi-circle"></i><span>View Appointments</span>
          </a>
        </li>
        <li>
          <a href="setAppointment.php">
            <i class="bi bi-circle"></i><span>Set Appointment</span>
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
        <i class="ri-id-card-line"></i></i><span>Patients</span><i class="bi bi-chevron-down ms-auto"></i>
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

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-calendar-line"></i></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="#">
            <i class="bi bi-circle"></i><span>View Appointments</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bi bi-circle"></i><span>Set Appointment</span>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- End Charts Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="../pages-login.html">
        <i class="ri-login-box-line"></i>
        <span>Logout</span>
      </a>
    </li><!-- End Login Page Nav -->

  </ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Appointment Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="appointments.html">Appointments</a></li>
                <li class="breadcrumb-item active">Appointment Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
  
    <section class="section profile">
    <div class="row">
        <!-- Left Profile Card -->
        <!-- <div class="col-xl-4">
            <div class="card shadow-sm">
                <div class="card-body text-center pt-4">
                  profile image if us2 i dynamic
                    <img id="profile-img" src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle mb-3" width="150">
                    <h2 id="full-name" class="fw-bold">Loading...</h2>
                </div>
            </div>
        </div> -->

          <!-- Right Profile Content -->
          <div class="col-xl-8">
              <div class="card shadow-sm">
                  <div class="card-body pt-3">
                      <!-- Bordered Tabs -->
                      <ul class="nav nav-tabs nav-tabs-bordered mb-3">
                          <li class="nav-item">
                              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#appointment-overview">Overview</button>
                          </li>
                          <li class="nav-item">
                              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#appointment-edit">Edit Details</button>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <!-- Overview Tab -->
                          <div class="tab-pane fade show active" id="appointment-overview">
                              <h5 class="card-title mb-3">Appointment Details</h5>

                              <div class="row mb-2">
                                  <div class="col-lg-3 col-md-4 label">Title</div>
                                  <div class="col-lg-9 col-md-8" id="title">Loading...</div>
                              </div>

                              <div class="row mb-2">
                                  <div class="col-lg-3 col-md-4 label">Appointment Date</div>
                                  <div class="col-lg-9 col-md-8" id="appointment-date">Loading...</div>
                              </div>
                              
                              <div class="row mb-2">
                                  <div class="col-lg-3 col-md-4 label">Appointment Time</div>
                                  <div class="col-lg-9 col-md-8" id="appointment-time">Loading...</div>
                              </div>

                              <div class="row mb-2">
                                  <div class="col-lg-3 col-md-4 label">Patient Name</div>
                                  <div class="col-lg-9 col-md-8" id="patient-name">Loading...</div>
                              </div>

                              <div class="row mb-2">
                                  <div class="col-lg-3 col-md-4 label">Treatment Fee</div>
                                  <div class="col-lg-9 col-md-8" id="treatment-fee">Loading...</div>
                              </div>

                              <div class="row mb-2">
                                  <div class="col-lg-3 col-md-4 label">Note</div>
                                  <div class="col-lg-9 col-md-8" id="note">Loading...</div>
                              </div>
                          </div> <!-- End Overview Tab -->

                          <!-- Edit Details Tab -->
                          <div class="tab-pane fade" id="appointment-edit">
                              <h5 class="card-title mb-3">Edit Appointment Details</h5>
                              <form id="edit-appointment-form" method="POST" action="javascript:void(0);">
                                  <!-- Title (Read Only) -->
                                  <div class="row mb-3">
                                      <label for="appointment-title" class="col-lg-3 col-md-4 label">Title</label>
                                      <div class="col-lg-9 col-md-8">
                                          <input type="text" id="appointment-title-edit" name="title" class="form-control" readonly>
                                      </div>
                                  </div>

                                  <!-- Appointment Date (Read Only) -->
                                  <div class="row mb-3">
                                      <label for="appointment-date" class="col-lg-3 col-md-4 label">Appointment Date</label>
                                      <div class="col-lg-9 col-md-8">
                                          <input type="text" id="appointment-date-edit" name="appointment_date" class="form-control" readonly>
                                      </div>
                                  </div>

                                  <!-- Appointment Time (Read Only) -->
                                  <div class="row mb-3">
                                      <label for="appointment-time" class="col-lg-3 col-md-4 label">Appointment Time</label>
                                      <div class="col-lg-9 col-md-8">
                                          <input type="text" id="appointment-time-edit" name="appointment_time" class="form-control" readonly>
                                      </div>
                                  </div>

                                  
                                  <!-- Patient Name (Read Only) -->
                                  <div class="row mb-3">
                                      <label for="patient-name" class="col-lg-3 col-md-4 label">Patient Name</label>
                                      <div class="col-lg-9 col-md-8">
                                          <input type="text" id="patient-name-edit" name="patient_name" class="form-control" readonly>
                                      </div>
                                  </div>

                                  <!-- Treatment Fee -->
                                  <div class="row mb-3">
                                      <label for="edit-treatment-fee" class="col-lg-3 col-md-4 label">Treatment Fee</label>
                                      <div class="col-lg-9 col-md-8">
                                          <input type="number" id="treatment_fee" name="treatment_fee" class="form-control" placeholder="Enter Treatment Fee" required>
                                      </div>
                                  </div>

                                  <!-- Note -->
                                  <div class="row mb-3">
                                      <label for="edit-note" class="col-lg-3 col-md-4 label">Note</label>
                                      <div class="col-lg-9 col-md-8">
                                          <textarea id="edit-note" name="note" class="form-control" placeholder="Enter Note" rows="4"></textarea>
                                      </div>
                                  </div>

                                  <div class="text-center">
                                      <button type="submit" class="btn btn-primary">Save Changes</button>
                                  </div>
                              </form>
                          </div><!-- End Edit Details Tab -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <script>
    //appointment-details.php
    // Fetch appointment details from the server
document.addEventListener("DOMContentLoaded", function () {
    // Get the appointment ID from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const appointmentId = urlParams.get('id');

    // Validate appointment ID
    if (!appointmentId || isNaN(appointmentId)) {
        console.error("Invalid or missing appointment ID");
        alert("Error: Invalid appointment ID");
        return;
    }

// Fetch appointment data from the server
fetch(`fetch_appointment_by_id.php?id=${encodeURIComponent(appointmentId)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            // Check if the response is successful and contains data
            if (data.status !== "success" || !data.data) {
                throw new Error(data.message || "Failed to load appointment details");
            }

            const appointment = data.data;

            // Format date properly
            const formattedDate = appointment.appointment_date 
                ? new Date(appointment.appointment_date).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                  })
                : "N/A";

            // Format treatment fee properly
            const formattedFee = appointment.treatment_fee 
                ? new Intl.NumberFormat('en-PH', {
                    style: 'currency',
                    currency: 'PHP'
                  }).format(appointment.treatment_fee)
                : "N/A";

            // Update display fields
            document.getElementById("title").textContent = appointment.title || "N/A";
            document.getElementById("appointment-date").textContent = formattedDate;
            document.getElementById("appointment-time").textContent = appointment.appointment_time || "N/A";
            document.getElementById("patient-name").textContent = appointment.patient_name || "N/A";
            document.getElementById("treatment-fee").textContent = formattedFee;
            document.getElementById("note").textContent = appointment.notes || "No notes available";

            // Update edit form fields - preserve original format for editing
            document.getElementById("appointment-title-edit").value = appointment.title || "";
            document.getElementById("appointment-date-edit").value = appointment.appointment_date || "";
            document.getElementById("appointment-time-edit").value = appointment.appointment_time || "";
            document.getElementById("treatment-fee-edit").value = appointment.treatment_fee || "";
            document.getElementById("note-edit").value = appointment.notes || "";
        })
        .catch(error => {
            console.error("Error fetching appointment data:", error);
            alert("Error loading appointment details. Please try again later.");
        });
});

function saveAppointmentChanges(event) {
    event.preventDefault();

    const appointmentId = getUrlParameter("id");

    if (!appointmentId || isNaN(appointmentId)) {
        console.error("Invalid or missing appointment ID.");
        alert("Error: Invalid appointment ID.");
        return;
    }

    const updatedData = {
        id: appointmentId,
        title: document.getElementById("appointment-title-edit").value.trim(),
        appointment_date: document.getElementById("appointment-date-edit").value,
        appointment_time: document.getElementById("appointment-time-edit").value,
        treatment_fee: document.getElementById("treatment-fee-edit").value,
        notes: document.getElementById("note-edit").value.trim()
    };

    fetch("update_appointment.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.status !== "success") {
            throw new Error(data.message || "Failed to update appointment");
        }
        alert("Appointment updated successfully!");
        location.reload();
    })
    .catch(error => {
        console.error("Error saving appointment changes:", error);
        alert("An error occurred while saving changes. Please try again.");
    });
}

document.getElementById("edit-appointment-form").addEventListener("submit", saveAppointmentChanges);

</script>

</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <!-- Footer content here -->
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