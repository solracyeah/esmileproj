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
            <a href="#">
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
    <!-- Start Page Title -->
    <div class="container py-3">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Set Appointment</h5>
        </div>
        <div class="card-body">
          <form action="setRequest.php" method="POST">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

            <div class="mb-3">
              <label class="form-label">Services</label>
              <div id="serviceOptions" class="row">
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Check-up" data-price="250" onchange="updatePrice(); showConsentModal();"> Check-up</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Cleaning" data-price="1000" onchange="updatePrice(); showConsentModal();"> Cleaning</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Extraction" data-price="2000" onchange="updatePrice(); showConsentModal();"> Extraction</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Root Canal Therapy" data-price="3000" onchange="updatePrice(); showConsentModal();"> Root Canal Therapy</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Removal of Impacted Tooth" data-price="3000" onchange="updatePrice(); showConsentModal();"> Removal of Impacted Tooth</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Toothache" data-price="500" onchange="updatePrice(); showConsentModal();"> Toothache</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Cavity Filling" data-price="1500" onchange="updatePrice(); showConsentModal();"> Cavity Filling</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Whitening" data-price="800" onchange="updatePrice(); showConsentModal();"> Whitening</label></div>
                <div class="col-md-4"><label><input type="checkbox" name="appointment_title[]" value="Orthodontics Consultation" data-price="250" onchange="updatePrice(); showConsentModal();"> Orthodontics Consultation</label></div>

              </div>
            </div>

            <!-- Price Display -->
            <div class="mb-3">
              <label class="form-label">Total Price: <span id="servicePrice">-</span></label>
            </div>

            <div class="mb-3">
              <label for="appointmentDate" class="form-label">Date</label>
              <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required min="<?php echo date('Y-m-d'); ?>">
            </div>

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

            <!-- Companion Section -->
              <div class="mb-3">
                <label class="form-label">Are you bringing companions? (Max 3)</label>
                <input type="checkbox" id="bringCompanion" name="bring_companion" onchange="toggleCompanionFields()">
              </div>

              <!-- Companion Fields (Hidden by Default) -->
              <div id="companionFields" style="display: none;">
                <div class="mb-3">
                  <label class="form-label">Companion 1</label>
                  <input type="text" class="form-control" name="companion_name_1" placeholder="Full Name">
                  <input type="text" class="form-control mt-2" name="companion_relation_1" placeholder="Relationship">
                </div>
                <div class="mb-3">
                  <label class="form-label">Companion 2</label>
                  <input type="text" class="form-control" name="companion_name_2" placeholder="Full Name">
                  <input type="text" class="form-control mt-2" name="companion_relation_2" placeholder="Relationship">
                </div>
                <div class="mb-3">
                  <label class="form-label">Companion 3</label>
                  <input type="text" class="form-control" name="companion_name_3" placeholder="Full Name">
                  <input type="text" class="form-control mt-2" name="companion_relation_3" placeholder="Relationship">
                </div>
              </div>
            
            <button type="submit" class="btn btn-primary">Set Appointment</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Warning Modal -->
    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="warningModalLabel">Selection Limit Reached</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            You can only select up to three services. Please deselect one to choose another.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>


    
  </main>

  <!-- Bootstrap JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>

    function toggleCompanionFields() {
      const companionFields = document.getElementById("companionFields");
      const bringCompanionCheckbox = document.getElementById("bringCompanion");

      if (bringCompanionCheckbox.checked) {
        companionFields.style.display = "block";
      } else {
        companionFields.style.display = "none";
      }
    }

  document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('#serviceOptions input[type="checkbox"]');
    const appointmentTimeSelect = document.getElementById("appointmentTime");
    const appointmentDateInput = document.getElementById("appointmentDate");
    const warningModalEl = new bootstrap.Modal(document.getElementById('warningModal'));
    const form = document.getElementById("appointmentForm"); // Form element

    // Time slots array
    const timeSlots = ["08:00", "10:00", "12:00", "14:00", "16:00"];

    /*** Function: Update Displayed Price ***/
    function updatePrice() {
      let total = Array.from(document.querySelectorAll('#serviceOptions input[type="checkbox"]:checked'))
        .reduce((sum, checkbox) => sum + parseInt(checkbox.getAttribute('data-price')), 0);
      
      document.getElementById('servicePrice').textContent = total ? `₱${total}` : '-';
    }

    /*** Function: Limit Service Selection to 3 ***/
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener("change", function () {
        let checkedBoxes = document.querySelectorAll('#serviceOptions input[type="checkbox"]:checked');

        if (checkedBoxes.length > 3) {
          this.checked = false; // Prevent selecting more than 3
          warningModalEl.show(); // Show the warning modal
        }

        updatePrice();
        updateTimeSlotAvailability();
      });
    });

    /*** Function: Block Next Time Slot if 3 Services are Checked ***/
    function updateTimeSlotAvailability() {
      let checkedBoxes = document.querySelectorAll('#serviceOptions input[type="checkbox"]:checked').length;
      let selectedTime = appointmentTimeSelect.value;
      let nextTimeSlot = getNextTimeSlot(selectedTime);

      if (checkedBoxes === 3 && selectedTime && nextTimeSlot) {
        let nextOption = Array.from(appointmentTimeSelect.options).find(opt => opt.value === nextTimeSlot);
        if (nextOption) {
          nextOption.disabled = true; // Disable the next time slot
        } else {
          alert("No additional time slots available.");
        }
      } else {
        enableAllTimeSlots();
      }
    }

    /*** Function: Get Next Time Slot ***/
    function getNextTimeSlot(currentTime) {
      let currentIndex = timeSlots.indexOf(currentTime);
      return currentIndex !== -1 && currentIndex < timeSlots.length - 1 ? timeSlots[currentIndex + 1] : null;
    }

    /*** Function: Enable All Time Slots ***/
    function enableAllTimeSlots() {
      Array.from(appointmentTimeSelect.options).forEach(option => option.disabled = false);
    }

    /*** Function: Prevent Selecting Past Time Slots ***/
    function updateTimeOptions() {
      let selectedDate = appointmentDateInput.value;
      let today = new Date();
      let todayString = today.toISOString().split("T")[0];

      if (selectedDate === todayString) {
        let currentHour = today.getHours();
        let currentMinute = today.getMinutes();

        Array.from(appointmentTimeSelect.options).forEach(option => {
          if (!option.value) return;
          let [optionHour, optionMinute] = option.value.split(":").map(Number);
          option.disabled = optionHour < currentHour || (optionHour === currentHour && optionMinute <= currentMinute);
        });
      } else {
        enableAllTimeSlots();
      }
    }

    /*** Function: Handle Form Submission & Redirection ***/
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent default form submission

      let checkedBoxes = document.querySelectorAll('#serviceOptions input[type="checkbox"]:checked').length;

      if (checkedBoxes >= 2 && checkedBoxes <= 3) {
        window.location.href = "specialAppointments.php"; // Redirect for special cases
      } else {
        form.submit(); // Continue with normal submission
      }
    });

    /*** Event Listeners ***/
    appointmentDateInput.addEventListener("change", updateTimeOptions);
    appointmentTimeSelect.addEventListener("change", updateTimeSlotAvailability);
    document.addEventListener("DOMContentLoaded", updateTimeOptions);

    const bringCompanionCheckbox = document.getElementById("bringCompanion");
    const companionFields = document.getElementById("companionFields");

  if (bringCompanionCheckbox.checked) {
      // Validate companion fields
      const companionName1 = document.querySelector("input[name='companion_name_1']").value;
      const companionRelation1 = document.querySelector("input[name='companion_relation_1']").value;

      if (!companionName1 || !companionRelation1) {
        alert("Please fill in at least Companion 1's details.");
        return;
      }
    }

  });
