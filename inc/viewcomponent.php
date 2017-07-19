<?php
/**
 * Created by PhpStorm.
 * User: CG
 * Date: 19/07/2017
 * Time: 15:56
 */
include('scripts/header.php');
include('scripts/dbconnect.php');
?>
<div class="container">
    <div class="row">

<?php

$comp_ref = $params['comp_ref'];

$query = "SELECT * FROM components where comp_ref = '$comp_ref'";
$result = $db->query($sql);

if ($query->num_rows > 0) {
    // output data of each row
    while ($row = $query->fetch_assoc()) {
        $comp_name = $row['comp_name'];
        $in_stock = $row['in_stock'];
        $img_link = ' "inc/img/arduino_img/'.$row['comp_ref'] .'.jpg" ';

        echo '
        <div class="col-md-4">
        <img src='.$img_link.' class="img-responsive" alt="'.$comp_name.'"/>
        </div>
        
        <div class="col-md-4">
        <h2>'.$comp_name.'</h2><br/>
        Quantity in stock: '.$in_stock .'
        </div>
        ';
    };
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>Component could not be found!
                                </div>';
    session_write_close();
    header('Location: components');
}