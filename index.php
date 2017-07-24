<?php

/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 11/07/2017
 * Time: 16:29
 */



define('INCLUDE_DIR', dirname(__FILE__) . '/inc/');
$rules = array(
    //
    //main pages
    //

    'about' => "/about",
    'components' => "/components",
    'viewcomponent' => "/viewcomponent/?(?'comp_ref'[\w\-]+)",
    'bookings' => "/bookings",
    'booking' => "/booking/(?'bookingID'[\w\-]+)",

    //
    //Admin Pages
    //
    'login' => "/login",
    'register' => "/register",
    'verify' => "/verify",
    'cart' => "/cart/(?'action'[\w\_&?=]+)/(?'comp_ref'[\w\_&?=]+)?",



    'viewuser' => "/viewuser",
    'logout' => "/logout",
    //
    // Home Page
    //
    'home' => "/",
    'index' => "/"
);
$uri = rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/');
$uri = '/' . trim(str_replace($uri,
        ''
        , $_SERVER['REQUEST_URI']), '/');
$uri = urldecode($uri);
foreach ($rules as $action => $rule) {
    if (preg_match('~^' . $rule . '$~i', $uri, $params)) {
        //$_SESSION['lastcalledaction'] = $action;
        include(INCLUDE_DIR . $action . '.php');

        exit();
    }
}
// nothing is found so handle the 404 error
include(INCLUDE_DIR . '404.php');
?>


