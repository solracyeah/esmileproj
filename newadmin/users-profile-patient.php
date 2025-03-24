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

  <title>Users / Profile - Esmile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
      <a href="../index.html" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <span class="d-none d-lg-block">ESMILE</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block dropdown-toggle ps-2">J. Doe</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>John Doe</h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

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
            <a href="#">
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
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="patientlist.html">Patient List</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
  
    <section class="section profile">
    <div class="row">
        <!-- Left Profile Card -->
        <div class="col-xl-4">
            <div class="card shadow-sm">
                <div class="card-body text-center pt-4">
                    <!-- Profile Image -->
                    <img id="profile-img" src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle mb-3" width="150">
                    <h2 id="full-name" class="fw-bold">Loading...</h2>
                </div>
            </div>
        </div>

        <!-- Right Profile Content -->
        <div class="col-xl-8">
            <div class="card shadow-sm">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered mb-3">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="profile-overview">
                            <h5 class="card-title mb-3">Profile Details</h5>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Full Name</div>
                                <div class="col-lg-9 col-md-8" id="name">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8" id="phone">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8" id="email">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                                <div class="col-lg-9 col-md-8" id="dob">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Sex</div>
                                <div class="col-lg-9 col-md-8" id="sex">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">City</div>
                                <div class="col-lg-9 col-md-8" id="city">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Height</div>
                                <div class="col-lg-9 col-md-8" id="height">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Weight</div>
                                <div class="col-lg-9 col-md-8" id="weight">Loading...</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Blood Type</div>
                                <div class="col-lg-9 col-md-8" id="blood-type">Loading...</div>
                            </div>
                        </div> <!-- End Overview Tab -->

                        <!-- Edit Profile Tab -->
                        <div class="tab-pane fade" id="profile-edit">
                            <h5 class="card-title mb-3">Edit Profile</h5>
                            <form id="edit-profile-form" method="POST" action="javascript:void(0);">
                                <!-- First Name -->
                                <div class="row mb-3">
                                    <label for="f-name" class="col-lg-3 col-md-4 label">First Name</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" id="f-name" name="first_name" class="form-control" placeholder="Enter First Name" required>
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="row mb-3">
                                    <label for="m-name" class="col-lg-3 col-md-4 label">Middle Name</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" id="m-name" name="middle_name" class="form-control" placeholder="Enter Middle Name">
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="row mb-3">
                                    <label for="l-name" class="col-lg-3 col-md-4 label">Last Name</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" id="l-name" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="row mb-3">
                                    <label for="edit-email" class="col-lg-3 col-md-4 label">Email</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="email" id="edit-email" name="email" class="form-control" placeholder="Enter Email" required>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="row mb-3">
                                    <label for="edit-phone" class="col-lg-3 col-md-4 label">Phone</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="tel" id="edit-phone" name="phone" class="form-control" placeholder="Enter Phone" required>
                                    </div>
                                </div>

                                <!-- Date of Birth -->
                                <div class="row mb-3">
                                    <label for="edit-dob" class="col-lg-3 col-md-4 label">Date of Birth</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="date" id="edit-dob" name="dob" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Sex -->
                                <div class="row mb-3">
                                    <label for="edit-sex" class="col-lg-3 col-md-4 label">Sex</label>
                                    <div class="col-lg-9 col-md-8">
                                        <select id="edit-sex" name="sex" class="form-control" required>
                                            <option value="" disabled selected>Select Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Height -->
                                <div class="row mb-3">
                                    <label for="edit-height" class="col-lg-3 col-md-4 label">Height (in feet)</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" id="edit-height" name="height" class="form-control" placeholder="Enter Height (ft)" 
                                              pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid number (up to two decimal places)" required>
                                    </div>
                                </div>

                                <!-- Weight -->
                                <div class="row mb-3">
                                    <label for="edit-weight" class="col-lg-3 col-md-4 label">Weight</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="number" id="edit-weight" name="weight" class="form-control" placeholder="Enter Weight (kg)" required>
                                    </div>
                                </div>

                                <!-- Blood Type -->
                                <div class="row mb-3">
                                    <label for="edit-blood_type" class="col-lg-3 col-md-4 label">Blood Type</label>
                                    <div class="col-lg-9 col-md-8">
                                        <input type="text" id="edit-blood_type" name="blood_type" class="form-control" placeholder="Enter Blood Type" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div><!-- End Edit Profile Tab -->
                        
                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="profile-change-password">
                                <h5 class="card-title">Change Password</h5>
                                <form id="change-password-form" method="POST" action="assets/php/update_password_patient.php">
                                <input type="hidden" name="P_ID" value="<?php echo $P_ID; ?>"> <!-- Add hidden input for P_ID -->
                                  <div class="mb-3">
                                      <label for="current-password" class="form-label">Current Password</label>
                                      <input type="password" class="form-control" id="current-password" name="current-password" required>
                                  </div>
                                  <div class="mb-3">
                                      <label for="new-password" class="form-label">New Password</label>
                                      <input type="password" class="form-control" id="new-password" name="new-password" required>
                                  </div>
                                  <div class="mb-3">
                                      <label for="confirm-password" class="form-label">Confirm New Password</label>
                                      <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Change Password</button>
                                  <p id="password-message" class="mt-3" style="color: red;"></p>
                                </form>
                              </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Function to get the 'id' parameter from the URL
