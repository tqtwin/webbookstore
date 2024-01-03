<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['name']);
unset($_SESSION['password'] );
unset($_SESSION['email'] );
unset($_SESSION['gender'] );
unset($_SESSION['phone']);
unset($_SESSION['address']);
unset($_SESSION['avatar']);
header("location:../index.php");
?>
