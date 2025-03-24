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

  <title>Dashboard - Calendar and Appointments</title>
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

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style-calendar.css" rel="stylesheet">

  <style>
    #calendar {
      width: 100%;
      height: 600px;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .calendar-event {
        background-color: blue;
        color: #fff; /* White text */
        padding: 5px; /* Add padding */
        border-radius: 5px; /* Rounded corners */
        font-size: 12px; /* Small font size */
        text-align: center; /* Center text */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Light shadow */
        width: 100%;
    }

    .calendar-event-title {
        margin-bottom: 2px; /* Space below the title */
    }

    .fc-daygrid-day.past-date {
        position: relative;
        background-color: #f0f0f0; /* Light gray background */
        color: #a0a0a0; /* Gray text */
        pointer-events: none; /* Disable interaction */
    }

    /* Add a big "X" to the center of the box */
    .fc-daygrid-day.past-date::before {
        content: "X";
        font-size: 2rem; /* Adjust size of the "X" */
        font-weight: bold;
        color: #d9534f; /* Red color for visibility */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0.7; /* Slight transparency for better appearance */
        pointer-events: none; /* Ensure the "X" is non-interactive */
    } 

        .success-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(203, 207, 230, 0.4);
    }

    .success-modal-content {
        background-color: rgb(202, 221, 244);
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .success-modal-content .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .success-modal-content .close:hover {
        color: #333;
    }

    #modalDetails {
        text-align: left;
        margin-top: 15px;
    }

    #modalDetails p {
        margin: 10px 0;
    }
  </style>




</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
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
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="patient-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <div class="container mt-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Calendar</h3>
        </div>
        <div class="card-body">

          <!-- Calendar -->
          <div id="calendar"></div>
          
          
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        // Initialize FullCalendar
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [], // Empty initially, to be populated dynamically
            eventClick: function (info) {
                alert(`Appointment ID: ${info.event.id}`);
            },
            eventContent: function (info) {
                // Customize the event appearance
                const { event } = info;
                const customHtml = `
                    <div class="calendar-event">
                        <div class="calendar-event-title">${event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${event.title}</div>
                    </div>
                `;
                return { html: customHtml };
            },
            dayCellClassNames: function (arg) {
                const today = new Date();
                const cellDate = new Date(arg.date);
                if (cellDate < today.setHours(0, 0, 0, 0)) {
                    return ['past-date'];
                }
                return [];
            },
        });

        calendar.render();

        // Fetch approved appointments for the current user
        async function fetchApprovedAppointments(userId) {
            try {
                const response = await fetch(`getApprovedAppointments.php?user_id=${userId}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Fetched Approved Appointments:', data);

                if (Array.isArray(data)) {
                    // Map appointments to FullCalendar format
                    const approvedAppointments = data.map(appt => ({
                        id: appt.appointment_id,
                        title: appt.title,
                        start: `${appt.appointment_date}T${appt.appointment_time}`, // Combine date and time
                    }));

                    // Update calendar events
                    updateCalendarEvents(approvedAppointments);
                } else {
                    console.error('Unexpected data format:', data);
                }
            } catch (error) {
                console.error('Error fetching approved appointments:', error);
            }
        }

        // Helper function to update calendar events
        function updateCalendarEvents(events) {
            calendar.removeAllEvents(); // Clear all existing events
            events.forEach(event => {
                calendar.addEvent(event); // Add new events
            });
        }

        // Fetch appointments for the logged-in user
        const userId = <?php echo json_encode($user_id); ?>; // Get user_id from PHP
        fetchApprovedAppointments(userId);
    });
</script>





