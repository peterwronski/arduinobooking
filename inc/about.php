<?php
session_start();
include('scripts/header.php');

?>

<div class="container" style="margin-bottom:20%;">
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
            <img src="/inc/img/ard_about.png" alt="Arduino Board" class="img-responsive " style="margin-top: 20%"/>
        </div>

    </div>
    <hr/>
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
<hr/>
    <div class="row">
        <div class="col-md-6"> <p>There are many other microcontrollers and microcontroller platforms available for physical computing.
            Parallax Basic Stamp, Netmedia's BX-24, Phidgets, MIT's Handyboard, and many others offer similar functionality.
            All of these tools take the messy details of microcontroller programming and wrap it up in an easy-to-use package.
            Arduino also simplifies the process of working with microcontrollers, but it offers some advantage for teachers, students,
                and interested amateurs over other systems:</p></div>

        <div class="col-md-6">
            <ul>
                <li><b>Inexpensive</b> - Arduino boards are relatively inexpensive compared to other microcontroller platforms. The least expensive version of the Arduino module can be assembled by hand, and even the pre-assembled Arduino modules cost less than $50</li>
                <li><b>Cross-platform</b> - The Arduino Software (IDE) runs on Windows, Macintosh OSX, and Linux operating systems. Most microcontroller systems are limited to Windows</li>
                <li><b>Simple, clear programming environment</b> - The Arduino Software (IDE) is easy-to-use for beginners, yet flexible enough for advanced users to take advantage of as well. For teachers, it's conveniently based on the Processing programming environment, so students learning to program in that environment will be familiar with how the Arduino IDE works.</li>
                <li><b>Open source and extensible software</b> - The Arduino software is published as open source tools, available for extension by experienced programmers. The language can be expanded through C++ libraries, and people wanting to understand the technical details can make the leap from Arduino to the AVR C programming language on which it's based. Similarly, you can add AVR-C code directly into your Arduino programs if you want to.</li>
                <li><b>Open source and extensible hardware</b> - The plans of the Arduino boards are published under a Creative Commons license, so experienced circuit designers can make their own version of the module, extending it and improving it. Even relatively inexperienced users can build the breadboard version of the module in order to understand how it works and save money.</li>
            </ul>

        </div>
    </div>
</div>

<?php include('scripts/footer.php'); ?>
