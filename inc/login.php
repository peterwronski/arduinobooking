<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>


            <form action="login" method="POST">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" name="login" value="Login">
            </form>

<? }
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {


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

var_dump ($row);

$count = $query->num_rows; // if email/password are correct returns must be 1 row

/*password_verify($pass, $row['pass']) -- IMPLEMENT AFTER REGISTRATION*/
if ($pass == $row['pass'] && $count==1) {
    $_SESSION['userloggedin'] = $row['name'];
    $_SESSION['studentid'] = $row['studentid'];

    echo "<script type='text/javascript'>alert('good login')</script>";
    header("Location:./");

}
else {
    echo "<script type='text/javascript'>alert('bad login')</script>";
    header("Location:login");


}
$conn->close(); }
?>