<?php
session_start();
include('scripts/dbconnect.php');
date_default_timezone_set('Europe/London');
$action = $params['action'];
$user_id = $params['user_id'];


require_once('scripts/PHPMailer/class.phpmailer.php');
include("scripts/PHPMailer/class.smtp.php");

if(isset($_SESSION['userloggedin']) && $_SESSION['admin'] == TRUE) {

    switch ($action) {
        case "view":
            include('scripts/header_2.php');
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset ($_SESSION['msg']);
            };
            if ($user_id == "all") {
                $showAllQuery = "SELECT * FROM users";
                $result = $conn->query($showAllQuery);

                $count = $result->num_rows;

                echo '
 <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>All Users</h1> <br/>
                </div>
                </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="componenttable" width="100%">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>User status</th>
                </tr>
';
                while ($row = $result->fetch_array()) {

                    switch ($row['activated']) {
                        case "1":
                            $activated = 'Standard';
                            break;

                        case "2":
                            $activated = 'Admin';
                            break;

                        default:
                            $activated = 'Not activated';
                            break;
                    };

                    echo '

    <tr style="text-align:center; border-bottom: 1px solid rgba(243, 48, 249, 0.33) !important;" class="clickable-row" data-href="../../user/view/' . $row['studentid'] . '">
        <td>' . $row['studentid'] . '</td>
        <td>' . $row['fname'] . ' ' . $row['sname'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $activated . '</td>
        

        <td><form action="../../user/sendmessage/' . $row['studentid'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-info">Send Message</button>
            </form>
        </td>
        <td><form action="../../user/delete/' . $row['studentid'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-danger">DELETE</button>
            </form>
        </td>
        
    </tr>
    ';
                }
                echo '

                <script>
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>
               
                </table>
            </div>
        </div>    
';
            } else {

                $showAllQuery = 'SELECT * FROM users WHERE studentid = "'.$user_id .'"';
                $result = $conn->query($showAllQuery);

                $count = $result->num_rows;


                echo '
 <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>User - ' .$user_id .'</h1> <br/>
                </div>
                </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="componenttable" width="100%">
';
                while ($rowUser = $result->fetch_array()) {


                    switch ($rowUser['activated']) {
                        case "1":
                            $activated = 'Standard';
                            break;

                        case "2":
                            $activated = 'Admin';
                            break;

                        default:
                            $activated = 'Not activated';
                            break;
                    };
                    echo ' 
<tr>
    <th colspan ="2">Student ID ID</th>
    <td colspan ="2">' . $rowUser['studentid'] . '</td>
</tr>

<tr>
    <th colspan ="2">Student Name</th>
    <td colspan ="2">' . $rowUser['fname'] . ' ' .$row['sname'] .'</td>
</tr>

<tr>
    <th colspan ="2">Email</th>
    <td colspan ="2">' . $rowUser['email'] .'</td>
</tr>

<tr>
    <th colspan ="2">Course</th>
    <td colspan ="2">' . $rowUser['course'] . '</td>
</tr>

<tr>
    <th colspan ="2">User Status</th>
    <td colspan ="2">' . $activated. '</td>
</tr>


<tr><td colspan="4">// OPTIONS //</td></tr>

<tr>
    <td colspan="2"><form action="../../user/sendmessage/' . $row['studentid'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-info">Send Message</button>
            </form>
        </td>
        <td colspan="2"><form action="../../user/delete/' . $row['studentid'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-danger">DELETE</button>
            </form>
        </td>
</tr>

';
                }
                echo ' 
 <script>
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>
                            </table>
                        </div>
                       </div>
                       ';

                $userBookings = 'SELECT booking.booking_id, booking.comp_ref, components.comp_name, booking.quantity, booking.date_from, booking.date_to, booking.approved 
                                  FROM booking, components WHERE booking.studentid = "'.$user_id .'" AND booking.comp_ref = components.comp_ref';
                $result = $conn->query($userBookings);
                    echo'
                <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>User\'s bookings</h1> <br/>
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
                    <th>Approved</th>
                </tr>
                ';
                while ($rowBooking = $result->fetch_array()) {
                    $dateFrom = date("d-m-Y", strtotime($rowBooking['date_from']));
                    $dateTo = date("d-m-Y", strtotime($rowBooking['date_to']));
                    switch ($rowBooking['approved']){
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

                        echo '

    <tr style="text-align:center; border-bottom: 1px solid rgba(243, 48, 249, 0.33) !important;" class="clickable-row" data-href="../../adminbooking/view/' . $row['booking_id'] . '">
        <td>' . $rowBooking['booking_id'] . '</td>
        <td>' . $rowBooking['comp_name'] . '</td>
        <td>' . $rowBooking['quantity'] . '</td>
        <td>' . $dateFrom . '</td>
        <td>' . $dateTo . '</td>
        <td>' . $approved . '</td>
        <td><form action="../../adminbooking/approve/' . $rowBooking['booking_id'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-success">Approve</button>
            </form>
        </td>
        <td><form action="../../adminbooking/deny/' . $rowBooking['booking_id'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-warning">Deny</button>
            </form>
        </td>
        <td><form action="../../adminbooking/delete/' . $rowBooking['booking_id'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-danger">DELETE</button>
            </form>
        </td>
    </tr>
                ';
                    }

                    echo '
                    </table>
                    </div>
                    </div>
                    </div>';
            }
            include('scripts/footer.php');
            break;

    }
} else {
    header("Location: 404.php");
}

?>