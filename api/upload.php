<?php require_once('connect.php');

if (isset($_POST['submit'])) {
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $phone = $_POST['phone'];
    $whendate = $_POST['whendate'];
    $place = $_POST['place'];
    $susfname = $_POST['susfname'];
    $suslname = $_POST['suslname'];
    $details = $_POST['details'];

    //database connection
    if ($FirstName == NULL || $LastName == NULL || $whendate == NULL || $suslname == NULL || $susfname == NULL || $place == NULL || $details == NULL || empty($_FILES["picture"]["name"]))
    {
        $result = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($result);
        return;
    }
    else{
        //Find Citizen ID
        $selectcit = "SELECT * FROM `citizen` WHERE LastName='$LastName' AND FirstName='$FirstName' AND Contact='$phone'";
        $resultcit = $conn->query($selectcit);

        if ($rep_count = mysqli_num_rows($resultcit) > 0) {
            // if row exist, add offense
            $repCount = $rep_count + 1;
            // get culprit values
            foreach ($resultcit as $vals) {
                $citizenId = $vals['CitizenID'];
                $LastName = $vals['LastName'];
                $FirstName = $vals['FirstName'];
                $phone = $vals['Contact'];
            }
        } else {
            $stmt = $conn->prepare("INSERT into `citizen` (`LastName`, `FirstName`, `Contact`)
                    values(?, ?, ?)");
            $stmt->bind_param("sss", $LastName, $FirstName, $phone);
            $stmt->execute();

            // find culprit id
            $selectcit = "SELECT * FROM `citizen` ORDER BY CitizenID DESC LIMIT 1";
            $resultcit = $conn->query($selectcit);

            $row_count = $resultcit->num_rows;
            if ($row_count > 0) {
                // if row exist, add offense
                $repCount = $rep_count;
                // get culprit values
                foreach ($resultcit as $vals) {
                    $citizenId = $vals['CitizenID'];
                    $LastName = $vals['LastName'];
                    $FirstName = $vals['FirstName'];
                    $phone = $vals['Contact'];
                }
            }
        }

        // find Culprit ID
        $selectculp = "SELECT  culprit.culpritid AS susID, culprit.firstname AS culpritFN, culprit.lastname as culpritLN, culprit.address 
            FROM `report` LEFT JOIN culprit ON report.CulpritID = culprit.CulpritID
            WHERE culprit.LastName='$suslname' AND culprit.FirstName='$susfname' AND culprit.Address='$place'";
        $resultculp = $conn->query($selectculp);

        $row_count = $resultculp->num_rows; // get row count
        if ($row_count > 0) {
            // if row exist, add offense
            $offCount = $row_count + 1;
            // get culprit values
            foreach ($resultculp as $val) {
                $culpritId = $val['susID'];
                $suslname = $val['culpritLN'];
                $susfname = $val['culpritFN'];
                $place = $val['address'];
            }
        } else {
            $stmt2 = $conn->prepare("INSERT into `culprit` (`LastName`, `FirstName`, `Address`)
                values(?, ?, ?)");
            $stmt2->bind_param("sss", $suslname, $susfname, $place);
            $stmt2->execute();

            // find culprit id
            $selectculp = "SELECT * FROM `culprit` ORDER BY CulpritID DESC LIMIT 1";
            $resultculp = $conn->query($selectculp);

            if ($row_count = $resultculp->num_rows > 0) {
                // if row exist, add offense
                $offCount = $row_count;
                // get culprit values
                foreach ($resultculp as $val) {
                    $culpritId = $val['CulpritID'];
                    $suslname = $val['LastName'];
                    $susfname = $val['FirstName'];
                    $place = $val['Address'];
                }
            }
        }

        $Status = "Unacknowledged";

        // for image upload
        if (!empty($_FILES["picture"]["name"])) {
            // Get file info 
            $imgContent = $_FILES["picture"]["name"];
        }

        $stmt3 = $conn->prepare("INSERT into `report` (`Date`, `CitizenID`, `CulpritID`, `Details`, `OffenseCount`, `Status`, `ImageFile`) 
                            values(?, ?, ?, ?, ?, ?, ?)");
        $stmt3->bind_param("siisiss", $whendate, $citizenId, $culpritId, $details, $offCount, $Status, $imgContent);
        $stmt3->execute();

        $submitted = "SELECT * FROM report ORDER BY ticketnum DESC LIMIT 1";
        $resultticket = $conn->query($submitted);
        while ($row = $resultticket->fetch_assoc()) {
            $ticketno = $row['TicketNum'];
        }

        if ($stmt3) {
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../upload_pictures/$imgContent");
            //echo "<script>alert('Report Submitted. Your ticket number is $ticketno'); window.location.href='../cindex.php';</script>";
            $result = [
                'status' => 200,
                'message' => 'Your ticket number is '.$ticketno
                ];
            echo json_encode($result);
            return;
        } else {
            $result = [
                'status' => 500,
                'message' => 'Failed to Submit Report'
                ];
            echo json_encode($result);
            return;
        }
        }
    }
