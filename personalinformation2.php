<?php
// Start the session
session_start();
include("db_connection.php"); // Ensure database connection is included

// Hardcoded ID (Replace this later with session ID)
// $smartCardId = $_SESSION['SmartCard_ID']; // Uncomment this when session is implemented
$smartCardId = 'BTBTC22014'; // Hardcoded for now

// Fetch student details
$query = "SELECT * FROM student_details WHERE Id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $smartCardId);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Close the statement
$stmt->close();
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
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus {
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
        .edit-btn {
            background-color: #ffa500;
        }
        .edit-btn:hover {
            background-color: #cc8400;
        }
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }
            input {
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
        <h2>Personal Information</h2>
        <form method="POST" action="">
            <label for="class">Class:</label>
            <input type="text" id="class" name="class" value="<?= htmlspecialchars($student['Class'] ?? '') ?>" readonly>

            <label for="session">Session:</label>
            <input type="text" id="session" name="session" value="<?= htmlspecialchars($student['Session'] ?? '') ?>" readonly>

            <label for="collegeId">College ID:</label>
            <input type="text" id="collegeId" name="collegeId" value="<?= htmlspecialchars($student['Id'] ?? '') ?>" readonly>

            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['Name'] ?? '') ?>" readonly>

            <label for="fathersName">Father's Name:</label>
            <input type="text" id="fathersName" name="fathersName" value="<?= htmlspecialchars($student['fathers_name'] ?? '') ?>" readonly>

            <label for="mothersName">Mother's Name:</label>
            <input type="text" id="mothersName" name="mothersName" value="<?= htmlspecialchars($student['mothers_name'] ?? '') ?>" readonly>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($student['Dob'] ?? '') ?>" readonly>

            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" value="<?= htmlspecialchars($student['Height'] ?? '') ?>" readonly>

            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" value="<?= htmlspecialchars($student['Weight'] ?? '') ?>" readonly>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($student['Address'] ?? '') ?>" readonly>

            <label for="pin">Pin Code:</label>
            <input type="text" id="pin" name="pin" value="<?= htmlspecialchars($student['Pin'] ?? '') ?>" readonly>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($student['Phone'] ?? '') ?>" readonly>

            <label for="collegeEmail">College Email Address:</label>
            <input type="email" id="collegeEmail" name="collegeEmail" value="<?= htmlspecialchars($student['Email'] ?? '') ?>" readonly>

            <button type="button" id="editBtn" class="btn edit-btn">Edit Profile</button>
            <button type="submit" id="updateBtn" class="btn" style="display: none;">Update Profile</button>
        </form>
    </div>

    <script>
        document.getElementById("editBtn").addEventListener("click", function() {
            let inputs = document.querySelectorAll("input:not(#collegeId)");
            inputs.forEach(input => input.removeAttribute("readonly"));
            document.getElementById("editBtn").style.display = "none";
            document.getElementById("updateBtn").style.display = "block";
        });
    </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
    $('#updateBtn').click(function() {
        let formData = {
            class: $('#class').val(),
            session: $('#session').val(),
            collegeId: $('#collegeId').val(),
            name: $('#name').val(),
            fathersName: $('#fathersName').val(),
            mothersName: $('#mothersName').val(),
            dob: $('#dob').val(),
            height: $('#height').val(),
            weight: $('#weight').val(),
            address: $('#address').val(),
            pin: $('#pin').val(),
            phone: $('#phone').val(),
            collegeEmail: $('#collegeEmail').val()
        };

        $.ajax({
            url: 'update_student.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    alert('Profile updated successfully!');
                    $('input').prop('readonly', true);
                } else {
                    alert('Error updating profile. Try again.');
                }
            },
            error: function() {
                alert('AJAX request failed. Check your internet connection.');
            }
        });
    });
});
</script>

</body>
</html>
