<!DOCTYPE html>
<html>
<head>
    <title>Enter OTP</title>
</head>
<body>
    <h2>Enter OTP</h2>
    <form method="POST" action="verify_otp.php">
        <input type="hidden" name="Id" value="<?php echo $_GET['Id']; ?>">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
