<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    die("Unauthorized Access");
}

if (isset($_FILES['file'])) {
    $uploadDir = "uploads/";
    $filePath = $uploadDir . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
    echo "File uploaded successfully!";
}
?>
