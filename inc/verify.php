<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include('scripts/header.php'); ?>
    <form action="verify" method="POST">
        <input type="text" name="activation_hash" placeholder="Enter your activation code here" required aria-required/>
        <input type="submit" name="activation_submit"/>
    </form>

    <?php
    include('scripts/footer.php');
}  elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('scripts/dbconnect.php');

//Based on https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824

    $activation_hash = $_POST['activation_hash'];
    $activation_hash = $conn->real_escape_string($activation_hash);

    $search = $conn->query("SELECT studentid, activation_hash, activated FROM users WHERE activation_hash=' ".$activation_hash. "' AND activated=0");
    $match = $search->num_rows;

    echo $activation_hash;
    echo $match;


/*
    if ($match > 0) {
        $activate = $conn->query("UPDATE users SET activated==1 WHERE activation_hash='.$activation_hash ");

        if (!$activate) {
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
    };
*/
};


?>