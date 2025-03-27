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
    $sql = "INSERT INTO student_details (`Class`, `Session`, `Id`, `Name`, `Fathers_name`, `Mothers_name`, `Dob`, `Height`, `Weight`, `Address`, `Pin`, `Phone`, `Email`)
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
            padding: 40px;
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

        .error {
    font-size: 12px;
    color: red;
}
.required {
    color: red;
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
    <div style="display:flex; justify-content:space-evenly; align-items:center;">
   <img src="images/logo.jpg" alt="Banasthali Vidyapith Logo" class="logo" >
        <h2>Personal Information</h2>
        </div>
        <form method="POST" action="" style="margin-top:30px;" id="infoForm">
    <label for="class">Class:<span class="required"></span></label>
    <input type="text" id="class" name="class" placeholder="Enter your class" required>
    <span class="error"></span>

    <label for="session">Session:<span class="required"></span></label>
    <input type="text" id="session" name="session" placeholder="Enter your session" required>
    <span class="error"></span>

    <label for="collegeId">College ID:<span class="required"></span></label>
    <input type="text" id="collegeId" name="collegeId" placeholder="Enter your College ID" required>
    <span class="error"></span>

    <label for="name">Full Name:<span class="required"></span></label>
    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
    <span class="error"></span>

    <label for="fathersName">Father's Name:<span class="required"></span></label>
    <input type="text" id="fathersName" name="fathersName" placeholder="Enter your father's name" required>
    <span class="error"></span>

    <label for="mothersName">Mother's Name:<span class="required"></span></label>
    <input type="text" id="mothersName" name="mothersName" placeholder="Enter your mother's name" required>
    <span class="error"></span>

    <label for="dob">Date of Birth:<span class="required"></span></label>
    <input type="date" id="dob" name="dob" required>
    <span class="error"></span>

    <label for="height">Height (cm):<span class="required"></span></label>
    <input type="number" id="height" name="height" placeholder="Enter your height" required>
    <span class="error"></span>

    <label for="weight">Weight (kg):<span class="required"></span></label>
    <input type="number" id="weight" name="weight" placeholder="Enter your weight" required>
    <span class="error"></span>

    <label for="pin">Pin Code:<span class="required"></span></label>
    <input type="text" id="pin" name="pin" placeholder="Enter your pin code" required>
    <span class="error"></span>

    <label for="phone">Phone Number:<span class="required"></span></label>
    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
    <span class="error"></span>

    <label for="collegeEmail">College Email Address:<span class="required"></span></label>
    <input type="email" id="collegeEmail" name="collegeEmail" placeholder="Enter your college email address" required>
    <span class="error"></span>

    <button type="submit" class="btn">Submit</button>
</form>

    </div>

    <script>
       document.getElementById("infoForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission until all validations pass

    let isValid = true; // Flag to check if form is valid

    function setError(fieldId, message) {
        let inputField = document.getElementById(fieldId);
        let errorSpan = inputField.nextElementSibling; // Error message span
        let label = inputField.previousElementSibling; // Label

        errorSpan.textContent = message;
        errorSpan.style.color = "red";

        // Add a red asterisk to the label
        label.querySelector(".required").textContent = " *";
        label.querySelector(".required").style.color = "red";

        isValid = false; // Mark form as invalid
    }

    function clearError(fieldId) {
        let inputField = document.getElementById(fieldId);
        let errorSpan = inputField.nextElementSibling;
        let label = inputField.previousElementSibling;

        errorSpan.textContent = ""; // Clear error message
        label.querySelector(".required").textContent = ""; // Remove asterisk
    }

    // 1. Class Validation
    let classValue = document.getElementById("class").value.trim();
    if (!/^[A-Za-z]+\s+\d{1,2}(st|nd|rd|th)\s+year$/.test(classValue)) {
        setError("class", "Format: 'B.Tech 3rd year' or 'BBA 2nd year'.");
    } else {
        clearError("class");
    }

    // 2. Session Validation
    let sessionValue = document.getElementById("session").value.trim();
    if (!/^\d{4}-\d{2}$/.test(sessionValue)) {
        setError("session", "Format: '2022-23', '2024-25'.");
    } else {
        clearError("session");
    }

    // 3. College ID Validation
    let collegeIdValue = document.getElementById("collegeId").value.trim();
    if (!/^[A-Za-z]{5}\d{5}$/.test(collegeIdValue)) {
        setError("collegeId", "Must be 5 letters + 5 numbers (e.g., btbtc22345).");
    } else {
        clearError("collegeId");
    }

    // 4. Name Validations
    let namePattern = /^[A-Za-z\s]+$/;
    ["name", "fathersName", "mothersName"].forEach((field) => {
        let value = document.getElementById(field).value.trim();
        if (!namePattern.test(value)) {
            setError(field, "Only alphabets allowed.");
        } else {
            clearError(field);
        }
    });

    // 5. Date of Birth Validation
    let dobValue = document.getElementById("dob").value;
    let age = new Date().getFullYear() - new Date(dobValue).getFullYear();
    if (age < 16) {
        setError("dob", "Age must be at least 16.");
    } else {
        clearError("dob");
    }

    // 6. Height and Weight Validation
    let heightValue = parseInt(document.getElementById("height").value);
    let weightValue = parseInt(document.getElementById("weight").value);
    if (heightValue < 120) setError("height", "Minimum height: 120 cm.");
    else clearError("height");
    if (weightValue < 25) setError("weight", "Minimum weight: 25 kg.");
    else clearError("weight");

    // 7. Pin Code Validation
    let pinValue = document.getElementById("pin").value.trim();
    if (!/^\d{5}$/.test(pinValue)) {
        setError("pin", "Must be exactly 5 digits.");
    } else {
        clearError("pin");
    }

    // 8. Phone Number Validation
    let phoneValue = document.getElementById("phone").value.trim();
    if (!/^\d{10}$/.test(phoneValue)) {
        setError("phone", "Must be exactly 10 digits.");
    } else {
        clearError("phone");
    }

    // 9. College Email Validation
    let emailValue = document.getElementById("collegeEmail").value.trim();
    if (!/^[a-zA-Z0-9]{10}_[a-zA-Z]+@banasthali\.in$/.test(emailValue)) {
        setError("collegeEmail", "Format: 'college_id_name@banasthali.in'.");
    } else {
        clearError("collegeEmail");
    }

    // If all fields are valid, submit the form
    if (isValid) this.submit();
});


    </script>
</body>
</html>
