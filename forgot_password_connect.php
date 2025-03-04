<?php
// Enable Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "aarogya_seva";

$conn = new mysqli($host, $user, $pass, $db);

// Check Connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SmartCard_ID = trim($_POST['SmartCard_ID']);
    $security_a1 = trim(strtolower($_POST['security_a1']));
    $security_a2 = trim(strtolower($_POST['security_a2']));
    $security_a3 = trim(strtolower($_POST['security_a3']));
    $security_a4 = trim(strtolower($_POST['security_a4']));
    $security_a5 = trim(strtolower($_POST['security_a5']));

    // Fetch stored answers from DB
    $stmt = $conn->prepare("SELECT security_a1, security_a2, security_a3, security_a4, security_a5 FROM users WHERE SmartCard_ID = ?");
    $stmt->bind_param("s", $SmartCard_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Convert stored answers to lowercase for case-insensitive comparison
        $stored_a1 = trim(strtolower($row['security_a1']));
        $stored_a2 = trim(strtolower($row['security_a2']));
        $stored_a3 = trim(strtolower($row['security_a3']));
        $stored_a4 = trim(strtolower($row['security_a4']));
        $stored_a5 = trim(strtolower($row['security_a5']));

        // Check if all answers match
        if (
            $security_a1 == $stored_a1 &&
            $security_a2 == $stored_a2 &&
            $security_a3 == $stored_a3 &&
            $security_a4 == $stored_a4 &&
            $security_a5 == $stored_a5
        ) {
            echo "<script>alert('Verification successful! Proceed to reset your password.'); window.location.href='resetpassword.php';</script>";
        } else {
            echo "<script>alert('Incorrect answers! Please try again.'); window.location.href='forgotPassword.php';</script>";
        }
    } else {
        echo "<script>alert('SmartCard_ID not found!'); window.location.href='forgotPassword.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
