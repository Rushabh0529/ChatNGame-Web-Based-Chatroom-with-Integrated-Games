<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] === $ADMIN_PASSWORD) {
        $_SESSION['logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        echo "<script>
                alert('Wrong password');
                window.location.href = 'login.php';
              </script>";
        exit;
    }
}
?>

