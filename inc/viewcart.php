<?php
session_start();
include ('scripts/header.php');


echo'
<div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="componenttable" width="100%">
                    <th colspan="2">Component</th>
                    <th colspan="1">Quantity</th>';
                    foreach ($_SESSION["cart"] as $key => $value) {
        echo '<tr>
                           <td>' . $key . '</td><td>' . $value['comp_name'] . '</td><td>'.$value['quantity'].'</td><a href="cart/remove/'.$key .'">Remove Item</a>';
    }
    echo '</table>';


include ('scripts/footer.php');