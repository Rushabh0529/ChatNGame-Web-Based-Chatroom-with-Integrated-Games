<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ChatNGame</title>
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
        }

        .admin-panel {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(0, 0, 0, 0.7);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: #ecf0f1;
            margin-bottom: 20px;
        }

        .clear-chat-button {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            font-size: 1.2rem;
            background-color: #4fd1c5;
            color: white;
            border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .clear-chat-button:hover {
            background-color: #e44d00;
            transform: scale(1.05);
        }

        .redirect-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .redirect-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Redirect Button -->
    <button class="redirect-button" onclick="window.location.href='HomePage.html'">
        Home Page
    </button>

    <div class="admin-panel glassmorphism">
        <h1 class="title">Admin Panel</h1>

        <button id="clear-chat-1" class="clear-chat-button">Clear Public Chatroom 1</button>
        <button id="clear-chat-2" class="clear-chat-button">Clear Public Chatroom 2</button>
        <button id="clear-chat-3" class="clear-chat-button">Clear Private Chatroom</button>

        <br><br>
        <a href="logout.php" style="color: #4fd1c5; font-size: 1rem;">Logout</a>
    </div>

<script>
    function clearChat(room) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "clearchat.php?room=" + encodeURIComponent(room), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Chat Cleared: " + xhr.responseText);
            }
        };
        xhr.send();
    }

    document.getElementById("clear-chat-1").addEventListener("click", function() {
        clearChat('public1');
    });
    document.getElementById("clear-chat-2").addEventListener("click", function() {
        clearChat('public2');
    });
    document.getElementById("clear-chat-3").addEventListener("click", function() {
        clearChat('private');
    });
</script>
</body>
</html>
