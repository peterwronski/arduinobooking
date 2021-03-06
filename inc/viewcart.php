<?php
session_start();
include ('scripts/header.php');
date_default_timezone_set('Europe/London');
$date_now = (new DateTime())->format('Y-m-d');

if(isset($_SESSION['userloggedin']) && !empty($_SESSION['userloggedin'])) {

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset ($_SESSION['msg']);
    };
    echo '

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

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo '
                                <form action="../../cart/remove/all" method="POST">
                                <button type="submit" class="btn btn-xs btn-danger">Clear cart </button>
                                </form></th>';
    } elseif (empty($_SESSION['cart'])) {
        echo '    <form action="#" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger disabled">Clear Cart</button>
                           </form></th>';
    };

    foreach ($_SESSION["cart"] as $key => $value) {
        $img_link = ' "inc/img/arduino_img/' . $key . '.jpg" ';
        echo '<tr class="clickable-row" data-href="viewcomponent/' . $key . '">
                            <td><img src=' . $img_link . ' class="img-thumbnail" height="50px" width="50px" alt ="' . $value['comp_name'] . '"/> </td>
                           <td>' . $value['comp_name'] . '</td>
                           <td>' . $value['quantity'] . '</td>
                           <td><form action="../../cart/remove/' . $key . '" method="POST">
                           <button type="submit" class="btn btn-xs btn-warning">Remove item</button>
                           </form></td>
              </tr>';
    }
    if (!empty($_SESSION['cart'])) {
        echo '
      <form action="../../booking/add" method="POST">
      <tr><td colspan="3">Booking from: <input type="date" name="date_from" min="' . $date_now . '" required>
        Returning on: <input type="date" name="date_to" min="' . $date_now . '" required></td>
        <td><button type="submit" class="btn btn-xs btn-success">Create booking</button></td>
        </tr>
        </form>
        </table>';
    } else {
        echo '
      <form action="#" method="POST">
      <tr><td colspan="3">Booking from: <input type="date" name="date_from" min="' . $date_now . '" disabled>
        Returning on: <input type="date" name="date_to" disabled></td>
        <td><button type="submit" class="btn btn-xs btn-success disabled">Create booking</button></td>
        </tr>
        </form>
        </table>';
    }

    echo '       </div>
        </div>
</div>

<script>
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>';

} else {
   header('Location: 404.php');
}
include ('scripts/footer.php');