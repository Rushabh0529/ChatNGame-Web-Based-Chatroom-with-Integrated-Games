<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connect = new mysqli("localhost", "root", "root", "chatdb");
$room = isset($_GET['room']) ? trim($_GET['room']) : "public1";

$statement = $connect->prepare("SELECT * FROM messages WHERE room = ? ORDER BY timestamp DESC");
$statement->bind_param("s", $room);
$statement->execute();
$result = $statement->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<p><strong>" . htmlspecialchars($row['nickname']) . ":</strong> " . 
    htmlspecialchars($row['message']) . " <em>(" . $row['timestamp'] . ")</em></p>";
}
$statement->close();
?>