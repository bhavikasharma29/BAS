<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["doctor_id"]) || !isset($data["slots"]) || !isset($data["date"])) {
        die("Error: Missing data!");
    }

    $doctor_id = $data["doctor_id"];
    $slots = $data["slots"];
    $date = $data["date"];

    if (empty($doctor_id) || empty($slots) || empty($date)) {
        die("Error: Doctor ID, Slots, or Date cannot be empty!");
    }

    $connection = new mysqli("localhost", "root", "", "aarogya_seva");
    if ($connection->connect_error) {
        die("Database connection failed: " . $connection->connect_error);
    }

    // Convert array of slots into JSON for database storage
    $slots_json = json_encode($slots);

    $stmt = $connection->prepare("INSERT INTO doctor_availability (doctor_id, time_slot, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $doctor_id, $slots_json, $date);

    if ($stmt->execute()) {
        echo "Availability saved successfully!";
    } else {
        echo "Error saving availability.";
    }

    $stmt->close();
    $connection->close();
}
?>
