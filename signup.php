<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Banasthali Aarogya Seva</title>
    <link rel="stylesheet" href="n.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
           min-height: 100vh;
            background-color: #242f63;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: white;
          padding-top:20px;
        }
        .c1 {
            background-color: white;
            color: #1e3a8a;
            border-radius: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            text-align: center;
            max-width: 530px;
        }
        label {
            display: block;
            margin-top: 25px;
            font-size: 0.9em;
            text-align: left;
        }
        input, select {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: 1em;
            text-align: center;
            height: 30px;
        }
        button {
            width: 26%;
            background-color: #1e3a8a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 30px;
            font-size: 1em;
            cursor: pointer;
            margin-top: 20px;
            height: 44px;
        }
        button:hover {
            background-color: #172554;
        }
    </style>
</head>
<body>
    <form action="signupconnect.php" method="POST">
        <div class="container c1">
            <div class="header">
                <img src="banasthali-logo.png" alt="Banasthali Logo">
            </div>

            <h3>Welcome To Banasthali Aarogya Seva</h3>

            <label for="role">Select Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="doctor">Doctor</option>
            </select>

            <label for="SmartCard_ID">Enter SmartCard ID:</label>
            <input type="text" id="SmartCard_ID" name="SmartCard_ID" required>

            <label for="email">Enter Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Create Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <h4>Security Questions</h4>

            <label for="security_q1">1. What is your childhood nickname?</label>
            <input type="text" id="security_a1" name="security_a1" required>
            
            <label for="security_q2">2. What was the name of your first pet?</label>
            <input type="text" id="security_a2" name="security_a2" required>
            
            <label for="security_q3">3. What is your dream travel destination?</label>
            <input type="text" id="security_a3" name="security_a3" required>
            
            <label for="security_q4">4. What is the name of the city where you were born?</label>
            <input type="text" id="security_a4" name="security_a4" required>
            
            <label for="security_q5">5. What was the name of your first school?</label>
            <input type="text" id="security_a5" name="security_a5" required>

            <button id="signupButton" type="submit" name="SignUP">Sign Up</button>
        </div>
    </form>
</body>
</html>
