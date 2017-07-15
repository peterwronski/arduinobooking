<?php
include ('scripts/dbconnect.php');

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['activation_hash']) && !empty($_GET['activation_hash'])){
    $email = $conn->real_escape_string($_GET['email']);
    $activation_hash = $conn->real_escape_string($_GET['activation_hash']);

    $search = $conn->query("SELECT email, activation_hash, activated FROM users WHERE email='".$email."' AND activation_hash='".$activation_hash."' AND activated='0'");
    $match = $search->num_rows;

    if ($match > 0){
        $conn->query("UPDATE users SET activated='1' WHERE email='".$email."' AND activation_hash='".$activation_hash."' AND activated='0'");

        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Awesome!</strong>. Your account has been activated. You can now log in using the credentials you provided during registration.
                                </div>';
        header('Location: ./');
    }


}else{
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>This account either doesn\'t exist, or has already been activated.
                                </div>';
    header('Location: ./');
}