<!DOCTYPE html>
<html>
<head>
    <title>Account Created</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            background: #f6f9ff;
            color: #444444;
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
    </style>
</head>
<body>
    <!-- Success Modal -->
    <div id="successModal" class="success-modal">
        <div class="success-modal-content">
            <span class="close">&times;</span>
            <h2>Account Created Successfully!</h2>
            <p>New Patient can now login to the system!</p>
            <a href="addpatient.html" class="btn btn-primary">Close</a>
        </div>
    </div>

    <script>
    window.onload = function() {
        const successModal = document.getElementById('successModal');
        const closeBtn = document.getElementsByClassName('close')[0];

        // Show the success modal
        successModal.style.display = 'block';

        // Close the modal and redirect after 5 seconds
        setTimeout(function() {
            successModal.style.display = 'none';
            window.location.href = 'addpatient.html';
        }, 5000);

        // Close the modal when clicking on the close button
        closeBtn.onclick = function() {
            successModal.style.display = 'none';
            window.location.href = 'addpatient.html';
        }

        // Close the modal if clicked outside of it
        window.onclick = function(event) {
            if (event.target == successModal) {
                successModal.style.display = 'none';
                window.location.href = 'addpatient.html';
            }
        }
    }
</script>
</body>
</html>