<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_connection.php'; // Ensure your database connection is correct

if (!isset($_GET['Id'])) {
    echo json_encode(["success" => false, "message" => "Missing SmartCard_ID"]);
    exit();
}

$smartCardId = $_GET['Id'];

$query = "SELECT * FROM students WHERE Id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $smartCardId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $studentData = $result->fetch_assoc();
    echo json_encode(["success" => true, "data" => $studentData]);
} else {
    echo json_encode(["success" => false, "message" => "No student found"]);
}
?>
