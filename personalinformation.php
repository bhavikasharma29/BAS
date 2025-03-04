<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aarogya_seva";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $class = $_POST['class'];
    $session = $_POST['session'];
    $collegeId = $_POST['collegeId'];
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

    // SQL query to insert data
    $sql = "INSERT INTO student_details (`Class`, `Session`, `Id`, `Name`, `Father's name`, `Mother's name`, `Dob`, `Height`, `Weight`, `Address`, `Pin`, `Phone`, `Email`)
            VALUES ('$class', '$session', '$collegeId', '$name', '$fathersName', '$mothersName', '$dob', '$height', '$weight', '$address', '$pin', '$phone', '$collegeEmail')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data submitted successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f0ff;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border: 2px solid #0056b3;
        }

        h2 {
            text-align: center;
            color: #0056b3;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #003366;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus, select:focus {
            border-color: #0056b3;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
        }

        .btn {
            background-color: #0056b3;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #003366;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

           .logo{
            position: absolute;
            top: 10px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 100px;
           }
            input, select {
                font-size: 14px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
   <img src="bv_logo.jpg" alt="Banasthali Vidyapith Logo" class="logo"  width= "150" height= "150">
   <img src="bv_logo1.jpg" alt="Banasthali Vidyapith Logo" class="logo"  width= "150" height= "150">
        <h2>Personal Information</h2>
        <form method="POST" action="">
            <label for="class">Class:</label>
            <input type="text" id="class" name="class" placeholder="Enter your class" required>

            <label for="session">Session:</label>
            <input type="text" id="session" name="session" placeholder="Enter your session" required>

            <label for="collegeId">College ID:</label>
            <input type="text" id="collegeId" name="collegeId" placeholder="Enter your College ID" required>

            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="fathersName">Father's Name:</label>
            <input type="text" id="fathersName" name="fathersName" placeholder="Enter your father's name" required>

            <label for="mothersName">Mother's Name:</label>
            <input type="text" id="mothersName" name="mothersName" placeholder="Enter your mother's name" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" placeholder="YYYY-MM-DD" required>

            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" placeholder="Enter your height" required>

            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" placeholder="Enter your weight" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" required>

            <label for="pin">Pin Code:</label>
            <input type="text" id="pin" name="pin" placeholder="Enter your pin code" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="collegeEmail">College Email Address:</label>
            <input type="email" id="collegeEmail" name="collegeEmail" placeholder="Enter your college email address" required>

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>
