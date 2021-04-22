<?php 
session_start();

unset($_SESSION['logged']);
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['email']);

header('Location: FirstPage.php');
