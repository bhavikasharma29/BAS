<?php
session_start();
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Id = $_POST['Id'];
    $entered_otp = $_POST['otp'];

    // Check OTP in the database
    $query = "SELECT otp, expiry_time FROM otp_verification WHERE Id = ? ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $otp_data = $result->fetch_assoc();
        $stored_otp = $otp_data['otp'];
        $expiry_time = $otp_data['expiry_time'];

        if ($entered_otp == $stored_otp && strtotime($expiry_time) > time()) {
            echo "Access granted! Displaying medical history...";
            // Fetch and display the student's medical history
        } else {
            echo "Invalid or expired OTP!";
        }
    } else {
        echo "No OTP found for this student ID.";
    }
}
?>
