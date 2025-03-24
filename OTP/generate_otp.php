<?php
session_start(); // Start session to store Student ID
date_default_timezone_set("Asia/Kolkata");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aarogya_seva";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the Student ID is provided
if (isset($_POST['Id'])) {
    $studentId = trim($_POST['Id']);
    $_SESSION['student_id'] = $studentId; // 🔹 Store Student ID in session

    // Generate OTP
    $otp = str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
    $expiryTime = date("Y-m-d H:i:s", strtotime("+10 minutes"));

    // Check if student exists
    $stmt = $conn->prepare("SELECT Email FROM student_details WHERE Id = ?");
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $email = $student['Email'];

        // Insert or update OTP in the database
        $stmt = $conn->prepare("INSERT INTO otp_verification (Id, otp, expiry_time) VALUES (?, ?, ?) 
                                ON DUPLICATE KEY UPDATE otp=?, expiry_time=?");
        $stmt->bind_param("sssss", $studentId, $otp, $expiryTime, $otp, $expiryTime);
        $stmt->execute();

        // Send OTP email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply.banathali@gmail.com';  // 🔹 Replace with your email
            $mail->Password = 'jnknrtxswhhuquri';    // 🔹 Use 16-character App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreply.banathali@gmail.com', 'Banasthali Aarogya Seva');
            $mail->addAddress($email);
            $mail->Subject = "Your OTP for Medical History Access";
            $mail->Body = "Dear Student,\n\nYour OTP is: $otp\nValid for 10 minutes.\n\nThank you,\nBanasthali Aarogya Seva Team.";

            if ($mail->send()) {
                echo "✅ OTP sent to $email";
                echo "<br><a href='otp_input.php'>Enter OTP</a>"; // Link to OTP form
            } else {
                echo "⚠️ OTP generated but email failed.";
            }
        } catch (Exception $e) {
            echo "Email error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ Student ID not found.";
    }
    $stmt->close();
} else {
    echo "❌ Student ID required.";
}

$conn->close();
?>
