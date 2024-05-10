<?php require_once('api/connect.php'); ?>

<html>
    <head>
        <title>Citizen Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cstyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    </head>

    <body>
        <div class="backgroundmain">
            <!--<div class="navbar">
                <img src="images/Logo.png" class="Logo img-fluid">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>-->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <img src="images/Logo.png" class="Logo img-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Admin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="banner">
                <div class="content">
                    <h1>Online<br>Complaint Portal</h1>
                    <p>If you have any complaints about <br>waste or plastic burning,<br> you are at the right place.</p>
                    <div>
                        <button type="button" onclick="document.location='fileform.php'">Report Complaints</button>
                    </div>
                    <br>
                </div>
            </div>
            <div class="content2">
                <p>Already filed a complaint? Check your status now.</p>
                <div class = "borderticket">
                    <form id="searchForm" action="" method="post" enctype="multipart/form-data">
                        <h2>Ticket Status</h2>
                        <p>Input your ticket number and contact number to verify your filed complaint.</p>
                        <div class="indexinput form-row">
                            <label for="ticketnum" class="spacemain">Ticket No.:</label>
                            <input type="number" id="ticketnum" name="ticketnum" class="ticketinput" required>
                        </div>
                        <div class="indexinput form-row">
                            <label for="contact" class="spacemain">Contact No.:</label>
                            <input type="tel" id="contact" name="contact" pattern="09[0-9]{9}" maxlength="11" placeholder=" 09xxxxxxxxx" class="ticketinput" required>
                        </div>
                        <br>
                        <button name="search" id="search">Search</button>
                    </form>

                </div>
                <br><br>
                <br><br>
            </div>
        </div>
        <!-- javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="jscit/insert_search.js"></script> 
    </body>
</html>