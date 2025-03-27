<?php
session_start();
include 'db_connection.php';

// Ensure doctor_id (SmartCard_ID) exists in session
if (!isset($_SESSION['smartcard_id'])) {
    die("Error: SmartCard_ID (doctor_id) is not set in session. Please log in again.");
}
// $doctor_id = 'DOC1002'; 
// Get doctor_id from session
$doctor_id = $_SESSION['smartcard_id'];

// Fetch doctor details from `doctors` table
$sql = "SELECT name, doctor_id, specialization, photo FROM doctors WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error: SQL statement preparation failed. " . $conn->error);
}

$stmt->bind_param("s", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $doctor = $result->fetch_assoc();
    $doctor_name = $doctor['name'];
    $doctor_specialization = $doctor['specialization'];
    $doctor_photo = !empty($doctor['photo']) ? $doctor['photo'] : "uploads/default-profile.png"; // Ensure default image is in 'uploads/'
} else {
    die("Error: Doctor details not found in the database!");
}

// Handle profile picture upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_photo"])) {
    $target_dir = "uploads/"; // Ensure this folder exists and has correct permissions
    
    // Create the uploads directory if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Get file extension
    $imageFileType = strtolower(pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION));
    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    // Validate file type
    if (!in_array($imageFileType, $allowed_types)) {
        die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Generate a unique filename for storage
    $target_file = $target_dir . $doctor_id . "." . $imageFileType;

    // Move the uploaded file
    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
        // Update photo path in the database
        $update_sql = "UPDATE doctors SET photo = ? WHERE doctor_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        if ($update_stmt) {
            $update_stmt->bind_param("ss", $target_file, $doctor_id);
            $update_stmt->execute();
        }

        // Refresh page to reflect the new image
        header("Location: docDash.php");
        exit();
    } else {
        die("Error: There was an issue uploading your file.");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .carousel {
            max-width: 100%;  /* Adjust width */
            max-height: 450px; /* Adjust height */
            margin: auto; /* Center it */
        }

        .carousel-inner img {
            width: 100%; /* Ensures responsiveness */
            height: 450px; /* Set fixed height */
            object-fit: cover; /* Prevents image distortion */
        }
 
        #otp {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        margin: 0;
    }
    .otpcontainer {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 700px;
    }
    .otpcontainer h2 {
        color: #007bff;
        margin-bottom: 20px;
    }
    .request {
        display: flex;
        align-items: center;
        gap: 10px; /* Space between elements */
        justify-content: center;
        margin-bottom: 15px;
    }
    .otpcontainer label {
        font-weight: bold;
        color: #333;
        white-space: nowrap; /* Prevents label from wrapping */
    }
    .otpcontainer input[type="text"] {
        flex: 1;
        padding: 8px;
        border: 1px solid #007bff;
        border-radius: 5px;
        min-width: 150px; /* Ensures input is not too small */
    }
    .otpcontainer button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .otpcontainer button:hover {
        background-color: #0056b3;
    }
    #otp-section {
        display: none; /* Initially hidden */
    }
    </style>
    <link rel="stylesheet" href="style_mentalWell.css">
</head>
<body>
    <section id="header">
        <a href="#"><img src="images/logo.jpg" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <!-- <li><a href="Blog.html">Blog</a></li> -->
                <li><a href="personalinformation.php">Profile</a></li>
                <a href="login.html"><button class="normal">Logout</button></a>
            </ul>
        </div>
    </section>

    <section>
        <section id="home-header" class="blog-header">
            <h1>Welcome to Doctors Dashboard</h1>
        </section>
    </section>

       <!-- personalisation -->
       <section id="profile">
    <div class="section__pic-container" onclick="document.getElementById('fileInput').click();">
        <img id="section__pic" src="<?php echo htmlspecialchars($doctor_photo); ?>" alt="profile">
    </div>
    <div class="section__text">
        <h2><?php echo htmlspecialchars($doctor_name); ?></h2>
        <p><?php echo htmlspecialchars($doctor_id); ?></p>
        <p><?php echo htmlspecialchars($doctor_specialization); ?></p>
    </div>

    <!-- Hidden form to upload profile picture -->
    <form id="uploadForm" action="doc_profile.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="fileInput" name="profile_photo" accept="image/*" onchange="uploadImage()">
        <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
    </form>
</section>


      <section id="otp">
    <div class="otpcontainer">
        <h2 style="text-align:center;">Request Student's Medical History</h2>

        <div class="request">
        <a href="Trydoctor_request.php">
      <button type="button" class="btn btn-light btn-lg px-4 me-2">
          otp verification
      </button>
  </a>
        </div>

        
    </div>

</section>
<script>
        function uploadImage() {
            document.getElementById('uploadForm').submit(); // Automatically submit when a file is selected
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="devanshi.js"></script>
</body>
</html>