</script>


  <script>
    // Update time options when the appointment date changes or on page load
    function updateTimeOptions() {
      const appointmentDateInput = document.getElementById("appointmentDate");
      const appointmentTimeSelect = document.getElementById("appointmentTime");
      const selectedDate = appointmentDateInput.value;

      // Get today's date in YYYY-MM-DD format
      const today = new Date();
      const todayString = today.toISOString().split("T")[0];

      if (selectedDate === todayString) {
        // For today's date, get the current time
        const currentHour = today.getHours();
        const currentMinute = today.getMinutes();

        // Loop through each time option
        Array.from(appointmentTimeSelect.options).forEach(option => {
          // Skip the placeholder option (with an empty value)
          if (!option.value) return;
          const [optionHourStr, optionMinuteStr] = option.value.split(":");
          const optionHour = parseInt(optionHourStr, 10);
          const optionMinute = parseInt(optionMinuteStr, 10);

          // Disable the option if its time is earlier than or equal to the current time
          if (optionHour < currentHour || (optionHour === currentHour && optionMinute <= currentMinute)) {
            option.disabled = true;
          } else {
            option.disabled = false;
          }
        });
      } else {
        // For future dates, ensure all time options are enabled
        Array.from(appointmentTimeSelect.options).forEach(option => {
          option.disabled = false;
        });
      }
    }

    // Run updateTimeOptions when the appointment date changes
    document.getElementById("appointmentDate").addEventListener("change", updateTimeOptions);

    // Run updateTimeOptions on page load in case the date is pre-filled
    document.addEventListener("DOMContentLoaded", updateTimeOptions);
  </script>



  </main><!-- End Main -->

  <script></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>
