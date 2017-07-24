<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arduino@RGU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../../style.css">
</head>

<body>

<script>
    //PREVENT SESSION FROM DYING
    var refreshTime = 600000; // every 10 minutes in milliseconds
    window.setInterval( function() {
        $.ajax({
            cache: false,
            type: "GET",
            url: "../refreshSession.php",
            success: function(data) {
            }
        });
    }, refreshTime );
</script>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../../"><img src='/inc/img/logomain.png' class="img-responsive" width="150px" height="70px" alt="Arduino Booking At RGU Logo"/></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../../">Home</a> </li>
                <li><a href="about">About Arduino</a> </li>
                <li><a href="components">Components</a></li>
                <li><a href="http://campusmoodle.rgu.ac.uk">CampusNoodle</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['userloggedin'])){
                echo'<p class="navbar-text">Welcome ' .$_SESSION['userloggedin'] .'</p></li>
                <li><a href="logout"><span class="glyphicon glyphicon-user"></span> Log out</a></li>';
                }
                else {
                    echo'
                <li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-user"></span>Login</a>
                        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="loginmodal-container">
                                    <h1>Login to Your Account</h1><br>
                                    <div class="alert alert-info">
                                        <strong>Heads up!</strong>This system is currently not connected to the RGU network, therefore your existing RGU credentials won\'t work unless you create a new account on this system.
                                    </div>
                                    <form action="login" method="POST">
                                        <input type="text" name="email" placeholder="Email" aria-required="true" required>
                                        <input type="password" name="pass" placeholder="Password" aria-required ="true" required>
                                        <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                                    </form>

                                    <div class="login-help">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </li>
                
                <li><a href="#" data-toggle="modal" data-target="#reg-modal"><span class="glyphicon glyphicon-plus-sign"></span>Register</a>
                    <div class="modal fade" id="reg-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="loginmodal-container">
                                <h1>Register a new account</h1><br>
                                <div class="alert alert-info">
                                    <strong>Heads up!</strong>This system is designed for RGU students only. You will have to use an RGU email to make an account.
                                </div>
                                <form action="register" method="POST">
                                    <input type="text" name="studentid" placeholder="Student ID" aria-required="true" required>
                                    <input type="text" name="fname" placeholder="First name" aria-required="true" required>
                                    <input type="text" name="sname" placeholder="Surname" aria-required="true" required>
                                    <input type="text" name="email" placeholder="Email" aria-required="true" required>
                                    <p>Use your Student ID (i.e. <i>1234567@rgu.ac.uk</i>) or your name (i.e. <i>j.smith@rgu.ac.uk</i>)</p>
                                    <input type="password" name="pass" placeholder="Password" aria-required ="true" required>
                                    <input type="password" name="pass2" placeholder="Confirm password" aria-required ="true" required>
                                    <input type="text" name="course" placeholder="Your course (Optional)">
                                    <input type="submit" name="register" class="register loginmodal-submit" value="Register">
                                </form>
                            </div>
                        </div>
                    </div> ';
                 }; ?>
            </ul>
        </div>
    </div>
</nav>
