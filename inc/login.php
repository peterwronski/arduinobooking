<?php
include('scripts/dbconnect.php');


$email = trim($_POST['email']);
$pass = trim($_POST['pass']);


// To protect MySQL injection
$email = stripslashes($email);
$pass = stripslashes($pass);
$email = $conn->real_escape_string($email);
$pass = $conn->real_escape_string($pass);




$query = $conn->query("SELECT email, pass, studentid name FROM users WHERE email='$email'");

$row=$query->fetch_array();



$count = $query->num_rows; // if email/password are correct returns must be 1 row

/*password_verify($pass, $row['pass']) -- IMPLEMENT AFTER REGISTRATION*/
if ($pass == $row['pass'] && $count==1) {
    $_SESSION['userloggedin'] = $row['name'];
    $_SESSION['studentid'] = $row['studentid'];


    header("Location:./");

}
else {
    echo "<script type='text/javascript'>alert('bad login')</script>";
    header("Location:./");


}
$conn->close();
?>