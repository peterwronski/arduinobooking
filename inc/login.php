<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <div class="alert alert-info">
                <strong>Heads up!</strong>This system is currently not connected to the RGU network, therefore your existing RGU credentials won't work unless you create a new account on this system.
            </div>

            <form action="login" method="POST">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>

            <div class="login-help">
                <a href="#">Register</a> - <a href="#">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

<? }
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {


include('dbconnect.php');


$email = trim($_POST['email']);
$pass = trim($_POST['pass']);


// To protect MySQL injection
$email = stripslashes($email);
$pass = stripslashes($pass);
$email = $conn->real_escape_string($email);
$pass = $conn->real_escape_string($pass);

var_dump($email, $row);

/*
$query = $conn->query("SELECT email, pass, studentid name FROM users WHERE email='$email'");

$row=$query->fetch_array();

var_dump ($row);

$count = $query->num_rows; // if email/password are correct returns must be 1 row

/*password_verify($pass, $row['pass']) -- IMPLEMENT AFTER REGISTRATION
if ($pass == $row['pass'] && $count==1) {
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
}*/
$conn->close();}
?>