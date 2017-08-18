<?php
include('scripts/header.php');

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
};
?>


<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1>Welcome to ArduinoBooking!</h1>
        </div>
        <div class="col-sm-6">
            <h2>Here's a quick guide on how to use the website</h2><br/>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0 homebox1">
            <h1>Step 1</h1> <h2>Create an account</h2>
            <a href="#step1"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step1" class="collapse">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0">
            <h1>Step 2</h1> <h2>Find components</h2>
            <a href="#step2"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step2" class="collapse">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0 homebox1">
            <h1>Step 3</h1> <h2>Pick dates</h2>
            <a href="#step3"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step3" class="collapse">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0">
            <h1>Step 4</h1> <h2>Sit back and wait for confirmation</h2>
            <a href="#step4"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step4" class="collapse">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
</div>




<?php include('scripts/footer.php'); ?>
