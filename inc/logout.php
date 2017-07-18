<?php
session_start();
session_destroy();

echo "User logged in: " .$_SESSION['userloggedin'] .'//endofstring';
//header('Location:./');
exit();
?>