<?php
session_start();
include ('scripts/dbconnect.php');
$booking_id = $params['booking_id'];

$delete = 'DELETE FROM booking WHERE booking_id ="'.$booking_id .'" AND studentid = "'.$_SESSION['studentid'] .'";';
$result = $conn->query($delete);

$get_inStock = $conn->query('SELECT booking.comp_ref, components.in_stock, booking.quantity FROM components, booking WHERE booking.booking_id ="'.$booking_id .'" AND components.comp_ref = booking.comp_ref');
$row = $get_inStock->fetch_array();

$quantity = $row['in_stock'] + $row['quantity'] ;

$in_stockUpdate = $conn->query('UPDATE components SET in_stock = "' . $quantity . '" WHERE comp_ref="' . $row['comp_ref'] . '"');

if ($result && $in_stockUpdate) {
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