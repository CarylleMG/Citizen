<?php require_once('api/connect.php');

$ticketnum = $_GET['ticketnum']; 
$contact = $_GET['contact'];

$query = "SELECT report.*, 
user.LastName AS userLN, user.FirstName as userFN,
citizen.citizenID, citizen.LastName AS citiLN, citizen.FirstName AS citiFN, citizen.Contact,
culprit.firstname AS culpritFN, culprit.lastname as culpritLN, culprit.address FROM report 
LEFT JOIN user ON report.UserID = user.UserID
LEFT JOIN culprit ON report.CulpritID = culprit.CulpritID
LEFT JOIN citizen ON report.CitizenID = citizen.CitizenID
WHERE TicketNum='$ticketnum' AND Contact='$contact'";

$result = $conn -> query($query);

if ($result->num_rows > 0) {
    while ($val = $result->fetch_assoc()) {
        // report table 
        $date = $val['Date'];
        $details = $val['Details'];
        //$offCount = $val['OffenseCount'];
        $behavior = $val['Behavior'];
        $sanction = $val['Sanction'];
        $status = $val['Status'];
        $picture = $val['ImageFile'];

        // citizen info
        $citizenId = $val['CitizenID']; 
        $citiLN = $val['citiLN']; 
        $citiFN = $val['citiFN']; 
        $contact = $val['Contact'];

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
    $contactVal = $contact;

} else { // otherwise, display citizen report
    $firstnameVal = $citiFN;  
    $lastnameVal = $citiLN;
    $contactVal = $contact;
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
                <p><b>Report Details</b></p>
                <div class = "borderform">
                    <img src="images/BarangayLogo.png" class="BarangayLogo img-fluid">
                    <form action="api/report-crud.php" method="post" enctype="multipart/form-data" class="form">
                    <div class="space form-group row">    
                            <label for="date" class="col-md-3 col-form-label"><b>Ticket No. <?= $ticketnum ?></b></label>
                            <div class="col-md-5">
                                <select name="selectStat" class="form-select" disabled><p>Status</p>
                                    <option value="Closed" <?php if($status=="Closed") echo 'selected="selected"'; ?> >Closed</options>
                                    <option value="Unacknowledged" <?php if($status=="Unacknowledged") echo 'selected="selected"'; ?> >Unacknowledged</options>
                                    <option value="In-progress" <?php if($status=="In-progress") echo 'selected="selected"'; ?> >In-progress</options>
                                    <!-- hide cenro status unless stated -->
                                    <?php if($status=="Forwarded to CENRO") { ?> 
                                    <option value="Forwarded to CENRO" <?php if($status=="Forwarded to CENRO") echo 'selected="selected"'; ?> >Forwarded to CENRO</options>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                            
                        <div class="space form-group row">
                            <label for="forwho" class="col-md-3 col-form-label"><b>For/To</b>(Para sa/kay)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" value="Hon. Walfredo R. Dimaguila Jr." id="forwho" name="forwho" readonly>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="lname" class="col-md-3 col-form-label"><b>From</b>(Mula sa/kay)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" value="<?=$firstnameVal?>" id="fname" name="fname" readonly>
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control" value="<?=$lastnameVal?>" id="lname" name="lname" readonly>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="phone" class="col-md-3 col-form-label"><b>Contact No.:</b></label>
                            <div class="col-md">
                                <input type="tel" class="form-control" value="<?=$contact?>" id="phone" name="phone" pattern="09[0-9]{9}" maxlength="11" readonly>
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
                            <div class="col-md-3">
                                <input type="date" value="<?=$date?>" class="form-control" name="when" id="when" placeholder="MM/dd/yyyy" readonly>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="place" class="col-md-3 col-form-label"><b>Where</b>(Saan)<b>:</b></label>
                            <div class="col-md">
                            <input type="text" value="<?=$address?>" class="form-control" name="place" id="place" placeholder="Write address" readonly>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="susfname" class="col-md-3 col-form-label"><b>Who</b>(Sino)<b>:</b></label>
                            <div class="col-md">
                                <input type="text" value="<?=$culpritFN?>" class="form-control" id="susfname" name="susfname" placeholder="First name" readonly>
                            </div>
                            <div class="col-md">
                                <input type="text" value="<?=$culpritLN?>" class="form-control" id="suslname" name="suslname" placeholder="Last name" readonly>
                            </div>
                        </div>

                        <div class="space form-group row">
                            <label for="details" class="col-md-3 col-form-label"><b>Details</b>(Detalye)<b>:</b></label>
                            <div class="col-md">
                                <textarea class="form-control" name="details" id="details" placeholder="Write the details" cols="90" rows="10" readonly>
                                    <?=htmlspecialchars($details)?>
                                </textarea>
                            </div>
                        </div>
                        <br>
                        <div class="space form-group row">
                            <label for="details" class="col-md-3 col-form-label"><b>Is the accused cooperative?</b></label>
                            <div class="col-md">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio" id="radio1" value="Cooperative" disabled <?php if($behavior=="Cooperative") echo 'checked'; ?>>
                                    <label class="form-check-label" for="radio1">Yes</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radio" id="radio2" value="Uncooperative" disabled <?php if($behavior=="Uncooperative") echo 'checked'; ?>>
                                    <label class="form-check-label" for="radio2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="space form-group row">
                                <label for="picture" class="col-md-3 col-form-label"><b>Image Evidence</b></label>
                                <div class="col-md">
                                    <?php echo "<img src='upload_pictures/".$picture."' class='form-control'>";   ?>
                                </div>
                        </div>
                        <br>
                        <div class="space form-group row">
                            <label for="sanction" class="col-md-3 col-form-label"><b>Sanction</b></label>
                            <div class="col-md-3">
                            <input type="text" value="<?=$sanction?>" class="form-control" name="sanction" id="sanction" placeholder="Pending..." readonly>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
        <!-- javascript -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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