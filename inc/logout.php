<?php
session_start();
session_destroy();

$_SESSION['msg'] = 'User logged in is: ' .$_SESSION['userloggedin'] .' //End of string';
header('Location:./');
exit();
?>