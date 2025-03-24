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
      <a href="index.html" class="logo d-flex align-items-center">
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
                <li class="breadcrumb-item"><a href="dentistlist.html">Dentist List</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <!-- Left Column: Profile Image and Info -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <!-- Profile Image -->
                        <img id="profile-img" src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2 id="full-name">Loading...</h2>
                        <h3 id="license">Loading...</h3>
                    </div>
                </div>
            </div>

            <!-- Right Column: Profile Tabs and Content -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
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

                        <div class="tab-content pt-2">
                            <!-- Overview Tab -->
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Specialization</div>
                                    <div class="col-lg-9 col-md-8" id="spec">Loading...</div>

                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8" id="profile-name">Loading...</div>

                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8" id="profile-phone">Loading...</div>

                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8" id="profile-email">Loading...</div>

                                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                                    <div class="col-lg-9 col-md-8" id="profile-dob">Loading...</div>

                                    <div class="col-lg-3 col-md-4 label">Sex</div>
                                    <div class="col-lg-9 col-md-8" id="profile-sex">Loading...</div>
                                </div>
                            </div><!-- End Overview Tab -->

                            <!-- Edit Profile Tab -->
                            <div class="tab-pane fade" id="profile-edit">
                                <h5 class="card-title">Edit Profile</h5>
                                <form id="edit-profile-form" method="POST" action="javascript:void(0);">
                                    <div class="row mb-3">
                                        <label for="f-name" class="col-lg-3 col-md-4 label">First Name</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="f-name" name="first_name" class="form-control" placeholder="Enter First Name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="m-name" class="col-lg-3 col-md-4 label">Middle Name</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="m-name" name="middle_name" class="form-control" placeholder="Enter Middle Name">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="l-name" class="col-lg-3 col-md-4 label">Last Name</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="l-name" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="sex" class="col-lg-3 col-md-4 label">Sex</label>
                                        <div class="col-lg-9 col-md-8">
                                            <select id="sex" name="sex" class="form-control" required>
                                                <option value="" disabled selected>Select Sex</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="dob" class="col-lg-3 col-md-4 label">Date of Birth</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="date" id="dob" name="dob" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="edit-email" class="col-lg-3 col-md-4 label">Email</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="email" id="edit-email" name="email" class="form-control" placeholder="Enter Email" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="mobile-no" class="col-lg-3 col-md-4 label">Mobile Number</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="mobile-no" name="mobile_no" class="form-control" placeholder="Enter Mobile Number" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="license-number" class="col-lg-3 col-md-4 label">License Number</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="license-number" name="license_number" class="form-control" placeholder="Enter License Number" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="specialization" class="col-lg-3 col-md-4 label">Specialization</label>
                                        <div class="col-lg-9 col-md-8">
                                            <input type="text" id="specialization" name="specialization" class="form-control" placeholder="Enter Specialization" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-9 col-md-8 offset-lg-3 offset-md-4">
                                            <button type="submit" id="save-changes-button" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- End Edit Profile Tab -->

                            <!-- Change Password Tab -->
                              <div class="tab-pane fade" id="profile-change-password">
                                <h5 class="card-title">Change Password</h5>
                                <form id="change-password-form" method="POST" action="assets/php/update_password_dentist.php">
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

                        </div><!-- End Bordered Tabs -->
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
        const dentistId = getUrlParameter("id");
        console.log("Dentist ID:", dentistId);

        if (!dentistId) {
            console.error("No dentist ID found in the URL");
            alert("No dentist ID found in the URL");
            return;
        }

        // Fetch the dentist data from the server
        fetch(`/newesmile/newadmin/assets/php/fetch_dentist_by_id.php?id=${dentistId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const dentist = data[0]; // Assuming the response is an array with one dentist

                // Populate the profile information dynamically
                document.getElementById("full-name").textContent = `${dentist.First_Name} ${dentist.Last_Name}`;
                document.getElementById("license").textContent = `${dentist.license_number}`;
                document.getElementById("spec").textContent = `${dentist.specialization}`;
                document.getElementById("profile-name").textContent = `${dentist.First_Name} ${dentist.Middle_Name} ${dentist.Last_Name}`;
                document.getElementById("profile-phone").textContent = dentist.Mobile_no || "Not Provided";
                document.getElementById("profile-email").textContent = dentist.Email || "Not Provided";
                document.getElementById("profile-dob").textContent = dentist.DOB || "Not Provided";
                document.getElementById("profile-sex").textContent = dentist.Sex || "Not Provided";

                document.getElementById("f-name").value = `${dentist.First_Name}`;
                document.getElementById("m-name").value = `${dentist.Middle_Name}`;
                document.getElementById("l-name").value = `${dentist.Last_Name}`;
                document.getElementById("sex").value = dentist.Sex;
                document.getElementById("dob").value = dentist.DOB;
                document.getElementById("edit-email").value = dentist.Email;
                document.getElementById("mobile-no").value = dentist.Mobile_no;
                document.getElementById("license-number").value = dentist.license_number;
                document.getElementById("specialization").value = dentist.specialization;

                // Optionally: Set profile image if available
                // if (dentist.Profile_Image) {
                //     document.getElementById("profile-img").src = dentist.Profile_Image;
                // }
            })
            .catch(error => {
                console.error("Error fetching dentist data:", error);
            });
    });

    function saveProfileChanges(event) {
        event.preventDefault();

        const dentistId = getUrlParameter("id");
        if (!dentistId) {
            console.error("No dentist ID found in the URL");
            alert("No dentist ID found in the URL");
            return;
        }

        const updatedData = {
            id: dentistId,
            first_name: document.getElementById("f-name").value,
            middle_name: document.getElementById("m-name").value,
            last_name: document.getElementById("l-name").value,
            sex: document.getElementById("sex").value,
            dob: document.getElementById("dob").value,
            email: document.getElementById("edit-email").value,
            mobile_no: document.getElementById("mobile-no").value,
            license_number: document.getElementById("license-number").value,
            specialization: document.getElementById("specialization").value
        };

        fetch(`/newesmile/newadmin/assets/php/update_dentist.php?id=${dentistId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(updatedData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error("Error updating profile:", data.error);
                    alert("An error occurred. Please try again later.");
                    return;
                }

                alert("Profile updated successfully!");
                location.reload();
            })
            .catch(error => {
                console.error("Error updating profile:", error);
                alert("An error occurred. Please try again later.");
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