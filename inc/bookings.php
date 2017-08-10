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
$query = 'SELECT booking.booking_id, 
components.comp_name,  
booking.quantity, 
booking.date_from, 
booking.date_to 
FROM booking, components 
WHERE booking.studentid = "'.$_SESSION['studentid'] .'" 
AND booking.comp_ref = components.comp_ref;';
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
                    <th>Component Name</th>
                    <th>Quantity</th>
                    <th>From</th>
                    <th>To</th>
                </tr>
';
while ($row = $result->fetch_array()) {
$dateFrom = date_format($row['date_from'], 'd-m-Y');
$dateTo = date_format($row['date_to'], 'd-m-Y');
    echo'
    <tr>
        <td>' .$row['booking_id'] .'</td>
        <td>' .$row['comp_name'] .'</td>
        <td>' .$row['quantity'] .'</td>
        <td>' .$dateFrom.'</td>
        <td>' .$dateTo.'</td>
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