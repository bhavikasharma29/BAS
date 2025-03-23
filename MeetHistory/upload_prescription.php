<?php
// session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $student_id = "BTBTC22014"; // Hardcoded for now
    $doctor_id = $_POST["doctor_id"] ?? "Unknown";
    $doctor_name = $_POST["doctor_name"] ?? "Not Received"; // Default if missing
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_type = $_FILES["file"]["type"];
    $upload_dir = "generated_prescriptions/";
    $file_path = $upload_dir . basename($file_name);

    echo "Doctor Name Received: $doctor_name"; // Debugging log

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($file_tmp, $file_path)) {
        $sql = "INSERT INTO generated_prescriptions (student_id, doctor_id, doctor_name, file_name, file_type, file_path) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $student_id, $doctor_id, $doctor_name, $file_name, $file_type, $file_path);
        
        if ($stmt->execute()) {
            echo "Prescription uploaded and saved successfully.";
        } else {
            echo "Database error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file received.";
}

$conn->close();
?>
