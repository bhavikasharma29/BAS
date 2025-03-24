<?php
session_start(); // Start the session

// Check if student_id exists in session
if (!isset($_SESSION['student_id'])) {
    die("Error: No student ID found. Request OTP again.");
}

$studentId = $_SESSION['student_id']; // Fetch Student ID from session
?>

<form action="verify_otp.php" method="POST">
    <label for="Id">Student ID:</label>
    <input type="text" name="Id" value="<?php echo htmlspecialchars($studentId); ?>" readonly><br><br>

    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" required><br><br>

    <button type="submit">Verify OTP</button>
</form>
