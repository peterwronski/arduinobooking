<?php
session_start();
include('scripts/header.php');

?>

<h1>This is the HOME page</h1>

<?php echo "User logged in: " .$_SESSION['userloggedin']; ?>


<?php include('scripts/footer.php'); ?>
