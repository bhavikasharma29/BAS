<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['smartcard_id'])) {
    die("Error: SmartCard_ID (doctor_id) is not set in session. Please log in again.");
}


$doctor_id = $_SESSION['smartcard_id'];
$target_dir = "uploads/"; // Ensure this folder exists

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_photo"])) {
    $imageFileType = strtolower(pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION));
    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    if (!in_array($imageFileType, $allowed_types)) {
        die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    $target_file = $target_dir . $doctor_id . "." . $imageFileType;

    // Delete old profile picture if it exists
    $check_sql = "SELECT photo FROM doctors WHERE doctor_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $doctor_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (!empty($row['photo']) && file_exists($row['photo']) && $row['photo'] !== "uploads/default-profile.png") {
            unlink($row['photo']);
        }
    }

    // Move new file
    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
        $update_sql = "UPDATE doctors SET photo = ? WHERE doctor_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $target_file, $doctor_id);
        $update_stmt->execute();
        
        echo json_encode(["success" => true, "imagePath" => $target_file]);
        exit();
    } else {
        echo json_encode(["success" => false, "error" => "File upload error."]);
        exit();
    }
}
?>
