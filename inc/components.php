<?php
session_start();
include('scripts/header.php');
include('scripts/dbconnect.php');

$query = $conn->query("SELECT * FROM components");

$count = mysql_num_rows($query);



include('scripts/footer.php'); ?>
