<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "aarogya_seva";
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get SmartCard_ID and new password
    $smartcard_id = trim($_POST['SmartCard_ID']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate that both passwords match
    if ($new_password !== $confirm_password) {
        die("<script>alert('Passwords do not match!'); window.history.back();</script>");
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password in database
    $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE SmartCard_ID = ?");
    $stmt->bind_param("ss", $hashed_password, $smartcard_id);

    if ($stmt->execute()) {
        echo "<script>alert('Password reset successful! Please login.'); window.location.href='login.php';</script>";
    } else {
        die("Error updating password: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
