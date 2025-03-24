// Adult teeth data (same as before)
const adultTeeth = {
  upper: [
    { number: 1, status: 'healthy' },
    { number: 2, status: 'healthy' },
    { number: 3, status: 'cavity' },
    { number: 4, status: 'healthy' },
    { number: 5, status: 'healthy' },
    { number: 6, status: 'cavity' },
    { number: 7, status: 'missing' },
    { number: 8, status: 'healthy' },
    { number: 9, status: 'healthy' },
    { number: 10, status: 'denture' },
    { number: 11, status: 'healthy' },
    { number: 12, status: 'healthy' },
    { number: 13, status: 'healthy' },
    { number: 14, status: 'cavity' },
    { number: 15, status: 'missing' },
    { number: 16, status: 'healthy' }
  ],
  lower: [
    { number: 17, status: 'healthy' },
    { number: 18, status: 'healthy' },
    { number: 19, status: 'cavity' },
    { number: 20, status: 'healthy' },
    { number: 21, status: 'healthy' },
    { number: 22, status: 'denture' },
    { number: 23, status: 'healthy' },
    { number: 24, status: 'missing' },
    { number: 25, status: 'healthy' },
    { number: 26, status: 'healthy' },
    { number: 27, status: 'healthy' },
    { number: 28, status: 'healthy' },
    { number: 29, status: 'cavity' },
    { number: 30, status: 'healthy' },
    { number: 31, status: 'healthy' },
    { number: 32, status: 'healthy' }
  ]
};

// Render teeth for both upper and lower rows
const renderTeethRow = (teeth, rowId) => {
  const row = document.getElementById(rowId);
  row.innerHTML = ''; // Clear the row first
  teeth.forEach((tooth) => {
    const toothElement = document.createElement('div');
    toothElement.classList.add('tooth', tooth.status);
    toothElement.setAttribute('data-tooltip', `Tooth ${tooth.number}: ${tooth.status}`);
    toothElement.textContent = tooth.number;
    toothElement.setAttribute('data-tooth-number', tooth.number); // Set number to click on tooth
    toothElement.addEventListener('click', openModal); // Open modal on click
    row.appendChild(toothElement);
  });
};

// Open the modal to update tooth status
const openModal = (event) => {
  const toothNumber = event.target.getAttribute('data-tooth-number');
  
  // Pre-fill tooth number and status in the form
  document.getElementById('tooth-number').value = toothNumber;
  
  // Show the modal
  const modal = document.getElementById('modal');
  modal.style.display = 'block';
};

// Close the modal when the close button is clicked
document.querySelector('.close').addEventListener('click', () => {
  const modal = document.getElementById('modal');
  modal.style.display = 'none';
});

// Close the modal if clicked outside of the modal content
window.addEventListener('click', (event) => {
  const modal = document.getElementById('modal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

// Handle form submission to update status
document.getElementById('tooth-form').addEventListener('submit', async (event) => {
  event.preventDefault();
  
  const toothNumber = parseInt(document.getElementById('tooth-number').value);
  const toothStatus = document.getElementById('tooth-status').value;
  
  const patientName = document.getElementById('patient-name').value;
  const patientAge = document.getElementById('patient-age').value;
  const patientContact = document.getElementById('patient-contact').value;

  // Update tooth status and patient details on the backend (you would need to write the PHP backend)
  await updateToothStatus(toothNumber, toothStatus, patientName, patientAge, patientContact);

  // Re-render the chart with updated status
  renderChart();

  // Close the modal
  document.getElementById('modal').style.display = 'none';
});

// Update tooth status and patient details on the backend (PHP)
const updateToothStatus = async (toothNumber, toothStatus, patientName, patientAge, patientContact) => {
  try {
    const response = await fetch('update_tooth_status.php', {
      method: 'POST',
      body: new URLSearchParams({
        tooth_number: toothNumber,
        status: toothStatus,
        patient_name: patientName,
        patient_age: patientAge,
        patient_contact: patientContact
      }),
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
    const data = await response.json();
    console.log(data.message); // Log success or error message from the backend
  } catch (err) {
    console.error('Error updating tooth status:', err);
  }
};

// Render the entire chart
const renderChart = () => {
  renderTeethRow(adultTeeth.upper, 'upper-teeth');
  renderTeethRow(adultTeeth.lower, 'lower-teeth');
};

// Initialize the chart on page load
document.addEventListener('DOMContentLoaded', renderChart);
