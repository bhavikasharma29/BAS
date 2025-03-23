<?php
session_start();
include 'db_connection.php';

$student_id = "BTBTC22014"; // Hardcoded for now

$sql = "SELECT file_name, file_path, date_issued, doctor_name FROM generated_prescriptions WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$prescriptions = [];
while ($row = $result->fetch_assoc()) {
    $prescriptions[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($prescriptions);
?>
