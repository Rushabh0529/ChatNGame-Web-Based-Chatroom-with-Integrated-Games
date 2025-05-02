<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ChatNGame</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?gaming') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .glassmorphism {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            color: white;
        }

        .title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ecf0f1;
            
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            color: black;

        }

        .login-button {
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            background-color: #4fd1c5;
            color: white;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .login-button:hover {
            background-color: #e44d00;
            transform: scale(1.05);
        }

        .back-button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="glassmorphism">
        <h2 class="title">Admin Login</h2>
        <form method="POST" action="check_login.php">
            <input type="password" name="password" class="input-field" placeholder="Enter password" required>
            <button type="submit" class="login-button">Login</button>
        </form>
        <button class="back-button" onclick="window.location.href='homepage.html'">Back to Home</button>
    </div>

</body>
</html>
