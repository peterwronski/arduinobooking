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
                <div class="col-sm-4">
                    <img src="/inc/img/step1.1.png" class="img-responsive" alt="Step 1 Image 1"/>
                </div>
                <div class="col-sm-4">
                    Click the 'Register' button in the top right corner, and fill out all the details. Remember to use your RGU credentials,
                    as no other credentials will be accepted (i.e. you can't make an account using your personal email).
                </div>
                <div class="col-sm-4">
                    <img src="/inc/img/step1.2.png" class="img-responsive" alt="Step 1 Image 2"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0">
            <h1>Step 2</h1> <h2>Find components</h2>
            <a href="#step2"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step2" class="collapse">
                <div class="col-sm-4">
                    <img src="/inc/img/step2.1.png" class="img-responsive" alt="Step 2 Image 1"/>
                </div>
                <div class="col-sm-4">
                    Find the components needed for your project. Clicking on a component will redirect you to a page which will allow you to add the component to your cart.
                    Pick a quantity, and please remember you can't book more components than are currently available (Displayed in the "In Stock" column).
                </div>
                <div class="col-sm-4">
                    <img src="/inc/img/step2.2.png" class="img-responsive" alt="Step 2 Image 2"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0 homebox1">
            <h1>Step 3</h1> <h2>Pick dates</h2>
            <a href="#step3"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step3" class="collapse">
                <div class="col-sm-6">
                    <img src="/inc/img/step3.1.png" class="img-responsive" alt="Step 3 Image 1"/>
                </div>
                <div class="col-sm-6">
                    Go to 'Your Cart' to view all your components. In order to complete the booking, you'll need a starting date and a return date.
                    When you're done, just click 'Create booking'. If everything goes smoothly, you'll be notified that your booking went through.
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-offset-0">
            <h1>Step 4</h1> <h2>Sit back and wait for confirmation</h2>
            <a href="#step4"  data-toggle="collapse"><span class="glyphicon glyphicon-chevron-down"></span> More info <span class="glyphicon glyphicon-chevron-down"></span></a>
            <div id="step4" class="collapse">
                <div class="col-sm-6">
                    <img src="/inc/img/step4.1.png" class="img-responsive" alt="Step 4 Image 1"/>
                </div>
                <div class="col-sm-6">
                    Sit back and wait for your booking to be confirmed/denied. You'll get an e-mail notification when an admin makes a decision about your booking, so you don't have to keep checking back.
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('scripts/footer.php'); ?>
