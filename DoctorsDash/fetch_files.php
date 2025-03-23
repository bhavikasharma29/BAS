<?php
include 'db_connection.php';

$student_id = 'BTBTC22014'; // Replace with session-based ID if needed

$sql = "SELECT id, file_name, file_path FROM prescriptions WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($files);
?>
