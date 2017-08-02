<?php
session_start();
include('scripts/dbconnect.php');

$action = $params['action'];
$dateTo = $_POST['date_to'];
$dateFrom = $_POST['date_from'];
$addSuccess = "Items added successfully: <br/>";
if(isset($action)) {
    switch ($action) {
        case "add":
            foreach ($_SESSION["cart"] as $key => $value) {
                $query = 'INSERT INTO booking VALUES ("' . $_SESSION['studentid'] . '", "' . $key . '" , "' . $value['quantity'] . '", "' . $key . '", "' . $dateFrom . '", "' . $dateTo . '")';
                $result=$conn->query($query);
                if($result){
                    $addSuccess .= $value['comp_name'] .', ' .$value['quantity'].'<br/>';
                } else{
                    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong> One or more items in your cart aren\'t available at the moment! (Sent from Add)
                                </div>';
                    header("Location:../../viewcart");
                }

            };
            $_SESSION['msg'] = $addSuccess .'Your booking is now created. Check the progress under \'Your Bookings\' ';
            break;
        case "confirm":
            foreach ($_SESSION["cart"] as $key => $value) {

            $query = 'SELECT quantity FROM components WHERE comp_ref ="' . $key . '"';
            $result = $conn->query($query);
            if($result){

            }

            $row = mysqli_fetch_array($result);
            if ($row['quantity'] > $value['quantity']){
                header("Location: ../../booking/add");
            } else {
                $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong> One or more items in your cart aren\'t available at the moment! (Sent from Confirm)
                                </div>';
                header("Location:../../viewcart");
            }
}
            break;


    }

}