<?php
    if(isset($_POST['submit'])){
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $whendate = $_POST['whendate'];
        $place = $_POST['place'];
        $susfname = $_POST['susfname'];
        $suslname = $_POST['suslname'];
        $details = $_POST['details'];
        $picture = $_FILES['picture'];

        //database connection
        $conn = mysqli_connect("localhost", "root", "", "plasticdb");
        if($conn->connect_error){
            die('Connection Failed :'.$conn->connect_error);
        }
        else{
            $stmt = $conn->prepare("INSERT into `citizen` (`LastName`, `FirstName`)
                values(?, ?)");
            $stmt->bind_param("ss", $LastName, $FirstName);
            $stmt->execute();
            
            $stmt2 = $conn->prepare("INSERT into `culprit` (`LastName`, `FirstName`, `Address`)
                values(?, ?, ?)");
            $stmt2->bind_param("sss", $suslname, $susfname, $place);
            $stmt2->execute();

            $Unacknowledged = "Unacknowledged";
            $stmt3 = $conn->prepare("INSERT into `report` (`Date`, `Details`, `Status`)
                            values(?, ?, ?)");
            $stmt3->bind_param("sss", $whendate, $details, $Unacknowledged);
            $stmt3->execute();

            echo "Report Submitted! Please press back to return to an empty form.";
            $stmt->close();
            $stmt2->close();
            $stmt3->close();
            $conn->close();
        }
    }
?>