function getUrlParameter(name) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}

document.addEventListener("DOMContentLoaded", function () {
  const patientId = getUrlParameter("id"); // Get the `id` parameter from the URL
  console.log("patient_id from URL:", patientId); // Log the extracted patientId to debug

  if (!patientId) {
    console.error("Patient ID is missing in the URL.");
    document.getElementById("full-name").textContent = "Error loading profile.";
    return;
  }

  // Fetch the patient data from the server
  fetch(`/newesmile/newadmin/assets/php/fetch_patient_by_id.php?id=${patientId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data.error || !data[0]) {
        console.error("Error fetching patient data:", data.error || "Patient not found");
        document.getElementById("full-name").textContent = "Error loading profile.";
        return;
      }

      const patient = data[0]; // Use the fetched patient data

      // Populate the profile information dynamically
      document.getElementById("full-name").textContent = `${patient.First_Name || ""} ${patient.Last_Name}`;
      document.getElementById("name").textContent = `${patient.First_Name} ${patient.Middle_Name || ""} ${patient.Last_Name}`;
      document.getElementById("dob").textContent = `${patient.DOB || "N/A"}`;
      document.getElementById("email").textContent = `${patient.Email || "N/A"}`;
      document.getElementById("phone").textContent = `${patient.Mobile_no || "N/A"}`;
      document.getElementById("sex").textContent = `${patient.Sex || "N/A"}`;
      document.getElementById("city").textContent = `${patient.city_municipality || "N/A"}`;
      document.getElementById("height").textContent = `${patient.height || "N/A"}`;
      document.getElementById("weight").textContent = `${patient.weight || "N/A"}`;
      document.getElementById("blood-type").textContent = `${patient.blood_type || "N/A"}`;

      // Prefill the edit form
      document.getElementById("f-name").value = `${patient.First_Name || ""}`;
      document.getElementById("m-name").value = `${patient.Middle_Name || ""}`;
      document.getElementById("l-name").value = `${patient.Last_Name || ""}`;
      document.getElementById("edit-email").value = `${patient.Email || ""}`;
      document.getElementById("edit-phone").value = `${patient.Mobile_no || ""}`;
      document.getElementById("edit-dob").value = `${patient.DOB || ""}`;
      document.getElementById("edit-sex").value = `${patient.Sex || ""}`;
      document.getElementById("edit-height").value = patient.height || "";
      document.getElementById("edit-weight").value = patient.weight || "";
      document.getElementById("edit-blood_type").value = patient.blood_type || "";
    })
    .catch((error) => {
      console.error("Error fetching patient data:", error);
      document.getElementById("full-name").textContent = "Error loading profile.";
    });
});

function saveProfileChanges(event) {
  event.preventDefault();

  const patientId = getUrlParameter("id");
  if (!patientId) {
    console.error("No patient ID found in the URL");
    alert("No patient ID found in the URL");
    return;
  }

  const updatedData = {
    id: patientId,
    first_name: document.getElementById("f-name").value || null,
    middle_name: document.getElementById("m-name").value || null,
    last_name: document.getElementById("l-name").value || null,
    dob: document.getElementById("edit-dob").value || null,
    sex: document.getElementById("edit-sex").value || null,
    email: document.getElementById("edit-email").value || null,
    mobile_no: document.getElementById("edit-phone").value || null,
    height: document.getElementById("edit-height").value || null,
    weight: document.getElementById("edit-weight").value || null,
    blood_type: document.getElementById("edit-blood_type").value || null,
  };

  fetch(`/newesmile/newadmin/assets/php/update_patient.php?id=${patientId}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(updatedData),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Profile updated:", data);
      alert("Profile updated successfully!");
      location.reload(); 
    })
    .catch((error) => {
      console.error("Error updating profile:", error);
      alert("An error occurred while updating the profile.");
    });
}

document.getElementById("edit-profile-form").addEventListener("submit", saveProfileChanges);
</script>



  
</main><!-- End #main -->

  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <!-- <div class="copyright"> -->
      <!-- &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved -->
    <!-- </div> -->
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
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