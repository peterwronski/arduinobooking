<?php
include ('scripts/dbconnect.php');
if (($_POST['pass']!==$_POST['pass2'])) {// this checks to see if both password fields are identical
echo'<script type="text/javascript">
    alert("Your passwords aren\'t matching. Please make sure your passwords match before submitting the form.");

    window.location.href = "./"
</script>';
};


$studentid = $_POST['studentid'];
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$course = $_POST['course'];

$studentid = $conn->real_escape_string($studentid);
$fname = $conn->real_escape_string($fname);
$sname = $conn->real_escape_string($sname);
$email = $conn->real_escape_string($email);
$pass = $conn->real_escape_string($pass);
$course = $conn->real_escape_string($course);

$hashAndSalt = password_hash($pass, PASSWORD_DEFAULT);

$check_studentid = $conn->query("SELECT studentid FROM users WHERE studentid='$studentid'"); #CHECKING THAT THE STUDENTID ISN'T REGISTERED
$count=$check_studentid->num_rows;

if($count==0) {
    $adduser = "INSERT INTO users VALUE('$studentid', '$fname', '$sname', '$email', '$pass', '$course')";
    if ($conn->query($adduser) === TRUE) {
        echo '<script type="text/javascript">
            alert("You\'ve made an account.");
    window.location.href = "./"
        </script>';
    };
} else {
    echo'<script type="text/javascript">
            alert("This Student ID is already registered.");
    window.location.href = "./"
        </script>';
}
?>