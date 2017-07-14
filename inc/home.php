<?php
session_start();
include('scripts/header.php');

if(isset($msg)){
    echo $msg;
}

?>

<h1>This is the HOME page</h1>




<?php include('scripts/footer.php'); ?>
