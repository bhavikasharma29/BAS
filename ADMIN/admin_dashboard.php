<?php
include 'db_connection.php'; // Ensure you have a database connection file

$response = array();

$query_students = "SELECT COUNT(*) AS total_students FROM student_details";
$query_doctors = "SELECT COUNT(*) AS total_doctors FROM doctors";

$result_students = mysqli_query($conn, $query_students);
$result_doctors = mysqli_query($conn, $query_doctors);

if ($result_students && $result_doctors) {
    $row_students = mysqli_fetch_assoc($result_students);
    $row_doctors = mysqli_fetch_assoc($result_doctors);

    // Ensure data is properly returned
    // $response['total_students'] = $row_students['total_students'];
    // $response['total_doctors'] = $row_doctors['total_doctors'];
} 
// else {
//     $response['total_students'] = 0;
//     $response['total_doctors'] = 0;
// }

// echo json_encode($response);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Doctor Availability</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .header {
            background: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .stat-box {
            background: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            flex: 1;
            margin: 5px;
        }
        .time-slot-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            padding: 10px;
        }
        .time-slot {
            padding: 12px;
            text-align: center;
            background: #ff4d4d;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        .time-slot:hover {
            background: #ff1a1a;
        }
        .available {
            background: #4CAF50 !important;
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            background: #007BFF;
            color: white;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Admin Dashboard</div>
        
        <div class="stats">
            <div class="stat-box">Total Students: <span id="totalStudents">0</span></div>
            <div class="stat-box">Total Doctors: <span id="totalDoctors">0</span></div>
            <!-- <div class="stat-box">Active Users: <span id="activeUsers">0</span></div> -->
        </div>
        
        <h3>Manage Doctor Availability</h3>
        <label for="doctorSelect">Select Doctor:</label>
        <select id="doctorSelect"></select>
        
        <h4>Select Time Slots:</h4>
        <div class="time-slot-container" id="timeSlots"></div>
        <button onclick="saveAvailability()">Save Schedule</button>
    </div>

<script>

    document.addEventListener("DOMContentLoaded", function () {
    console.log("Fetching counts..."); // Debugging
    fetchCounts();
    fetchDoctors();
    generateTimeSlots();
});

// Function to fetch total students & doctors
function fetchCounts() {
    console.log("Fetching counts..."); // Debugging log
    fetch("fetch_counts.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(data => {
            console.log("Counts fetched:", data); // Debugging log
            if (data.total_students && data.total_doctors) {
                document.getElementById("totalStudents").textContent = data.total_students;
                document.getElementById("totalDoctors").textContent = data.total_doctors;
            } else {
                console.error("Invalid data format:", data);
            }
        })
        .catch(error => console.error("Error fetching counts:", error));
}

// Function to fetch doctors from the database
function fetchDoctors() {
    let doctorSelect = document.getElementById("doctorSelect");
    if (!doctorSelect) return;

    fetch("fetch_doctors.php")
        .then(response => response.json())
        .then(data => {
            console.log("Doctors fetched:", data);

            doctorSelect.innerHTML = "";
            let defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.textContent = "Select a doctor";
            defaultOption.disabled = true;
            defaultOption.selected = true;
            doctorSelect.appendChild(defaultOption);

            data.forEach(doctor => {
                let option = document.createElement("option");
                option.value = doctor.doctor_id;
                option.textContent = doctor.name;
                doctorSelect.appendChild(option);
            });

            console.log("Dropdown updated successfully.");
        })
        .catch(error => console.error("Error fetching doctors:", error));
}

// Function to generate time slots
function generateTimeSlots() {
    let timeSlots = [
        "08:00 AM - 09:00 AM", "09:00 AM - 10:00 AM", "10:00 AM - 11:00 AM", "11:00 AM - 12:00 PM",
        "12:00 PM - 01:00 PM", "01:00 PM - 02:00 PM", "02:00 PM - 03:00 PM", "03:00 PM - 04:00 PM",
        "04:00 PM - 05:00 PM", "05:00 PM - 06:00 PM", "06:00 PM - 07:00 PM", "07:00 PM - 08:00 PM"
    ];
    let container = document.getElementById("timeSlots");
    if (!container) return;

    container.innerHTML = "";
    timeSlots.forEach(slot => {
        let div = document.createElement("div");
        div.className = "time-slot";
        div.textContent = slot;
        div.onclick = function () { this.classList.toggle("available"); };
        container.appendChild(div);
    });
}

// Function to save availability slots for a doctor
function saveAvailability() {
    let doctorId = document.getElementById("doctorSelect").value;
    if (!doctorId) {
        alert("Please select a doctor.");
        return;
    }

    let selectedSlots = [];
    document.querySelectorAll(".available").forEach(slot => {
        selectedSlots.push(slot.textContent);
    });

    if (selectedSlots.length === 0) {
        alert("Please select at least one time slot.");
        return;
    }

    let today = new Date().toISOString().split('T')[0]; // Formats as YYYY-MM-DD

    fetch("save_availability.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ doctor_id: doctorId, slots: selectedSlots, date: today })
    })
        .then(response => response.text())
        .then(data => alert(data))
        .catch(error => console.error("Error saving availability:", error));
}

// Function to fetch and display doctor's saved time slots
function fetchDoctorAvailability(doctorId) {
    if (!doctorId) return;

    fetch(`fetch_doctor_availability.php?doctor_id=${doctorId}`)
        .then(response => response.json())
        .then(data => {
            console.log("Doctor availability fetched:", data);
            let selectedSlots = new Set(data.time_slots || []); // Convert to Set for quick lookup
            document.querySelectorAll(".time-slot").forEach(slot => {
                if (selectedSlots.has(slot.textContent)) {
                    slot.classList.add("available");
                } else {
                    slot.classList.remove("available");
                }
            });
        })
        .catch(error => console.error("Error fetching doctor availability:", error));
}

// Listen for doctor selection change

document.addEventListener("DOMContentLoaded", function () {
    fetchCounts();
    fetchDoctors();
    generateTimeSlots();
});

</script>
</body>
</html>