<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$connect = new mysqli("localhost", "root", "root", "chatdb");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : "Guest";
    $message = isset($_POST['message']) ? trim($_POST['message']) : "";
    $room = isset($_POST['room']) ? trim($_POST['room']) : "public1";

    if (!empty($message)) {
        $statement = $connect->prepare("INSERT INTO messages (nickname, message, room) VALUES (?, ?, ?)");
        $statement->bind_param("sss", $nickname, $message, $room);
        $statement->execute();
        $statement->close();
    }
}
?>