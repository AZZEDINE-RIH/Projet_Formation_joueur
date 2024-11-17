<?php
session_start();
session_destroy();
if (isset($_COOKIE['autoriser'])) {
    setcookie('autoriser', '', time() - 3600, '/');
}
header("Location: login.php");
exit();
?>
