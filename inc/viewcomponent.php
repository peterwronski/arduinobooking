<?php

/**
 * Created by PhpStorm.
 * User: CG
 * Date: 19/07/2017
 * Time: 15:56
 */
include('scripts/header_2.php');
$comp_ref = $params['comp_ref'];



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
         <div style="margin-bottom:50%">
        <hr/>
        ';

        if($row['in_stock']>0){
        echo'<form action="../../cart/add/' .$comp_ref .'" method="POST">
        Quantity: <input type="number" min="1" max="' .$in_stock .'" name="quantity" value="1"/> <br/>
        
        <button type="submit" class="btn btn-info">Add to cart</button>';}
        else{
        echo'<form action="#" method="POST">
        Quantity: <input type="number"  min ="1" max="' .$in_stock .'" name="quantity" value="1" readonly/>
        
        <button type="button" class="btn btn-info disabled">Out of Stock</button>';}



       echo' </form>
        </div>';
        include('scripts/footer.php');
        exit();
    };
} else {
    header('Location: 404.php');

};
}else{
    header('Location: 404.php');
}
include('scripts/footer.php');

?>