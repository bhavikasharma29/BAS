<?php
require 'db_connection.php'; // Ensure you have a database connection file

// Query to count total students
$studentQuery = "SELECT COUNT(*) AS total_students FROM student_details";
$studentResult = mysqli_query($conn, $studentQuery);
$studentRow = mysqli_fetch_assoc($studentResult);
$totalStudents = $studentRow['total_students'];

// Query to count total doctors
$doctorQuery = "SELECT COUNT(*) AS total_doctors FROM doctors";
$doctorResult = mysqli_query($conn, $doctorQuery);
$doctorRow = mysqli_fetch_assoc($doctorResult);
$totalDoctors = $doctorRow['total_doctors'];

// Return JSON response
echo json_encode([
    'total_students' => $totalStudents,
    'total_doctors' => $totalDoctors
]);
?>
