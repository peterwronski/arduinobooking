<?php
session_start();
include ('scripts/dbconnect.php');
$booking_id = $params['booking_id'];

$delete = 'DELETE FROM booking WHERE booking_id ="'.$booking_id .'" AND studentid = "'.$_SESSION['studentid'] .'";';
$result = $conn->query($delete);

if ($result) {
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Yeee boi!</strong> Booking cancelled!
</div>';


    header("Location:../../bookings");
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Something went wrong!</strong> Booking was NOT cancelled.
</div>';


    header("Location:../../bookings");
}
?>