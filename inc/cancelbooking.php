<?php
session_start();
include ('scripts/dbconnect.php');
$booking_id = $params['booking_id'];

$delete = 'DELETE * FROM booking WHERE booking_id ="'.$booking_id .'" AND studentid = "'.$_SESSION['studentid'] .'";';
$conn->query($delete);

$_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Yeee boi!</strong> Booking cancelled!
</div>';


header("Location:../../bookings");

?>