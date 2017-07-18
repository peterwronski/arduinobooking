<?php
session_start();
session_destroy();
$user_dump = var_dump($_SESSION['userloggedin']);
$_SESSION['msg'] = $user_dump;
header('Location:./');
?>