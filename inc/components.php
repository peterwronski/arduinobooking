<?php
session_start();
include('scripts/header.php');
include('scripts/dbconnect.php');

$query = $conn->query("SELECT * FROM components");

$count = mysql_num_rows($query);
?>

<div class="container" id="componentlist">
    <div class="row align-items-center"><div class=col-lg-8 col-lg-offset-2 id="componentdiv"><h1>Components</h1></div></div>
    <div class="row"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#options">Options</button>
        <div id="options" class="collapse">INSERT SORT OPTIONS HERE</div>

    </div>

</div>


<?php
include('scripts/footer.php'); ?>
