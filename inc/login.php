<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 14/04/2017
 * Time: 03:57
 */

session_unset();
session_start();


include('dbconnect.php');


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


if (/*password_verify($pass, $row['pass']) -- IMPLEMENT AFTER REGISTRATION*/$pass == $row['pass'] && $count==1) {
    $_SESSION['userloggedin'] = $row['name'];
    $_SESSION['studentid'] = $row['studentid'];


    header("Location:home");
    ?>
    <script type="text/javascript">
        alert("You're logged in");

        window.location = "home"
        </script>
    <?php
}
else {
    header("Location:home");
    ?>
<script type="text/javascript">
    alert("Wrong email or password. Please try again.");

    window.location = "home"
</script>

    <?php
}
$conn->close();
?>