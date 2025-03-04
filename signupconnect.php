<?php
// Enable Error Reporting
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
    // Debugging - Print POST data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $role = trim($_POST['role']);
    $SmartCard_ID = trim($_POST['SmartCard_ID']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Security answers stored as plain text
    $security_a1 = trim(strtolower($_POST['security_a1']));
    
    $security_a2 = trim(strtolower($_POST['security_a2']));
    $security_a3 = trim(strtolower($_POST['security_a3']));
    $security_a4 = trim(strtolower($_POST['security_a4']));
    $security_a5 = trim(strtolower($_POST['security_a5']));

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("<script>alert('Passwords do not match!');</script>");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("<script>alert('Email Address Already Exists!');</script>");
    } else {
        // Debugging - Check if values exist before inserting
        echo "Role: $role, SmartCard_ID: $SmartCard_ID, Email: $email, Password: [HIDDEN], Security Answers: $security_a1, $security_a2, $security_a3, $security_a4, $security_a5 <br>";

        // Insert data using prepared statements
        $stmt = $conn->prepare("INSERT INTO users (role, SmartCard_ID, email, password_hash, security_a1, security_a2, security_a3, security_a4, security_a5) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $role, $SmartCard_ID, $email, $hashed_password, $security_a1, $security_a2, $security_a3, $security_a4, $security_a5);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful!'); window.location.href='personalinformation.php';</script>";
        } else {
            die("Error inserting data: " . $stmt->error);
        }
    }
    $stmt->close();
}

$conn->close();
?>
