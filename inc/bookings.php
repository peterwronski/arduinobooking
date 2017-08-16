<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 08/08/2017
 * Time: 14:32
 */
include('scripts/header.php');
include('scripts/dbconnect.php');

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
};

if(isset($_SESSION['userloggedin']) && !empty($_SESSION['userloggedin'])) {
$query = 'SELECT booking.booking_id, 
components.comp_name,  
booking.quantity, 
booking.date_from, 
booking.date_to,
booking.approved
FROM booking, components 
WHERE booking.studentid = "'.$_SESSION['studentid'] .'" 
AND booking.comp_ref = components.comp_ref;';
$result = $conn -> query($query);
$count = $result->num_rows;
echo '
 <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8">
                <h1>Your Bookings</h1> <br/>
                </div>
                </div>
                
                
        <div class="row">
            <div class="col-lg-10">
                <table class="table">
                
                <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Component Name</th>
                    <th>Quantity</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Approved</th>
                </tr>
                </thead>
                <tbody>
';
if($count > 0) {
    while ($row = $result->fetch_array()) {
        switch ($row['approved']){
            case "1":
                $approved = '<span class="glyphicon glyphicon-remove"></span>';
                break;

            case "2":
                $approved = '<span class="glyphicon glyphicon-ok"></span>';
                break;

            default:
                $approved = '<span class="glyphicon glyphicon-time"></span>';
                break;
        };
        $dateFrom = date("d-m-Y", strtotime($row['date_from']));
        $dateTo = date("d-m-Y", strtotime($row['date_to']));
        echo '
    <tr>
        <td>' . $row['booking_id'] . '</td>
        <td>' . $row['comp_name'] . '</td>
        <td>' . $row['quantity'] . '</td>
        <td>' . $dateFrom . '</td>
        <td>' . $dateTo . '</td>
        <td>' . $approved . '</td>
        <td><form action="../../cancelbooking/' . $row['booking_id'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-warning">Cancel Booking</button>
            </form>
        </td>
    </tr>
    ';
    }
    echo '
<td colspan="8">
                <span class="glyphicon glyphicon-time"></span> - Waiting //
                                <span class="glyphicon glyphicon-remove"></span> - Denied //
                                <span class="glyphicon glyphicon-ok"></span> - Approved
                </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>    
';
} else {
    echo '
<tr>
    <td colspan="6"><i>There is nothing to show at the moment</i></td>
</tr>
                </table>
            </div>
        </div>    
';
}




} else {
    include(INCLUDE_DIR . '404.php');
}
include('scripts/footer.php');
?>