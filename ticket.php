<?php require_once('api/connect.php');

	$ticketnum = $_GET['ticketnum']; 

	$Update2 = "SELECT report.*, 
	user.LastName AS userLN, user.FirstName as userFN,
	citizen.LastName AS citiLN, citizen.FirstName AS citiFN,
	culprit.firstname AS culpritFN, culprit.lastname as culpritLN, culprit.address FROM report 
	LEFT JOIN user ON report.UserID = user.UserID
	LEFT JOIN culprit ON report.CulpritID = culprit.CulpritID
	LEFT JOIN citizen ON report.CitizenID = citizen.CitizenID
	WHERE TicketNum='$ticketnum'";

	$res2 = $mysqli -> query($Update2); 
	if(mysqli_num_rows($res2) > 0) {
		foreach($res2 as $val) {
			// report table 
			$date = $val['Date'];
			$details = $val['Details'];
			$offCount = $val['OffenseCount'];
			$behavior = $val['Behavior'];
			$sanction = $val['Sanction'];
			$status = $val['Status'];
			$picture = $val['ImageFile'];

			// citizen info
			$citizenId = $val['CitizenID']; 
			$citiLN = $val['citiLN']; 
			$citiFN = $val['citiFN']; 

			// user info
			$userId = $val['UserID'];
			$userLN = $val['userLN'];
			$userFN = $val['userFN'];
			
			// culprit info
			$culpritId = $val['CulpritID'];
			$culpritFN = $val['culpritFN'];
			$culpritLN = $val['culpritLN'];
			$address = $val['address'];
		}
	}

	// from database
	// May subject to change
	if ($citizenId == NULL || $citizenId == 0) { // if there is no citizen report, display staff details
		$firstnameVal = $userFN;
		$lastnameVal = $userLN;
	} else { // otherwise, display citizen report
		$firstnameVal = $citiFN;  
		$lastnameVal = $userLN;
	}
?>

<html>
    <head>
        <title>Citizen Page</title>
        <link rel="stylesheet" href="cstyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <p>Report Details</p>
                <div class = "borderform">
                <img src="images/BarangayLogo.png" class="BarangayLogo img-fluid">
                    <form action="upload.php" method="post" enctype="multipart/form-data" class="form">
                        <!--<div class="form-row">    
                            <label for="date" class="space col-form-label"><b>Date</b>(Petsa)<b>:</b></label>
                            <input type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" class="inputline" readonly> 
                        </div>-->

                        <div class="form-row">
                            <label for="forwho" class="space col-form-label"><b>For/To</b>(Para sa/kay)<b>:</b></label>
                            <input type="text" id="forwho" name="forwho" value="Hon. Walfredo R. Dimaguila Jr." class="mainsub" readonly>
                        </div>    
                        
                        <label for="FirstName" class="space col-form-label"><b>From</b>(Mula sa/kay)<b>:</b></label>
                        <input type="text" id="FirstName" name="FirstName" placeholder="First name" class="inputname" readonly>
                        <input type="text" id="LastName" name="LastName" placeholder="Last name" class="inputname" readonly>

                        <div class="form-row">
                            <label for="phone" class="space col-form-label"><b>Contact No.:</b></label>
                            <input type="tel" id="phone" name="phone" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" placeholder="0000-000-0000" class="inputname" readonly>
                        </div>

                        <label for="subject" class="space col-form-label"><b>Subject</b>(Paksa)<b>:</b></label>
                        <input type="text" name="subject" value="Plastic Burning Incident Report" readonly class="mainsub">
                            
                        <hr>

                        <div class="form-row">
                            <label for="when" class="space col-form-label"><b>When</b>(Kailan)<b>:</b></label>
                            <input type="date" id="whendate" name="whendate" placeholder="dd/mm/yy" readonly>
                        </div>

                        <div class="form-row">
                            <label for="place" class="space col-form-label"><b>Where</b>(Saan)<b>:</b></label>
                            <input type="text" class="form-control" name="place" id="place" placeholder="Write address" readonly>
                        </div>

                        <div class="form-row">
                            <label for="susfname" class="space col-form-label"><b>Who</b>(Sino)<b>:</b></label>
                            <input type="text" id="susfname" name="susfname" placeholder="First name" class="inputname" readonly>
                            <input type="text" id="suslname" name="suslname" placeholder="Last name" class="inputname" readonly>
                        </div>
                        
                        <div class="form-row">
                            <label for="details" class="space col-form-label"><b>Details</b>(Detalye)<b>:</b></label>
                            <textarea class="form-control" name="details" id="details" placeholder="Write the details" cols="90" rows="10" readonly></textarea>
                        </div>
                        
                        <div class="form-group row">
                            <label for="picture" class="space col-form-label"><b>Upload Image Evidence</b></label>
                            <div class="col-md">
								<input type="file" name="picture" id="picture" accept="image/*" onchange="loadFile(event)" class="form-control" readonly>
                            </div>
								<img id="output"/>
                        </div>
                    </form>
                </div>
                <br><br>
            </div>
        </div>
        <!-- javascript -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="jscit/date.js"></script>
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