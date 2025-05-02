<?php
$connect = new mysqli("localhost", "root", "root", "chatdb");

$room = $_GET['room'] ?? '';

if ($room === 'public1' || $room === 'public2' || $room === 'private') {
    $stmt = $connect->prepare("DELETE FROM messages WHERE room = ?");
    $stmt->bind_param("s", $room);
    if ($stmt->execute()) {
        echo "Room '$room' cleared.";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid room.";
}
?>
