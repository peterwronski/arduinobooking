<?php
include('scripts/header.php');
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
};
?>

<h1>This is the HOME page</h1>
<?php include('scripts/footer.php'); ?>
