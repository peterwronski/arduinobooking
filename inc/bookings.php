<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 08/08/2017
 * Time: 14:32
 */
include('scripts/header.php');
include('scripts/dbconnect.php');

if(isset($_SESSION['userloggedin']) && !empty($_SESSION['userloggedin'])) {
$query = 'SELECT * FROM bookings WHERE studentid = "' .$_SESSION['studentid'] .'"';
$result = $conn -> query($query);
echo '
 <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>Components</h1> <br/>
                </div>
                </div>
                
                
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="componenttable" width="100%">
                    <th>Booking ID</th>
                    <th>Component ID</th>
                    <th>Quantity</th>
                    <th>From</th>
                    <th>To</th>
';
while ($row = $result->fetch_array()) {
    echo'
        <td>' .$row['booking_id'] .'</td>
        <td>' .$row['comp_ref'] .'</td>
        <td>' .$row['quantity'] .'</td>
        <td>' .$row['date_from'] .'</td>
        <td>' .$row['date_to'] .'</td>
    ';
}

echo '
                </table>
            </div>
        </div>    
';

} else {
    header('Location: 404.php');
}
include('scripts/footer.php');
?>