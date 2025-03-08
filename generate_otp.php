<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aarogya_seva";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the student Id is provided via POST
if (isset($_POST['Id'])) {
    $studentId = $_POST['Id'];

    // Generate a random 6-digit OTP
    $otp = str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);

    // Set OTP expiry time (e.g., 10 minutes from now)
    $expiryTime = date("Y-m-d H:i:s", strtotime("+10 minutes"));

    // Check if the student exists in the student_details table
    $checkStudentQuery = "SELECT * FROM student_details WHERE Id = ?";
    $stmt = $conn->prepare($checkStudentQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the student's email
        $student = $result->fetch_assoc();
        $email = $student['Email']; // Ensure this column exists in your database

        // Insert OTP into otp_verification table
        $insertOtpQuery = "INSERT INTO otp_verification (Id, otp, expiry_time) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertOtpQuery);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sss", $studentId, $otp, $expiryTime);

        if ($stmt->execute()) {
            // Send OTP to student's email
            $subject = "Your OTP for Medical History Access";
            $message = "Dear Student,\n\nYour OTP for viewing your medical history is: $otp\n\nThis OTP is valid for 10 minutes.\n\nThank you,\nBanasthali Aarogya Seva Team.";
            $headers = "From: noreply.banasthali@gmail.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "OTP generated successfully and sent to email: $email";
            } else {
                echo "OTP generated but failed to send email.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Student with Id $studentId does not exist.";
    }

    $stmt->close();
} else {
    echo "Error: Student Id is required.";
}

$conn->close();
?>
