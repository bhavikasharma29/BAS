<?php
require 'db_connection.php'; // Include database connection

date_default_timezone_set('Asia/Kolkata'); // Set timezone
$today = date('Y-m-d'); // Get today's date

// Fetch all available doctors
$sql = "SELECT * FROM doctors WHERE status = 'approved'";
$result = mysqli_query($conn, $sql);
$doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Doctors</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .doctor-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .doctor-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
        }
        .doctor-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .check-availability {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .check-availability:hover {
            background: #0056b3;
        }
        .availability-dropdown {
            margin-top: 10px;
            padding: 10px;
            background: #e9ecef;
            border-radius: 5px;
        }
        .availability-dropdown {
    text-align: left; /* Align text properly */
    white-space: normal; /* Allow text wrapping */
    word-wrap: break-word; /* Ensure long text breaks */
    overflow: hidden; /* Prevent text overflow */
    padding-left: 15px; Move text slightly to the right
}

    </style>
</head>
<body>
    <h2>Available Doctors</h2>
    <div class="doctor-list">
        <?php foreach ($doctors as $doctor): ?>
            <div class="doctor-card">
                <img src="uploads/<?= $doctor['photo'] ?>" alt="Doctor Image">
                <h3><?= $doctor['name'] ?></h3>
                <p>Specialization: <?= $doctor['specialization'] ?></p>
                <p>Sitting Hours: <?= $doctor['sitting_hours'] ?></p>
                <button class="check-availability" data-id="<?= $doctor['doctor_id'] ?>">Check Availability Today</button>
                <div class="availability-dropdown" id="availability-<?= $doctor['doctor_id'] ?>" style="display: none;"></div>
            </div>
        <?php endforeach; ?>
    </div>

    
    

    <script>
document.querySelectorAll('.check-availability').forEach(button => {
    button.addEventListener('click', function () {
        let doctorId = this.getAttribute('data-id');
        let availabilityDiv = document.getElementById('availability-' + doctorId);

        fetch('fetch_availability.php?doctor_id=' + doctorId)
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    availabilityDiv.innerHTML = "<p>" + data.message + "</p>";
                } else {
                    let availabilityHtml = "<ul>";
                    data.forEach(slot => {
                        let color = (slot.status === 'available') ? 'green' : 'red';
                        availabilityHtml += `<li style="color: ${color}">${slot.date} - ${slot.time_slot}</li>`;
                    });
                    availabilityHtml += "</ul>";
                    availabilityDiv.innerHTML = availabilityHtml;
                }
                availabilityDiv.style.display = 'block';
            })
            .catch(error => console.error('Error fetching availability:', error));
    });
});



        
    </script>
</body>
</html>
