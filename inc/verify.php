<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include('scripts/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="loginmodal-container">
                <div class="alert alert-info" >

    <form action="verify" method="POST">
        <strong>Check your email!</strong> <br/> We have sent an email containing an activation code, which will enable you to use the account. <br/>
        Paste the code in the box below and click 'Submit' <br/>
        <input type="text" name="activation_hash" placeholder="Enter your activation code here" required aria-required/> <br/>
        <input type="submit" name="activation_submit"/>
    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('scripts/footer.php');
}  elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('scripts/dbconnect.php');

//Based on https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824

    $activation_hash = $_POST['activation_hash'];
    $activation_hash = $conn->real_escape_string($activation_hash);

    $activation_query = "SELECT studentid, fname, activation_hash, activated FROM users WHERE activation_hash='".$activation_hash ."' AND activated=0";
    $search = $conn->query($activation_query);
    $match = $search->num_rows;




    if ($match > 0) {
        $activate = $conn->query("UPDATE users SET activated=1 WHERE activation_hash='" . $activation_hash . "'");

        if($activate){

            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Awesome!</strong> Your account has been activated! 
                                </div>';
            header('Location: ./');
            exit;

        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong> Your account couldn\'t be activated.
                                </div>';
            header('Location: ./');
            exit;

        }

    }
    else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong> This account couldn\'t be found.
                                </div>';
        header('Location: ./');
        exit;

    };
};


?>