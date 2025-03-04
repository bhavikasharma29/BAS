<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Banasthali Aarogya Seva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #242f63;
            color: white;
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
            position: relative;
            overflow: hidden;
        }
        .card {
            /* background: #ADD8E6; Pastel Blue */
            background:#CDE4F0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 15px;
            position: absolute;
            width: 90%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .card.active {
            opacity: 1;
            position: relative;
        }
        label {
            display: block;
            margin-top: 10px;
            font-size: 0.9em;
            text-align: left;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            text-align: center;
        }
        input:focus {
            border-color: #1e3a8a;
            outline: none;
            box-shadow: 0 0 5px rgba(30, 58, 138, 0.5);
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            width: 48%;
            background-color: #1e3a8a;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
        }
        button:hover {
            background-color: #172554;
        }
        .back-btn {
            width: 100%;
            margin-top: 10px;
            background-color: #6c757d;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
    <script>
        let currentCard = 0;
        function showNextCard() {
            let cards = document.querySelectorAll(".card");
            if (currentCard < cards.length - 1) {
                cards[currentCard].classList.remove("active");
                currentCard++;
                cards[currentCard].classList.add("active");
                cards[currentCard].querySelector("input").focus();
            }
        }
        function showPrevCard() {
            let cards = document.querySelectorAll(".card");
            if (currentCard > 0) {
                cards[currentCard].classList.remove("active");
                currentCard--;
                cards[currentCard].classList.add("active");
                cards[currentCard].querySelector("input").focus();
            }
        }
        function validateForm() {
            let smartCardID = document.getElementById("SmartCard_ID").value.trim();
            if (smartCardID === "") {
                alert("Please enter your SmartCard ID.");
                return false;
            }
            let inputs = document.querySelectorAll(".card input");
            for (let input of inputs) {
                if (input.value.trim() === "") {
                    alert("Please answer all security questions.");
                    return false;
                }
            }
            return true;
        }
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".card")[0].classList.add("active");
            document.addEventListener("keydown", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    showNextCard();
                }
            });
        });
    </script>
</head>
<body>
    <form action="forgot_password_connect.php" method="POST" onsubmit="return validateForm()">
        <div class="container c1">
            <div class="header">
                <img src="banasthali-logo.png.jpg" alt="Banasthali Logo">
            </div>
            <h3>Forgot Password</h3>
            <label for="SmartCard_ID">Enter SmartCard ID:</label>
            <input type="text" id="SmartCard_ID" name="SmartCard_ID" required>
            <h4>Answer Security Questions</h4>
            <div class="card">
                <label for="security_a1">1. What is your childhood nickname?</label>
                <input type="text" id="security_a1" name="security_a1" required>
                <div class="button-container">
                    <button type="button" onclick="showNextCard()">Next</button>
                </div>
            </div>
            <div class="card">
                <label for="security_a2">2. What was the name of your first pet?</label>
                <input type="text" id="security_a2" name="security_a2" required>
                <div class="button-container">
                    <button type="button" onclick="showPrevCard()">Previous</button>
                    <button type="button" onclick="showNextCard()">Next</button>
                </div>
            </div>
            <div class="card">
                <label for="security_a3">3. What is your dream travel destination?</label>
                <input type="text" id="security_a3" name="security_a3" required>
                <div class="button-container">
                    <button type="button" onclick="showPrevCard()">Previous</button>
                    <button type="button" onclick="showNextCard()">Next</button>
                </div>
            </div>
            <div class="card">
                <label for="security_a4">4. What is the name of the city where you were born?</label>
                <input type="text" id="security_a4" name="security_a4" required>
                <div class="button-container">
                    <button type="button" onclick="showPrevCard()">Previous</button>
                    <button type="button" onclick="showNextCard()">Next</button>
                </div>
            </div>
            <div class="card">
                <label for="security_a5">5. What was the name of your first school?</label>
                <input type="text" id="security_a5" name="security_a5" required>
                <div class="button-container">
                    <button type="button" onclick="showPrevCard()">Previous</button>
                    <button type="submit" name="Verify">Verify</button>
                </div>
                <button type="button" class="back-btn" onclick="window.location.href='login.php'">Back to Login</button>
            </div>
        </div>
    </form>
</body>
</html>
