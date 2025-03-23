<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $file_id = $_GET['id'];

    // Fetch file details
    $stmt = $conn->prepare("SELECT file_path FROM prescriptions WHERE id = ?");
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    if ($file_path && file_exists($file_path)) {
        if (unlink($file_path)) {
            // Delete from database
            $stmt = $conn->prepare("DELETE FROM prescriptions WHERE id = ?");
            $stmt->bind_param("i", $file_id);
            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "Failed to delete from database."]);
            }
        } else {
            echo json_encode(["error" => "Failed to delete file from server."]);
        }
    } else {
        echo json_encode(["error" => "File not found."]);
    }
} else {
    echo json_encode(["error" => "No file ID provided."]);
}
?>
