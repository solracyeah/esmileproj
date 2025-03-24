<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header("Location: ../pages-login.html");
    exit();
}
$user_id = $_SESSION['user_id']; // Fetch user_id from session
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
        <a href="adddentist.html">
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
    <!-- Start Page Title -->
    <div class="pagetitle">
      <h1>Set Appointments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dentist.html">Home</a></li>
          <li class="breadcrumb-item">Appointments</li>
          <li class="breadcrumb-item active">Set Appointments</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Set Appointment</h5>
            </div>
            <div class="card-body">
                <!-- Regular form submission without AJAX -->
                <form action="setRequest.php" method="POST">
                    <!-- Hidden input for user_id -->
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

                    <!-- Patient Name Dropdown -->
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Patient Name</label>
                        <select class="form-select" id="patientName" name="patient_name" required>
                            <option value="" disabled selected>Select Patient</option>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "esmile_db";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Query to get patients from patient_details table
                            $sql = "SELECT P_ID, CONCAT(First_Name, ' ', Last_Name) as full_name FROM patient_details ORDER BY First_Name";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['P_ID'] . '">' . $row['full_name'] . '</option>';
                                }
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="appointmentTitle" class="form-label">Title</label>
                        <select class="form-select" id="appointmentTitle" name="appointment_title" required>
                            <option value="" disabled selected>Select Concern</option>
                            <option value="Check-up">Check-up</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Toothache">Toothache</option>
                            <option value="Cavity Filling">Cavity Filling</option>
                            <option value="Whitening">Whitening</option>
                            <option value="Orthodontics Consultation">Orthodontics Consultation</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="appointmentDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required min="<?php echo date('Y-m-d'); ?>">                        
                    </div>

                    <!-- Time Dropdown -->
                    <div class="mb-3">
                        <label for="appointmentTime" class="form-label">Time</label>
                        <select class="form-select" id="appointmentTime" name="appointment_time" required>
                            <option value="" disabled selected>Select a time</option>
                            <option value="08:00">8:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="appointmentNotes" class="form-label">Notes</label>
                        <textarea class="form-control" id="appointmentNotes" name="appointment_notes" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Set Appointment</button>
                </form>
            </div>
        </div>
    </div>

  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</body>

</html>