<?php
session_start();
include 'db_connection.php'; // Ensure this file connects to your database
//  // Fetch from session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hardcoded SmartCard_ID for now
    $student_id = 'BTBTC22014';

    $upload_dir = 'uploads/'; // Directory to store uploaded files

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create directory if not exists
    }

    if (isset($_FILES['file'])) {
        $file_name = basename($_FILES['file']['name']);
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_path = $upload_dir . $file_name; // Full file path

        // Move file to upload directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert file info into database
            $stmt = $conn->prepare("INSERT INTO prescriptions (student_id, file_name, file_path, file_type) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $student_id, $file_name, $file_path, $file_type);
            if ($stmt->execute()) {
                echo json_encode(["success" => "File uploaded successfully.", "file" => $file_name]);
            } else {
                echo json_encode(["error" => "Database error: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["error" => "File upload failed."]);
        }
    } else {
        echo json_encode(["error" => "No file uploaded."]);
    }
}
?>
