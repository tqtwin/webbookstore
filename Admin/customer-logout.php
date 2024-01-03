<?php
// Xóa tất cả cookie
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/');
    }
}
// Xóa tất cả session
session_start();
session_destroy();
header("location:../Admin/login.php");
?>
