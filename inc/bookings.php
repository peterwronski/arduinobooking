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
$query = 'SELECT * FROM booking WHERE studentid = "' .$_SESSION['studentid'] .'"';
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
                <tr>
                    <th>Booking ID</th>
                    <th>Component ID</th>
                    <th>Quantity</th>
                    <th>From</th>
                    <th>To</th>
                </tr>
';
while ($row = $result->fetch_array()) {
    $dateFrom = ($row['date_from'])->format('d-m-Y');
    $dateTo = ($row['date_to'])->format('d-m-Y');
    echo'
    <tr>
        <td>' .$row['booking_id'] .'</td>
        <td>' .$row['comp_ref'] .'</td>
        <td>' .$row['quantity'] .'</td>
        <td>' .$dateFrom .'</td>
        <td>' .$dateTo .'</td>
    </tr>
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