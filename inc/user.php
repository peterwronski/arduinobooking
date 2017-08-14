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

                $showAllQuery = 'SELECT * FROM users WHERE studentid = "' .$user_id .'"';
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
<tr>
    <th colspan ="2">Student ID ID</th>
    <td colspan ="2">' . $row['studentid'] . '</td>
</tr>

<tr>
    <th colspan ="2">Student Name</th>
    <td colspan ="2">' . $row['fname'] . ' ' .$row['sname'] .'</td>
</tr>

<tr>
    <th colspan ="2">Email</th>
    <td colspan ="2">' . $row['email'] .'</td>
</tr>

<tr>
    <th colspan ="2">Course</th>
    <td colspan ="2">' . $row['course'] . '</td>
</tr>

<tr>
    <th colspan ="2">User Status</th>
    <td colspan ="2">' . $activated. '</td>
</tr>


<tr><td colspan="4">// OPTIONS //</td></tr>

<tr>
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
                       </div>';
            }
            include('scripts/footer.php');
            break;

    }
} else {
    header("Location: 404.php");
}

?>