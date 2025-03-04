<?php
// Ensure SmartCard_ID is received via URL
if (!isset($_GET['SmartCard_ID'])) {
    die("Invalid access!");
}

$smartcard_id = htmlspecialchars($_GET['SmartCard_ID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header img {
            width: 120px;
            margin-bottom: 10px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            width: 100%;
            position: relative;
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            padding-right: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
            font-size: 18px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="banasthali-logo.png.jpg" alt="Banasthali Logo">
        </div>
        
        <h2>Reset Your Password</h2>

        <form id="resetForm" action="reset_password_connect.php" method="POST" onsubmit="return validatePassword()">
            <input type="hidden" name="SmartCard_ID" value="<?php echo $smartcard_id; ?>">

            <div class="input-group">
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                <span class="toggle-password" onclick="togglePassword('new_password')">👁</span>
            </div>

            <div class="input-group">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <span class="toggle-password" onclick="togglePassword('confirm_password')">👁</span>
            </div>

            <p id="error-message" class="error"></p>

            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === "password" ? "text" : "password";
        }

        function validatePassword() {
            const password = document.getElementById("new_password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            const errorMessage = document.getElementById("error-message");

            if (password.length < 6) {
                errorMessage.textContent = "Password must be at least 6 characters!";
                return false;
            }

            if (password !== confirmPassword) {
                errorMessage.textContent = "Passwords do not match!";
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
