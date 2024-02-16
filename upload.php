<?php
    if(isset($_POST['submit'])){
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $phone = $_POST['phone'];
        $whendate = $_POST['whendate'];
        $place = $_POST['place'];
        $susfname = $_POST['susfname'];
        $suslname = $_POST['suslname'];
        $details = $_POST['details'];

        //database connection
        $conn = mysqli_connect("localhost", "root", "", "plasticdb");
        if($conn->connect_error){
            die('Connection Failed :'.$conn->connect_error);
        }
        else{
            //Find Citizen ID
            $selectcit = "SELECT * FROM `citizen` WHERE LastName='$LastName' AND FirstName='$FirstName' AND Contact='$phone'";
            $resultcit = $conn -> query($selectcit);

            if($rep_count = mysqli_num_rows($resultcit) > 0) {
                // if row exist, add offense
                    $repCount = $rep_count + 1;
                    // get culprit values
                    foreach($resultcit as $vals) {
                        $citizenId = $vals['CitizenID'];
                        $LastName = $vals['LastName'];
                        $FirstName = $vals['FirstName'];
                        $phone = $vals['Contact'];
                    }
                }
                else {
                    $stmt = $conn->prepare("INSERT into `citizen` (`LastName`, `FirstName`, `Contact`)
                    values(?, ?, ?)");
                    $stmt->bind_param("sss", $LastName, $FirstName, $phone);
                    $stmt->execute();
                    
                    // find culprit id
                    $selectcit = "SELECT * FROM `citizen` ORDER BY CitizenID DESC LIMIT 1";
                    $resultcit = $conn -> query($selectcit); 
                    
                    if($rep_count = mysqli_num_rows($resultcit) > 0) {
                    // if row exist, add offense
                        $repCount = $rep_count;
                        // get culprit values
                        foreach($resultcit as $vals) {
                            $citizenId = $vals['CitizenID'];
                            $LastName = $vals['LastName'];
                            $FirstName = $vals['FirstName'];
                            $phone = $vals['Contact'];
                        }
                    }
                }

            // find Culprit ID
            $selectculp = "SELECT * FROM `culprit` WHERE LastName='$suslname' AND FirstName='$susfname' AND Address='$place'";
            $resultculp = $conn -> query($selectculp);
            
            if($row_count = mysqli_num_rows($resultculp) > 0) {
            // if row exist, add offense
                $offCount = $row_count + 1;
                // get culprit values
                foreach($resultculp as $val) {
                    $culpritId = $val['CulpritID'];
                    $suslname = $val['LastName'];
                    $susfname = $val['FirstName'];
                    $place = $val['Address'];
                }
            }
            else {
                $stmt2 = $conn->prepare("INSERT into `culprit` (`LastName`, `FirstName`, `Address`)
                values(?, ?, ?)");
                $stmt2->bind_param("sss", $suslname, $susfname, $place);
                $stmt2->execute();
                
                // find culprit id
                $selectculp = "SELECT * FROM `culprit` ORDER BY CulpritID DESC LIMIT 1";
                $resultculp = $conn -> query($selectculp); 
                
                if($row_count = mysqli_num_rows($resultculp) > 0) {
                // if row exist, add offense
                    $offCount = $row_count;
                    // get culprit values
                    foreach($resultculp as $val) {
                        $culpritId = $val['CulpritID'];
                        $suslname = $val['LastName'];
                        $susfname = $val['FirstName'];
                        $place = $val['Address'];
                    }
                }
            }
            
            $Status = "Unacknowledged";

            // for image upload
            if(!empty($_FILES["picture"]["name"])) { 
                // Get file info 
                $imgContent = $_FILES["picture"]["name"];
            }

            $stmt3 = $conn->prepare("INSERT into `report` (`Date`, `CitizenID`, `CulpritID`, `Details`, `OffenseCount`, `Status`, `ImageFile`) 
                            values(?, ?, ?, ?, ?, ?, ?)");
            $stmt3->bind_param("siisiss", $whendate, $citizenId, $culpritId, $details, $offCount, $Status, $imgContent);
            $stmt3->execute();

            if($stmt3){ 
                move_uploaded_file($_FILES["picture"]["tmp_name"], "../upload_pictures/$imgContent");
                echo "<script>alert('Report Submitted')</script>";
            }
            else{ 
                echo "<script>alert('Report Failed to Upload')</script>";
            }  

            $stmt->close();
            $stmt2->close();
            $stmt3->close();
            $conn->close();
        }
    }
?>