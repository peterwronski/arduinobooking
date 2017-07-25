<?php
session_start();
include ('scripts/header.php');

if(isset($_COOKIE['cart_cookie'])){
    $_SESSION['cart'] = $_COOKIE['cart_cookie'];
};
echo'

<div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>Your Cart</h1> <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <table class="table-condensed componenttable" width="100%">
                    <th></th>
                    <th colspan="1">Component</th>
                    <th colspan="1">Quantity</th>
                    <th colspan="1">';

                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                            echo'
                                <form action="../../cart/remove/all" method="POST">
                                <button type="submit" class="btn-xs btn-danger" value="Clear Cart">
                                </form></th>';
                        } elseif(empty($_SESSION['cart'])) {
                            echo'    <form action="#" method="POST">
                                    <button type="submit" class="btn-xs btn-danger disabled" value="Clear Cart">
                           </form></th>';
                        };

                    foreach ($_SESSION["cart"] as $key => $value) {
                        $img_link = ' "inc/img/arduino_img/' . $key . '.jpg" ';
        echo '<tr class="clickable-row" data-href="viewcomponent/' . $key . '">
                            <td><img src=' . $img_link . ' class="img-thumbnail" height="50px" width="50px" alt ="' . $value['comp_name'] . '"/> </td>
                           <td>' . $value['comp_name'] . '</td>
                           <td>'.$value['quantity'].'</td>
                           <td><form action="../../cart/remove/' .$key .'" method="POST">
                           <input type="submit" class="btn-xs btn-warning" value="Remove item">
                           </form></td>
              </tr>';
    }
    echo '      </table>
            </div>
        </div>
</div>

<script>
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>';


include ('scripts/footer.php');