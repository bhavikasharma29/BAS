<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aarogya_seva";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if Student ID is stored in session
if (!isset($_SESSION['student_id'])) {
    die("Error: Student ID not found in session.");
}

$studentId = $_SESSION['student_id'];

// Fetch student details
$query = "SELECT Name, Id, Address, profile_pic FROM student_details WHERE Id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $studentId);
$stmt->execute();
$result = $stmt->get_result();

$studentData = $result->fetch_assoc() ?? ['Name' => 'N/A', 'Id' => 'N/A', 'Address' => 'N/A', 'profile_pic' => 'default-profile.png'];

$stmt->close();
$conn->close();

// Set profile picture path (Use default if no image is uploaded)
$profilePic = !empty($studentData['profile_pic']) ? $studentData['profile_pic'] : "default-profile.png";
?>


<!-- HTML to Display Student Info -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel {
            max-width: 100%;
            max-height: 450px;
            margin: auto;
        }
        .carousel-inner img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }
        
         
/* Profile Text Section */
/* .section__text {
    max-width: 500px;
} */

/* Address Styling - Responsive & Readable */
/* Address Styling - Adjusted for Two Lines */
/* Address Styling - Keeps UI Same, Only Fixes Long Line */
.section__text p {
    font-size: 16px; /* Keeping it same as before */
    color: #4a4a4a;
    background: #f8f9fa;
    padding: 10px 14px;
    border-radius: 8px;
    display: inline-block;
    max-width: 350px;  /* Limits width to avoid a single long line */
    text-align: center;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
}


/* Optional: If you want Ellipsis for long address */
.address-container {
    max-width: 400px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
}

.address-container:hover {
    white-space: normal;
    word-wrap: break-word;
} */

    </style>
    <link rel="stylesheet" href="style_mentalWell.css">
</head>
<body>

<section id="header">
    <a href="#"><img src="images/logo.jpg" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a class="active" href="index.html">Home</a></li>
            <li><a href="personalinformation.php">Profile</a></li>
            <a href="login.html"><button class="normal">Logout</button></a>
        </ul>
    </div>
</section>

<!-- Profile Section -->
<section id="profile">
    <div id="profile">
        <div class="section__pic-container" onclick="document.getElementById('fileInput').click();">
            <img id="section__pic" src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture">
        </div>
        <div class="section__text">
            <h2><?php echo htmlspecialchars($studentData['Name']); ?></h2>
            <p>ID: <?php echo htmlspecialchars($studentData['Id']); ?></p>
            <p>Address: <?php echo htmlspecialchars($studentData['Address']); ?></p>
        </div>
    </div>
    <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)">
</section>



<!-- Prescription Section -->
<section id="prescription-header" class="blog-header">
    <h2>View Uploaded prescriptions or Generate them Digitally!</h2>
    <div class="d-flex justify-content-center align-items-center gap-3">
        <a href="Meet_History.php">
            <button type="button" class="btn btn-light btn-lg">Generate</button>
        </a>
    </div>
</section>

<section id="prescriptions-section" class="prescriptions-container">
    <div class="table-responsive">
        <h2>Uploaded Prescriptions</h2>
        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Date & Time Issued</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="fileList"></tbody>
        </table>
    </div>
</section>

<script>
function fetchPrescriptions() {
    fetch("fetch_files.php")
        .then(response => response.json())
        .then(files => {
            const fileList = document.getElementById("fileList");
            fileList.innerHTML = "";
            files.forEach(file => {
                let fileHTML = `
                    <tr>
                        <td>
                            <a href="${file.file_path}" target="_blank" title="${file.file_name}">
                                ${file.file_name.length > 30 ? file.file_name.substring(0, 30) + '...' : file.file_name}
                            </a>
                        </td>
                        <td>${new Date(file.uploaded_at).toLocaleString()}</td>
                        <td>
                            <button class="view-button" onclick="viewFile('${file.file_path}')">View</button>
                        </td>
                    </tr>`;
                fileList.insertAdjacentHTML("beforeend", fileHTML);
            });
        })
        .catch(error => console.error("Error fetching files:", error));
}

function viewFile(filePath) {
    window.open(filePath, "_blank");
}

fetchPrescriptions();
</script>

<!-- Mission & Vision Section -->
<section class="mission-vision">
    <div class="container">
        <h2 class="section-title">Our Mission & Vision</h2>
        <div class="content">
            <div class="card mission">
                <h3>🔍 Our Mission</h3>
                <p>
                    To provide students with a secure, efficient, and digital healthcare management system that ensures accessibility to medical records, simplifies doctor interactions, and promotes a healthier campus life.
                </p>
            </div>
            <div class="card vision">
                <h3>🌍 Our Vision</h3>
                <p>
                    To revolutionize student healthcare at **Banasthali Vidyapith** by integrating technology with wellness, ensuring every student receives timely and effective medical care with seamless record-keeping.
                </p>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="devanshi.js"></script>
</body>
</html>
