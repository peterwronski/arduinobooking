<?php
session_start();
include('scripts/header.php');
include('scripts/dbconnect.php');

$query = $conn->query("SELECT * FROM components");

$count = mysql_num_rows($query);
?>

<div class="container" id="componentlist">
    <div class="row"><h1>Components</h1></div>
    <div class="row"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#options">Options</button>
        <div id="options" class="collapse">INSERT SORT OPTIONS HERE</div>

    </div>

</div>



include('scripts/footer.php'); ?>
