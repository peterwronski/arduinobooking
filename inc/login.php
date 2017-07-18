<?php
session_start();
if(!isset($_SESSION['userloggedin']) && empty($_SESSION['userloggedin'])) {
    include('scripts/dbconnect.php');


    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);


// To protect MySQL injection
    $email = stripslashes($email);
    $pass = stripslashes($pass);
    $email = $conn->real_escape_string($email);
    $pass = $conn->real_escape_string($pass);


    $query = $conn->query("SELECT email, pass, studentid ,fname, activated FROM users WHERE email='$email'");

    $row = $query->fetch_array();
    $activated = $row['activated'];

    $count = $query->num_rows; // if email/password are correct returns must be 1 row


    if (password_verify($pass, $row['pass']) && $count == 1) {
        if ($activated == 1) {
            //session_start();

            $_SESSION['userloggedin'] = $row['fname'];
            $_SESSION['email'] = $row['email'];


            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Hi there ' . $_SESSION['userloggedin'] . '!</strong>
                                </div>';
            header('Location: ./');
            exit();

        } else {
            header('Location: verify');

        }
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Heads up!</strong> Your email or password are wrong.
                                </div>';
        header('Location: ./');



    }
    $conn->close();
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Heads up!</strong> You\'re already logged in!
                                </div>';
    header('Location: ./');
    exit();
}
?>