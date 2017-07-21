<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 19/07/2017
 * Time: 15:56
 */
include('scripts/header_2.php');
$comp_ref = $params['comp_id'];

if (isset($_SESSION['userloggedin']) && !empty($_SESSION['userloggedin'])){
include('scripts/dbconnect.php');
?>
<div class="container">
    <div class="row">

<?php



$query = "SELECT * FROM components where comp_ref = '$comp_ref'";
$result = $conn->query($query);



if ($result->num_rows > 0) {
    // output data of each row
    while ($row = mysqli_fetch_array($result)) {
        $comp_name = $row['comp_name'];
        $in_stock = $row['in_stock'];
        $img_link = ' "../inc/img/arduino_img/'.$row['comp_ref'] .'.jpg" ';

        echo '
        <div class="col-md-4">
        <img src='.$img_link.' class="img-responsive" alt="'.$comp_name.'"/>
        </div>
        
        <div class="col-md-4">
        <h2>'.$comp_name.'</h2><br/>
        Quantity in stock: '.$in_stock .'
        <br/>
        <br/>
         <div class="col-md-4 col-md-offset-4">
        <p><b>Create a booking</b></p><hr/>
        <form action="makebooking" method="POST">
        <input type="number" min="1" max="' .$in_stock .'"
        <button type="button" class="btn btn-info">
        </form>
        </div>
        ';
        exit();
    };
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>Component could not be found!
                                </div>';
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };

};
}else{
    $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Hold up!</strong>You have to be logged in to view this content
                                </div>';

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };


}

include('scripts/footer.php');
?>