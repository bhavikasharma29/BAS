<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aarogya_seva";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if OTP and Student ID are provided
if (isset($_POST['Id']) && isset($_POST['otp'])) {
    $studentId = $_POST['Id'];
    $enteredOtp = $_POST['otp'];

    // Fetch the latest OTP for this student
    $fetchOtpQuery = "SELECT otp, expiry_time FROM otp_verification WHERE Id = ? ORDER BY expiry_time DESC LIMIT 1";
    $stmt = $conn->prepare($fetchOtpQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $otpData = $result->fetch_assoc();
        $storedOtp = $otpData['otp'];
        $expiryTime = $otpData['expiry_time'];

        // Check if OTP is correct and not expired
        if ($enteredOtp === $storedOtp) {
            if (strtotime($expiryTime) >= time()) {
                echo "OTP verification successful. Access granted!";
                // Redirect doctor to the medical history page
                // header("Location: medical_history.php?Id=$studentId");
                // exit();
            } else {
                echo "Error: OTP has expired. Please request a new one.";
            }
        } else {
            echo "Error: Invalid OTP. Please try again.";
        }
    } else {
        echo "Error: No OTP found for this Student ID.";
    }

    $stmt->close();
} else {
    echo "Error: Student ID and OTP are required.";
}

$conn->close();
?>
