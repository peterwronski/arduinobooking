<?php
session_start();
include('scripts/dbconnect.php');

$action = $params['action'];
$booking_id = $params['booking_id'];


    require_once('scripts/PHPMailer/class.phpmailer.php');
    include("scripts/PHPMailer/class.smtp.php");

if(isset($_SESSION['userloggedin']) && $_SESSION['admin'] == TRUE){

    switch ($action){
        case "view":
            include('scripts/header_2.php');
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset ($_SESSION['msg']);
            };
            if($booking_id == "all"){
                $showAllQuery = "SELECT booking.booking_id, components.comp_name, booking.studentid, users.fname, users.sname,
                booking.quantity, booking.date_from, booking.date_to, booking.approved FROM booking, components, users
                WHERE booking.comp_ref = components.comp_ref AND booking.studentid = users.studentid";
                $result = $conn->query($showAllQuery);

                $count = $result->num_rows;
                $dateFrom = date("d-m-Y", strtotime($row['date_from']));
                $dateTo = date("d-m-Y", strtotime($row['date_to']));
                echo '
 <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>All Bookings</h1> <br/>
                </div>
                </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="componenttable" width="100%">
                <tr>
                    <th>Booking ID</th>
                    <th>Component Name</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Quantity</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Approved</th>
                </tr>
';
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

                        echo '

    <tr style="text-align:center; border-bottom: 1px solid rgba(243, 48, 249, 0.33) !important;" class="clickable-row" data-href="../../adminbooking/view/' . $row['booking_id'] . '">
        <td>' . $row['booking_id'] . '</td>
        <td>' . $row['comp_name'] . '</td>
        <td>' . $row['studentid'] . '</td>
        <td>' . $row['fname'] .' ' .$row['sname'] .'</td>
        <td>' . $row['quantity'] . '</td>
        <td>' . $dateFrom . '</td>
        <td>' . $dateTo . '</td>
        <td>' . $approved . '</td>
        <td><form action="../../adminbooking/approve/' . $row['booking_id'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-success">Approve</button>
            </form>
        </td>
        <td><form action="../../adminbooking/deny/' . $row['booking_id'] . '" method="POST">
        
                <button type="submit" class="btn btn-xs btn-warning">Deny</button>
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

                $showAllQuery = 'SELECT booking.booking_id, components.comp_ref, components.comp_name, booking.studentid, users.fname, users.sname,
                booking.quantity, booking.date_from, booking.date_to, booking.approved FROM booking, components, users
                WHERE booking.comp_ref = components.comp_ref AND booking.studentid = users.studentid AND booking.booking_id = "' .$booking_id .'"';
                $result = $conn->query($showAllQuery);

                $count = $result->num_rows;


                echo'
 <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>Booking</h1> <br/>
                </div>
                </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="componenttable" width="100%">
';
                while ($row = $result->fetch_array()) {
                    $dateFrom = date("d-m-Y", strtotime($row['date_from']));
                    $dateTo = date("d-m-Y", strtotime($row['date_to']));

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
echo' 
<tr>
    <th colspan ="2">Booking ID</th>
    <td colspan ="2">'.$row['booking_id'] .'</td>
</tr>

<tr class="clickable-row" data-href="../../user/view/' . $row['studentid'] . '">
    <th colspan ="2">Student ID</th>
    <td colspan ="2">'.$row['studentid'] .'</td>
</tr>

<tr class="clickable-row" data-href="../../user/view/' . $row['studentid'] . '">
    <th colspan ="2">Name</th>
    <td colspan ="2">'.$row['fname'] .' ' .$row['sname'] .'</td>
</tr>

<tr class="clickable-row" data-href="../../viewcomponent/' . $row['comp_ref'] . '">
    <th colspan ="2">Component ID</th>
    <td colspan ="2">'.$row['comp_ref'] .'</td>
</tr>

<tr class="clickable-row" data-href="../../viewcomponent/' . $row['comp_ref'] . '">
    <th colspan ="2">Component Name</th>
    <td colspan ="2">'.$row['comp_name'] .'</td>
</tr>

<tr>
    <th colspan ="2">Quantity</th>
    <td colspan ="2">'.$row['quantity'] .'</td>
</tr>

<tr>
    <th colspan ="2">Date From</th>
    <td colspan ="2">'.$dateFrom .'</td>
</tr>

<tr>
    <th colspan ="2">Date To</th>
    <td colspan ="2">'.$dateTo .'</td>
</tr>

<tr>
    <th colspan ="2">Approved</th>
    <td colspan ="2">'.$approved .'</td>
</tr>

<tr><td colspan="4">// OPTIONS //</td></tr>

<tr>
    <td><form action="../../adminbooking/approve/' . $row['booking_id'] . '" method="POST">
                <button type="submit" class="btn btn-xs btn-success">Approve</button>
            </form></td>
        <td><form action="../../adminbooking/deny/' . $row['booking_id'] . '" method="POST">
                <button type="submit" class="btn btn-xs btn-warning">Deny</button>
            </form></td>

            <td><form action="../../adminbooking/sendreminder/' . $row['booking_id'] . '" method="POST">
                <button type="submit" class="btn btn-xs btn-info">Send Reminder</button>
            </form></td>
            <td><form action="../../user/sendmessage/' . $row['studentid'] . '" method="POST">
                <button type="submit" class="btn btn-xs btn-info">Send Message</button>
            </form></td>
</tr>

';
                }
                echo' 
 
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
                       </div>';
            }
            include('scripts/footer.php');
            break;

        case "approve":
            $approveQuery = 'UPDATE booking SET approved = "2" WHERE booking_id = "' .$booking_id .'"';
            $conn -> query($approveQuery);


            $body = 'Hi there, ' .$row['fname'] .'<br/> Your booking was approved by an admin! Your components will be ready to be picked up on ' .$dateFrom .'!. <br/> <br/> Thanks for using Arduino Booking!    ';

            $mail= new PHPMailer();



            $mail->IsSMTP();

            $mail->SMTPDebug  = 1;

            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
            $mail->Username   = "noreply.arduinobooking@gmail.com";  // GMAIL username
            $mail->Password   = "arduinopass";

            $mail->SetFrom('noreply.arduinobooking@gmail.com', 'ArduinoBooking');

            $mail->Subject    = "Booking Information | Arduino Booking";

            $mail->MsgHTML($body);

            $fname = $row['fname'];
            $mail->AddAddress("$email", "$fname");

            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {

                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Booking approved!</strong> User will be notified via email
                                </div>';
            }


            header("Location:../../adminbooking/view/all");
            break;

        case "deny":
            $denyQuery = 'UPDATE booking SET approved = "1" WHERE booking_id = "' .$booking_id .'"';
            $conn -> query($denyQuery);
            $body = 'Hi there, ' .$row['fname'] .'<br/> Unfortunately your booking was denied by an admin! You might get an e-mail justifying this decision shortly, but meanwhile why not try booking some other components? <br/> Thanks for using Arduino Booking!    ';

            $mail= new PHPMailer();



            $mail->IsSMTP();

            $mail->SMTPDebug  = 1;

            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
            $mail->Username   = "noreply.arduinobooking@gmail.com";  // GMAIL username
            $mail->Password   = "arduinopass";

            $mail->SetFrom('noreply.arduinobooking@gmail.com', 'ArduinoBooking');

            $mail->Subject    = "Booking Information | Arduino Booking";

            $mail->MsgHTML($body);

            $fname = $row['fname'];
            $mail->AddAddress("$email", "$fname");

            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {

                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Booking denied!</strong> User will be notified via email
                                </div>';
            }


            header("Location:../../adminbooking/view/all");
            break;
    }

} else {
    header("Location: 404.php");
}