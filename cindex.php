<?php require_once('api/connect.php'); ?>

<html>
    <head>
        <title>Citizen Page</title>
        <link rel="stylesheet" href="cstyle.css">
    </head>

    <body>
        <div class="backgroundmain">
            <div class="banner">
                <div class="navbar">
                    <img src="images/Logo.png" class="Logo">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
                <div class="content">
                    <h1>Online<br>Complaint Portal</h1>
                    <p>If you have any complaints about waste or plastic<br> burning, you are at the right place.</p>
                    <div>
                        <button type="button" onclick="document.location='fileform.php'">Report Complaints</button>
                    </div>
                    <br>
                </div>
            </div>
            <section class="content2">
                <p>Already filed a complaint? Check your status now.</p>
                <div class = "border">
                    <form action="ticket.php" method="post" enctype="multipart/form-data">
                        <h2>Ticket Status</h2>
                        <p>Input your ticket number</p>
                        <br>
                        <input type="number" id="ticketnum" name="ticketnum" placeholder="Ticket number" class="ticketinput" required>
                        <button type="submit" name="search" id="search">Search</button>
                    </form>
                </div>
                <br><br>
            </section>
        </div>
    </body>
</html>