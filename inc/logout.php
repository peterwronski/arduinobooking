<?php
session_start();
session_destroy();
$_SESSION['msg'] = var_dump($_SESSION['userloggedin']);
header('Location:./');
?>