<?php
include('scripts/header.php'); ?>


<div class="alert alert-warning">
    <strong>Someone, somewhere has messed up</strong> <br/> This page doesn't exist. Click <a href="../../">HERE</a> to go back to the website.
</div>



<?php
echo 'Action called: ' .$_SESSION ['lastcalledaction'];
session_unset($_SESSION['lastcalledaction']);
include('scripts/footer.php'); ?>