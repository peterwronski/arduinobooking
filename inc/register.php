<?php
session_start();
include ('scripts/dbconnect.php');


if (($_POST['pass']!==$_POST['pass2'])) {// this checks to see if both password fields are identical
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Heads up!</strong>. Your passwords aren\'t matching. Please make sure your passwords match before submitting the form.
                                </div>';
    header('Location: ./');
    exit();

} else {

    $studentid = $_POST['studentid'];
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $course = $_POST['course'];


    list($user, $domain) = explode('@', $email);

    if($domain == 'rgu.ac.uk'){

    $studentid = $conn->real_escape_string($studentid);
    $fname = $conn->real_escape_string($fname);
    $sname = $conn->real_escape_string($sname);
    $email = $conn->real_escape_string($email);
    $pass = $conn->real_escape_string($pass);
    $course = $conn->real_escape_string($course);
    $activation_hash=md5( rand(0,1000) );
    $activated = 0;


    $hashAndSalt = password_hash($pass, PASSWORD_DEFAULT); //Encrypting the password

    $check_studentid = $conn->query("SELECT studentid FROM users WHERE studentid='$studentid'"); #CHECKING THAT THE STUDENTID ISN'T REGISTERED
    $count = $check_studentid->num_rows;

    if ($count == 0) {
        $adduser = "INSERT INTO users VALUE('$studentid', '$fname', '$sname', '$email', '$hashAndSalt', '$course', '$activation_hash', '$activated')" or die('Insert query failed');
        if ($conn->query($adduser) === TRUE) {
            require_once('scripts/PHPMailer/class.phpmailer.php');
            include("scripts/PHPMailer/class.smtp.php");

            $mail= new PHPMailer();

            $body= ' Hi ' .$fname .'!
            Thanks for signing up to ArduinoBooking for RGU!
            
            When you first log in to your account, you\'ll be asked to verify your account by posting the activation code below: <br/> '
            .$activation_hash;


            $mail->IsSMTP();

            $mail->SMTPDebug  = 1;

            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
            $mail->Username   = "noreply.arduinobooking@gmail.com";  // GMAIL username
            $mail->Password   = "arduinopass";

            $mail->SetFrom('noreply.arduinobooking@gmail.com', 'ArduinoBooking');

            $mail->Subject    = "Account Activation | Arduino Booking";

            $mail->MsgHTML($body);


            $mail->AddAddress("$email", "$fname");

            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Awesome!</strong>. Your account has been created. Check your email for an activation link which will enable you to login to your account.
                                </div>';
                header('Location: ./');

            }




            ////////////////////////////////


        };
    } else {

        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Heads up!</strong>. This student ID is already registered.
                                </div>';
        header('Location: ./');

    }
} else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Heads up!</strong>. You MUST use an RGU email address to make an account.
                                </div>';
        header('Location: ./');
    }
}
?>