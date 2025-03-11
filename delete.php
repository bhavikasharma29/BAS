<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    die("Unauthorized Access");
}

if (isset($_POST['file'])) {
    $filePath = "uploads/" . $_POST['file'];
    if (file_exists($filePath)) {
        unlink($filePath);
        echo "Deleted";
    } else {
        echo "File not found";
    }
}
?>
