<?php
session_start();
include('scripts/header.php');

$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
                if($pageWasRefreshed){
                    unset($_SESSION['msg']);
                };
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
}

?>

<h1>This is the HOME page</h1>




<?php include('scripts/footer.php'); ?>
