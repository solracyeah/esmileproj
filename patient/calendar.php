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
    .fc-daygrid-day.past-date {
    position: relative;
    background-color: #f0f0f0; /* Light gray background */
    color: #000; /* Keep day number visible */
    pointer-events: none; /* Disable interaction */
}

/* Add a red "X" overlay, but keep the day number visible */
.fc-daygrid-day.past-date::before {
    content: "X";
    font-size: 2rem;
    font-weight: bold;
    color: #d9534f; /* Red color for visibility */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.7; /* Slight transparency */
    pointer-events: none;
    z-index: 2; /* Ensure it's above everything */
}

/* Keep the day number readable */
.fc-daygrid-day.past-date .fc-daygrid-day-number {
    color: #000 !important; /* Force visibility */
    position: relative;
    z-index: 3; /* Keep it above background */
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

          <div id="calendar"></div>
          
          
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
document.addEventListener('DOMContentLoaded', async function () {
    const calendarEl = document.getElementById('calendar');
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD

    // Initialize FullCalendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true, // Allow selecting future dates
        events: [], // Events will be populated dynamically
        eventClick: function (info) {
            if (!info.event.extendedProps.past) {
                alert(`Appointment by: ${info.event.extendedProps.username}`);
            }
        },
        eventContent: function (info) {
            const { event } = info;
            return {
                html: `<div class="calendar-event">${event.title}</div>`
            };
        },
        dayCellClassNames: function (arg) {
            const cellDate = new Date(arg.date);
            const isPast = cellDate < new Date().setHours(0, 0, 0, 0);
            return isPast ? ['fc-daygrid-day', 'past-date'] : [];
        }
    });

    calendar.render(); // Render the calendar before fetching data

    // Fetch and populate calendar with appointments
    async function fetchAppointments() {
        try {
            const response = await fetch('getAppointments.php');
            if (!response.ok) throw new Error('Network error');
            const data = await response.json();

            console.log('Fetched Appointments:', data); // Debugging output

            if (data.status === "success" && Array.isArray(data.appointments)) {
                const appointments = data.appointments.filter(appt => {
                    const appointmentDateTime = new Date(`${appt.appointment_date}T${appt.appointment_time}`);
                    return appointmentDateTime >= new Date(); // Filter out past appointments
                }).map(appt => ({
                    id: appt.appointment_id,
                    title: `${appt.title} (by ${appt.username})`,
                    start: `${appt.appointment_date}T${appt.appointment_time}`,
                    extendedProps: { username: appt.username },
                }));

                calendar.addEventSource(appointments);
            } else {
                console.error("Unexpected response format:", data);
            }
        } catch (error) {
            console.error("Error fetching appointments:", error);
        }
    }

    const userId = <?php echo json_encode($user_id); ?>; // Get user_id from PHP
    await fetchAppointments();
});

</script>








