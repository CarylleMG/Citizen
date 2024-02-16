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
                <br>
                <div class="content2" id="tix">
                    <p>Already filed a complaint? Check your status now.</p>
                    <div class = "border">
                        <h2>Ticket Status</h2>
                        <p>Input your ticket number.</p>
                        <div class="ticketinput">
                            <input type="number" id="ticket" name="ticket" placeholder="Ticket number">
                        </div>
                        <button type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>