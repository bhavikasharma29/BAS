<!DOCTYPE html>
<html>
<head>
    <title>Request Medical History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"] {
            width: 90%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #007bff;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Request Student's Medical History</h2>
        <form method="POST" action="generate_otp.php">
            <label for="Id">Enter Student ID:</label>
            <input type="text" id="Id" name="Id" required>
            <br>
            <button type="submit">Request OTP</button>
        </form>
    </div>
</body>
</html>
