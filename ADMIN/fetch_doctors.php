<?php
$connection = new mysqli("localhost", "root", "", "aarogya_seva");

if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

$query = "SELECT doctor_id, name FROM doctors";
$result = $connection->query($query);

$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

echo json_encode($doctors);
$connection->close();
?>
