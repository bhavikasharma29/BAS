<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "aarogya_seva";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SmartCard_ID = trim($_POST['SmartCard_ID']);
    $security_a1 = strtolower(trim($_POST['security_a1']));
    $security_a2 = strtolower(trim($_POST['security_a2']));
    $security_a3 = strtolower(trim($_POST['security_a3']));
    $security_a4 = strtolower(trim($_POST['security_a4']));
    $security_a5 = strtolower(trim($_POST['security_a5']));

    // Fetch stored answers from the database
    $stmt = $conn->prepare("SELECT security_a1, security_a2, security_a3, security_a4, security_a5 FROM users WHERE SmartCard_ID = ?");
    $stmt->bind_param("s", $SmartCard_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Check if all answers match exactly
        if (
            $security_a1 === strtolower($row['security_a1']) &&
            $security_a2 === strtolower($row['security_a2']) &&
            $security_a3 === strtolower($row['security_a3']) &&
            $security_a4 === strtolower($row['security_a4']) &&
            $security_a5 === strtolower($row['security_a5'])
        ) {
            // Redirect to reset password page with SmartCard_ID
            header("Location: reset_password.php?SmartCard_ID=" . urlencode($SmartCard_ID));
            exit();
        } else {
            echo "<script>alert('Security answers do not match. Please try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('SmartCard ID not found!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
