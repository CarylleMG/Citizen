<?php require_once('api/connect.php');

	$ticketnum = $_GET['ticketnum']; 

	$TicketForm = "SELECT report.*, 
	citizen.LastName AS citiLN, citizen.FirstName AS citiFN,
	culprit.firstname AS culpritFN, culprit.lastname as culpritLN, culprit.address FROM report 
	WHERE TicketNum='$ticketnum'";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Process each row of data
            // $row contains the data from the database
        }
    } else {
        echo "Ticket Number Invalid.";
    }

	/*$res2 = $mysqli -> query($TicketForm); 
	if(mysqli_num_rows($res2) > 0) {
		foreach($res2 as $val) {
			// report table 
			$whendate = $val['Date'];
			$details = $val['Details'];
			$picture = $val['ImageFile'];

			// citizen info
			$LastName = $val['citiLN']; 
			$FirstName = $val['citiFN']; 

			
			// culprit info
			$susfname = $val['culpritFN'];
			$suslname = $val['culpritLN'];
			$place = $val['address'];
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

    if($ticketnum == NULL) {
        echo "<script>alert('Ticket Number Invalid.')</script>";
    }*/
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
                        <input type="text" id="FirstName" name="FirstName" value="<?=$FirstName?>" class="inputname" readonly>
                        <input type="text" id="LastName" name="LastName" value="<?=$LastName?>" class="inputname" readonly>

                        <div class="form-row">
                            <label for="phone" class="space col-form-label"><b>Contact No.:</b></label>
                            <input type="tel" id="phone" name="phone" value="<?=$phone?>" class="inputname" readonly>
                        </div>

                        <label for="subject" class="space col-form-label"><b>Subject</b>(Paksa)<b>:</b></label>
                        <input type="text" name="subject" value="Plastic Burning Incident Report" readonly class="mainsub">
                            
                        <hr>

                        <div class="form-row">
                            <label for="when" class="space col-form-label"><b>When</b>(Kailan)<b>:</b></label>
                            <input type="date" id="whendate" name="whendate" value="<?=$whendate?>" readonly>
                        </div>

                        <div class="form-row">
                            <label for="place" class="space col-form-label"><b>Where</b>(Saan)<b>:</b></label>
                            <input type="text" class="form-control" name="place" id="place" value="<?=$place?>" readonly>
                        </div>

                        <div class="form-row">
                            <label for="susfname" class="space col-form-label"><b>Who</b>(Sino)<b>:</b></label>
                            <input type="text" id="susfname" name="susfname" value="<?=$susfname?>" class="inputname" readonly>
                            <input type="text" id="suslname" name="suslname" value="<?=$suslname?>" class="inputname" readonly>
                        </div>
                        
                        <div class="form-row">
                            <label for="details" class="space col-form-label"><b>Details</b>(Detalye)<b>:</b></label>
                            <textarea class="form-control" name="details" id="details" value="<?=$details?>" cols="90" rows="10" readonly></textarea>
                        </div>
                        
                        <div class="form-group row">
                            <label for="picture" class="space col-form-label"><b>Upload Image Evidence</b></label>
                            <div class="col-md">
								<input type="file" name="picture" id="picture" accept="image/*" onchange="loadFile(event)" class="form-control" value="<?=$picture?>" readonly>
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