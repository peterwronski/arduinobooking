<?php
session_start();
include('scripts/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
        <h2>What is Arduino?</h2>
            <p>Arduino is an open-source electronics platform based on easy-to-use hardware and software.
                Arduino boards are able to read inputs - light on a sensor, a finger on a button, or a Twitter message - and turn it into an output - activating a motor, turning on an LED, publishing something online.
                You can tell your board what to do by sending a set of instructions to the microcontroller on the board.
                To do so you use the Arduino programming language (based on Wiring), and the Arduino Software (IDE), based on Processing.
                <hr/>
                Over the years Arduino has been the brain of thousands of projects, from everyday objects to complex scientific instruments.
                A worldwide community of makers - students, hobbyists, artists, programmers, and professionals - has gathered around this open-source platform,
                their contributions have added up to an incredible amount of accessible knowledge that can be of great help to novices and experts alike.
                <br/>
                Arduino was born at the Ivrea Interaction Design Institute as an easy tool for fast prototyping,
                aimed at students without a background in electronics and programming.
                As soon as it reached a wider community, the Arduino board started changing to adapt to new needs and challenges,
                differentiating its offer from simple 8-bit boards to products for IoT applications, wearable, 3D printing, and embedded environments.
                All Arduino boards are completely open-source, empowering users to build them independently and eventually adapt them to their particular needs.
                The software, too, is open-source, and it is growing through the contributions of users worldwide.</p>

        </div>
        <div class="col-md-4">
            <img src="/inc/img/ard_about.png" alt="Arduino Board" class="img-responsive " style="padding-top: 10%"/>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><h2>Why Arduino?</h2>
            <p>Thanks to its simple and accessible user experience, Arduino has been used in thousands of different projects and applications.
                The Arduino software is easy-to-use for beginners, yet flexible enough for advanced users.
                It runs on Mac, Windows, and Linux.
                Teachers and students use it to build low cost scientific instruments, to prove chemistry and physics principles,
                or to get started with programming and robotics. Designers and architects build interactive prototypes, musicians and artists use it for installations
                and to experiment with new musical instruments. Makers, of course, use it to build many of the projects exhibited at the Maker Faire, for example.
                Arduino is a key tool to learn new things. Anyone - children, hobbyists, artists, programmers - can start tinkering just following the step by step instructions of a kit,
                or sharing ideas online with other members of the Arduino community.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
    </div>
</div>

<?php include('scripts/footer.php'); ?>
