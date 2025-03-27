
<?php
session_start();

// Check if doctor is logged in
// if (!isset($_SESSION['doctor_id'])) {
//     die("Access Denied: Please log in first.");
// }

// $doctor_id = $_SESSION['doctor_id'];
$doctor_id = 'DOC1002'; 

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aarogya_seva";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch doctor details
$sql = "SELECT name, email, gender, contact_number, specialization, sitting_hours FROM doctors WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $doctor = $result->fetch_assoc();
} else {
    die("No doctor found with the given ID.");
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e6f0ff; }
        .container { max-width: 600px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #0056b3; }
        .info { margin-bottom: 10px; font-size: 18px; color: #003366; }
        .label { font-weight: bold; color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Personal Information</h2>
        <p class="info"><span class="label">Name:</span> <?php echo htmlspecialchars($doctor['name']); ?></p>
        <p class="info"><span class="label">Email:</span> <?php echo htmlspecialchars($doctor['email']); ?></p>
        <p class="info"><span class="label">Gender:</span> <?php echo htmlspecialchars($doctor['gender']); ?></p>
        <p class="info"><span class="label">Contact Number:</span> <?php echo htmlspecialchars($doctor['contact_number']); ?></p>
        <p class="info"><span class="label">Specialization:</span> <?php echo htmlspecialchars($doctor['specialization']); ?></p>
        <p class="info"><span class="label">Sitting Hours:</span> <?php echo htmlspecialchars($doctor['sitting_hours']); ?></p>
    </div>
</body>
</html>

