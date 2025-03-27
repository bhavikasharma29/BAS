<?php
session_start(); // Start the session

// Check if the user is logged in
// if (!isset($_SESSION['collegeId'])) {
//     die("Access Denied. Please log in.");
// }

// $collegeId = $_SESSION['collegeId']; // Fetch College ID from 
$collegeId='btbtx123';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aarogya_seva";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student details using College ID
$sql = "SELECT * FROM student_details WHERE Id = '$collegeId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("No data found for this College ID.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f0ff;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border: 2px solid #0056b3;
        }
        h2 {
            text-align: center;
            color: #0056b3;
        }
        label {
            font-weight: bold;
            color: #003366;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f0f0f0;
        }
        input:read-only {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student's Info</h2>
        <label>Class:</label>
        <input type="text" value="<?php echo $row['Class']; ?>" readonly>
        
        <label>Session:</label>
        <input type="text" value="<?php echo $row['Session']; ?>" readonly>
        
        <label>College ID:</label>
        <input type="text" value="<?php echo $row['Id']; ?>" readonly>
        
        <label>Full Name:</label>
        <input type="text" value="<?php echo $row['Name']; ?>" readonly>
        
        <label>Father's Name:</label>
        <input type="text" value="<?php echo $row['fathers_name']; ?>" readonly>
        
        <label>Mother's Name:</label>
        <input type="text" value="<?php echo $row['mothers_name']; ?>" readonly>
        
        <label>Date of Birth:</label>
        <input type="text" value="<?php echo $row['Dob']; ?>" readonly>
        
        <label>Height (cm):</label>
        <input type="text" value="<?php echo $row['Height']; ?>" readonly>
        
        <label>Weight (kg):</label>
        <input type="text" value="<?php echo $row['Weight']; ?>" readonly>
        
        <label>Address:</label>
        <input type="text" value="<?php echo $row['Address']; ?>" readonly>
        
        <label>Pin Code:</label>
        <input type="text" value="<?php echo $row['Pin']; ?>" readonly>
        
        <label>Phone Number:</label>
        <input type="text" value="<?php echo $row['Phone']; ?>" readonly>
        
        <label>College Email:</label>
        <input type="text" value="<?php echo $row['Email']; ?>" readonly>
        
        <label>Hostel Name:</label>
        <input type="text" value="<?php echo $row['hostel_name']; ?>" readonly>
    </div>
</body>
</html>
