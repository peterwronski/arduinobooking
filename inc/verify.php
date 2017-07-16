<?php



//Based on https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824

if(!empty($_GET['email']) && !empty($_GET['activation_hash'])){
    include ('scripts/dbconnect.php');
    $email = $_GET['email'];
    $activation_hash = $_GET['activation_hash'];

    $email = $conn->real_escape_string($email);
    $activation_hash = $conn->real_escape_string($activation_hash);

    $search = $conn->query("SELECT email, activation_hash, activated FROM users WHERE email='.$email.' AND activation_hash='.$activation_hash.' AND activated='0'");
    $match = $search->num_rows;


    if ($match > 0){
        $activate=$conn->query("UPDATE users SET activated='1' WHERE email=' .$email.' AND activation_hash='.$activation_hash");

        if(!$activate){
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>. Your account couldn\'t be activated.
                                </div>';
            header('Location: ./');
        } else {

            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Awesome!</strong>. Your account has been activated. You can now log in using the credentials you provided during registration.
                                </div>';
            header('Location: ./');
        };
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable" >
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>. This account couldn\'t be found
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

?>