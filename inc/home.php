<?php
session_start();
include('scripts/header.php');

function unset_function()
{
    unset($_SESSION['msg']);
}


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
}

?>

<h1>This is the HOME page</h1>




<?php include('scripts/footer.php'); ?>
