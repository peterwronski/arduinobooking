<?php
session_start();
include('scripts/header.php');
if(!isset($_SESSION['userloggedin'])){
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" >
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Hold up!</strong> You have to be logged in to access the content of this page. 
                                    Click <a href="#" data-toggle="modal" data-target="#login-modal">HERE</a> to log in, or 
                                    <a href="#" data-toggle="modal" data-target="#reg-modal">HERE</a> to register.
                                </div>';
    header('Location: ./');
} else {

    ?>

    <h1>This is the COMPONENTS page</h1>


    <?php
};
include('scripts/footer.php'); ?>
