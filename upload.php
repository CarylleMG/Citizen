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
            $stmt = $conn->prepare("INSERT into `citizen` (`LastName`, `FirstName`, `Contact`)
                values(?, ?, ?)");
            $stmt->bind_param("sss", $LastName, $FirstName, $phone);
            $stmt->execute();

            // find culprit id
            $select = "SELECT * FROM `culprit` WHERE LastName='$suslname' AND FirstName='$susfname' AND Address='$place'";
            $result = $conn -> query($select); 
            
            if($row_count = mysqli_num_rows($result) > 0) {
            // if row exist, add offense
                $offCount = $row_count + 1;
                // get culprit values
                foreach($result as $val) {
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
                $select = "SELECT * FROM `culprit` ORDER BY CulpritID DESC LIMIT 1";
                $result = $conn -> query($select); 
                
                if($row_count = mysqli_num_rows($result) > 0) {
                // if row exist, add offense
                    $offCount = $row_count;
                    // get culprit values
                    foreach($result as $val) {
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

            $stmt3 = $conn->prepare("INSERT into `report` (`Date`, `CulpritID`, `Details`, `OffenseCount`, `Status`, `ImageFile`) 
                            values(?, ?, ?, ?, ?, ?)");
            $stmt3->bind_param("sisiss", $whendate, $culpritId, $details, $offCount, $Status, $imgContent);
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