<?php
session_start();
include("db_connection.php");

// Hardcoded ID for now (Replace with session variable when ready)
$smartCardId = 'BTBTC22014'; // $_SESSION['SmartCard_ID'];

// Debug: Check if the SmartCard_ID is correctly retrieved
if (!$smartCardId) {
    echo "error: SmartCard_ID not set";
    exit();
}

// Get form data from AJAX request
$class = $_POST['class'];
$session = $_POST['session'];
$name = $_POST['name'];
$fathersName = $_POST['fathersName'];
$mothersName = $_POST['mothersName'];
$dob = $_POST['dob'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$address = $_POST['address'];
$pin = $_POST['pin'];
$phone = $_POST['phone'];
$collegeEmail = $_POST['collegeEmail'];

// Ensure the update query only affects ONE record
$query = "UPDATE student_details SET 
    Class = ?, 
    Session = ?, 
    Name = ?, 
    fathers_name = ?, 
    mothers_name = ?, 
    Dob = ?, 
    Height = ?, 
    Weight = ?, 
    Address = ?, 
    Pin = ?, 
    Phone = ?, 
    Email = ? 
WHERE Id = ? LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssssssss", 
    $class, $session, $name, $fathersName, $mothersName, 
    $dob, $height, $weight, $address, $pin, 
    $phone, $collegeEmail, $smartCardId);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
