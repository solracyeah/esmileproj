document.addEventListener("DOMContentLoaded", function () {
  fetch("/newesmile/newadmin/assets/php/fetch_patients.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data.error) {
        console.error("Error:", data.error);
        return;
      }

      const table = document.getElementById("patientTable");
      const tbody = table.querySelector("tbody"); // Use existing tbody element
      
      // Headers should match the returned data keys
      const headers = ["First Name", "Middle Name", "Last Name", "Date of Birth", "Mobile Number", "Gender", "Email", "Action"];
      const thead = table.createTHead();
      const headerRow = thead.insertRow();
      
      // Create table headers
      headers.forEach((header) => {
        const th = document.createElement("th");
        th.textContent = header;
        headerRow.appendChild(th);
      });

      // Populate table rows with data
      data.forEach((row) => {
        const tr = tbody.insertRow();
        const patientId = row.P_ID; // Use 'P_ID' as the unique identifier

        // Insert patient data into row cells
        Object.keys(row).forEach((key) => {
          if (key !== "P_ID") { // Skip 'P_ID' from being displayed
            const td = tr.insertCell();
            td.textContent = row[key];
          }
        });

        // Add action buttons (e.g., Edit, Drop)
        const actionsTd = tr.insertCell();
        actionsTd.innerHTML = `
          <button type="button" class="btn btn-primary btn-sm" onclick="editPatient(${patientId})">Edit</button>
          <button type="button" class="btn btn-danger btn-sm" onclick="deletePatient(${patientId})">Drop</button>
        `;

        // Make the entire row clickable (except for action buttons)
        tr.addEventListener("click", function (e) {
          if (!e.target.closest(".btn-group")) {
            window.location.href = `users-profile-patient.html?id=${patientId}`;
          }
        });
      });

      // Initialize DataTable
      new simpleDatatables.DataTable("#patientTable");
    })
    .catch((error) => {
      console.error("Fetch Error:", error);
    });
});

function editPatient(id) {
  // Redirect to the edit patient profile page
  window.location.href = `edit-patient.html?id=${id}`;
}

function deletePatient(id) {
  if (confirm("Are you sure you want to delete this patient?")) {
    alert(`Delete Patient ID: ${id}`);
    // Implement delete functionality here (e.g., send DELETE request to backend)
  }
}
