<?php
include ('scripts/dbconnect.php');


if (($_POST['pass']!==$_POST['pass2'])) {// this checks to see if both password fields are identical
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Heads up!</strong>. Your passwords aren\'t matching. Please make sure your passwords match before submitting the form.
                                </div>';
    header('Location: ./');

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

            //source - https://stackoverflow.com/questions/712392/send-email-using-the-gmail-smtp-server-from-a-php-page
            require_once 'scripts/swift/lib/swift_required.php';

            $transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
                ->setUsername('noreply.arduinobooking@gmail.com')
                ->setPassword('arduinopass');

            $mailer = Swift_Mailer::newInstance($transport);

            $message = Swift_Message::newInstance('ArduinoBooking - Activate your account')
                ->setFrom(array('noreply.arduinobooking@gmail.com' => 'NoReply - ArduinoBooking'))
                ->setTo(array('$email' => '$fname'))
                ->setBody(' Hi ' .$fname .'!
            Thanks for signing up to ArduinoBooking for RGU!
            
            Please click this link to activate your account: 
            http://arduinobooking.azurebwebsites.com/verify.php?email='.$email.'&hash='.$activation_hash.'');

            if ($mailer->send($message)) {
                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable" >
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Awesome!</strong>. Your account has been created. Check your email for an activation link which will enable you to login to your account.
                                </div>';
                header('Location: ./');
            } else {
                echo 'I am sure your configuration are not correct. :(';
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