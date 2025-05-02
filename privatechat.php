
<?php
$allowed = false;
if (isset($_GET['pass']) && $_GET['pass'] === "1234") {
    $allowed = true;
}
if (!$allowed) {
    echo "<script>alert('Access Denied: Come on easy password.'); window.location.href='Homepage.html';</script>";
    exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$connect = new Mysqli("localhost", "root", "root", "chatdb");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
$room = 'private';
$statement = $connect->prepare("SELECT * FROM messages WHERE room = ? ORDER BY timestamp DESC LIMIT 25");
$statement->bind_param("s", $room);
$statement->execute();
$search = $statement->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Privatechat</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="chatroomstyle.css"> <!-- Link to external CSS -->
</head>
<body>
    <div class="chat-container">
        <h2>Privatechat</h2>
        <div id="chat-box">
            <?php while ($row = $search->fetch_assoc()): ?>
                <p><strong><?= htmlspecialchars($row['nickname']) ?></strong>: <?= htmlspecialchars($row['message']) ?></p>
            <?php endwhile; ?>
        </div>
        
        <div class="chat-input">
            <input type="text" id="message" placeholder="Type your message here...">
            <button id="sendBtn">Send</button>
        </div>
    </div>

    <div class="game-nav">
        <button onclick="window.location.href='TriviaGame.html'">🎯 Trivia</button>
        <button onclick="window.location.href='Rock.html'">🤖 RockPaper AI</button>
        <button onclick="window.location.href='Survivors.html'">🧟 Soul Survivors</button>
        <button onclick="window.location.href='Scuba.html'">🎮 Skibidi Scuba</button>
        <button onclick="window.location.href='Slugs.html'">🎲 Slugslugs</button>
        <button onclick="window.location.href='DungeonMaster.html'">🧛 Dungeon Master</button>
    </div>

    <script>
        const room = "private";
        
        function sendChat(nickname) {
            const message = document.getElementById("message").value;
            if (message.trim() === "") return;

            fetch("send_chat.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `nickname=${encodeURIComponent(nickname)}&message=${encodeURIComponent(message)}&room=${room}`
            })
            .then(response => response.text())
            .then(() => {
                document.getElementById("message").value = "";
                refreshChat();
            });
        }

        function refreshChat() {
            fetch(`load_chat.php?room=${room}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById("chat-box").innerHTML = data;
            });
        }
        
        function openGame(gameNum) {
            alert(`Game ${gameNum} is coming soon! 🚧`);
        }
        
        document.addEventListener("DOMContentLoaded",() => {
            const nickname = sessionStorage.getItem("nickname");
            if (!nickname) {
                alert("You did not enter a nickname, please enter one first.");
                window.location.href = "Homepage.html";
                return;
            }
            document.getElementById("sendBtn").addEventListener("click", () => sendChat(nickname));
            setInterval(refreshChat, 2000);
            refreshChat();
        });
    </script>
</body>
</html>