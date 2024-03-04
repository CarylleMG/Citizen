<html>
    <head>
        <title>Citizen Page</title>
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <link rel="stylesheet" href="cstyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    </head>

    <body>
        <div class="backgroundmain">
            <div class="navbar">
                <img src="images/Logo.png" class="Logo">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>

            <div class="content4">
                <h2><b>File A Report</b></h2>
                <div class = "borderform">
                    <img src="images/BarangayLogo.png" class="BarangayLogo img-fluid">
                    <form id="reportForm" action="" method="post" enctype="multipart/form-data" class="form">
                        <div class="space form-group row">
                            <label for="forwho" class="col-md-3 col-form-label"><b>For/To</b>(Para sa/kay)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" value="Hon. Walfredo R. Dimaguila Jr." id="forwho" name="forwho" readonly>
                            </div>
                        </div>
                    
                        <div class="space form-group row">
                            <label for="lname" class="col-md-3 col-form-label"><b>From</b>(Mula sa/kay)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" placeholder="First name" id="FirstName" name="FirstName" required>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control" placeholder="Last name" id="LastName" name="LastName" required>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="phone" class="col-md-3 col-form-label"><b>Contact No.:</b></label>
                            <div class="col-md-5">
                                <input type="tel" class="form-control" id="phone" name="phone" pattern="09[0-9]{9}" placeholder="09xxxxxxxxx" maxlength="11" required>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="subject" class="col-md-3 col-form-label"><b>Subject</b>(Paksa)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" name="subject" id="subject" value="Plastic Burning Incident Report" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="space form-group row">
                            <label for="when" class="col-md-3 col-form-label"><b>When</b>(Kailan)<b>:</b></label>
                            <div class="col-md-5">
                                <input type="date" class="form-control" name="whendate" id="whendate" placeholder="mm/dd/yyyy" required>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="place" class="col-md-3 col-form-label"><b>Where</b>(Saan)<b>:</b></label>
                            <div class="col-md">
                            <input type="text" class="form-control" name="place" id="place" placeholder="Write address" required>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="susfname" class="col-md-3 col-form-label"><b>Who</b>(Sino)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" id="susfname" name="susfname" placeholder="First name" required>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control" id="suslname" name="suslname" placeholder="Last name" required>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="details" class="col-md-3 col-form-label"><b>Details</b>(Detalye)<b>:</b></label>
                            <div class="col-md">
                                <textarea class="form-control" name="details" id="details" placeholder="Write the details" cols="90" rows="10" required></textarea>
                            </div>
                        </div>

                        <div class="space form-group row">
                                <label for="picture" class="col-md-3 col-form-label"><b>Upload Image Evidence</b></label>
                                <div class="col-md">
                                    <input type="file" name="picture" id="picture" accept="image/*" onchange="loadFile(event)" class="form-control" required>
                                </div>
                                <img id="output"/>
                        </div>

                        <div class="form-row">
                            <br>
                            <button name="submit" id="submit" class="submitbtn">Submit</button>
                        </div>
                    </form>
                </div>
                <br><br>
            </div>
            <br><br>
        </div>
        <!-- javascript -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="jscit/date.js"></script>
        <script src="jscit/insert_search.js"></script>
        <script>
            var loadFile = function(event){
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) //free memory
                }
            };
        </script>
    </body>
</html>