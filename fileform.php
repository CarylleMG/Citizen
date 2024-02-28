<html>
    <head>
        <title>Citizen Page</title>
        <link rel="stylesheet" href="cstyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    </head>

    <body>
        <div class="backgroundmain">
            <div class="navbar">
                <img src="images/Logo.png" class="Logo">
                <ul>
                    <li><a href="cindex.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>

            <div class="content4">
                <h2>File A Report</h2>
                <div class = "borderform">
                    <img src="images/BarangayLogo.png" class="BarangayLogo img-fluid">
                    <form action="" method="post" enctype="multipart/form-data" class="form">
                        <div class="form-row">
                            <label for="forwho" class="space col-form-label"><b>For/To</b>(Para sa/kay)<b>:</b></label>
                            <input type="text" id="forwho" name="forwho" value="Hon. Walfredo R. Dimaguila Jr." class="mainsub" readonly>
                        </div>    
                        
                        <label for="FirstName" class="space col-form-label"><b>From</b>(Mula sa/kay)<b>:</b></label>
                        <input type="text" id="FirstName" name="FirstName" placeholder="First name" class="inputname" required>
                        <input type="text" id="LastName" name="LastName" placeholder="Last name" class="inputname" required>

                        <div class="form-row">
                            <label for="phone" class="space col-form-label"><b>Contact No.:</b></label>
                            <input type="tel" id="phone" name="phone" pattern="09[0-9]{9}" maxlength="11" placeholder="09xxxxxxxxx" class="inputname" required>
                        </div>

                        <label for="subject" class="space col-form-label"><b>Subject</b>(Paksa)<b>:</b></label>
                        <input type="text" name="subject" value="Plastic Burning Incident Report" readonly class="mainsub">
                            
                        <hr>

                        <div class="form-row">
                            <label for="when" class="space col-form-label"><b>When</b>(Kailan)<b>:</b></label>
                            <input type="date" id="whendate" name="whendate" placeholder="dd/mm/yy" required>
                        </div>

                        <div class="form-row">
                            <label for="place" class="space col-form-label"><b>Where</b>(Saan)<b>:</b></label>
                            <input type="text" class="form-control" name="place" id="place" placeholder="Write address" required>
                        </div>

                        <div class="form-row">
                            <label for="susfname" class="space col-form-label"><b>Who</b>(Sino)<b>:</b></label>
                            <input type="text" id="susfname" name="susfname" placeholder="First name" class="inputname" required>
                            <input type="text" id="suslname" name="suslname" placeholder="Last name" class="inputname" required>
                        </div>
                        
                        <div class="form-row">
                            <label for="details" class="space col-form-label"><b>Details</b>(Detalye)<b>:</b></label>
                            <textarea class="form-control" name="details" id="details" placeholder="Write the details" cols="90" rows="10" required></textarea>
                        </div>
                        
                        <div class="form-group row">
                            <label for="picture" class="space col-form-label"><b>Upload Image Evidence</b></label>
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
        <script src="jscit/date.js"></script>
        <script src="jscit/insert.js"></script>
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