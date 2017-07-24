<?php
session_start();
include ('scripts/header.php');
    echo '<table> <th>Key</th><th>Component name</th><th>Quantity</th>';
    foreach ($_SESSION["cart"] as $key => $value) {
        echo '<tr>
                           <td>' . $key . '</td><td>' . $value['comp_name'] . '</td><td>'.$value['quantity'].'</td>';
    }
    echo '</table>';

include ('scripts/footer.php');