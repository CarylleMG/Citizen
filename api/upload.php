<?php require_once('connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {

    //Main form info
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $email = $_POST['email'];
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
        $selectcit = "SELECT * FROM `citizen` WHERE LastName='$LastName' AND FirstName='$FirstName' AND Email='$email' AND Contact='$phone'";
        $resultcit = $mysqli->query($selectcit);

        if ($rep_count = mysqli_num_rows($resultcit) > 0) {
            // if row exist, add offense
            $repCount = $rep_count + 1;
            // get culprit values
            foreach ($resultcit as $vals) {
                $citizenId = $vals['CitizenID'];
                $LastName = $vals['LastName'];
                $FirstName = $vals['FirstName'];
                $email = $vals['Email'];
                $phone = $vals['Contact'];
            }
        } else {
            $stmt = $mysqli->prepare("INSERT into `citizen` (`LastName`, `FirstName`, `Email`, `Contact`)
                    values(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $LastName, $FirstName, $email, $phone);
            $stmt->execute();

            // find culprit id
            $selectcit = "SELECT * FROM `citizen` ORDER BY CitizenID DESC LIMIT 1";
            $resultcit = $mysqli->query($selectcit);

            $row_count = $resultcit->num_rows;
            if ($row_count > 0) {
                // if row exist, add offense
                $repCount = $rep_count;
                // get culprit values
                foreach ($resultcit as $vals) {
                    $citizenId = $vals['CitizenID'];
                    $LastName = $vals['LastName'];
                    $FirstName = $vals['FirstName'];
                    $email = $vals['Email'];
                    $phone = $vals['Contact'];
                }
            }
        }

        // find Culprit ID
        $selectculp = "SELECT  culprit.culpritid AS susID, culprit.firstname AS culpritFN, culprit.lastname as culpritLN, culprit.address 
            FROM `report` LEFT JOIN culprit ON report.CulpritID = culprit.CulpritID
            WHERE culprit.LastName='$suslname' AND culprit.FirstName='$susfname' AND culprit.Address='$place'";
        $resultculp = $mysqli->query($selectculp);

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
            $stmt2 = $mysqli->prepare("INSERT into `culprit` (`LastName`, `FirstName`, `Address`)
                values(?, ?, ?)");
            $stmt2->bind_param("sss", $suslname, $susfname, $place);
            $stmt2->execute();

            // find culprit id
            $selectculp = "SELECT * FROM `culprit` ORDER BY CulpritID DESC LIMIT 1";
            $resultculp = $mysqli->query($selectculp);

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

        $stmt3 = $mysqli->prepare("INSERT into `report` (`Date`, `CitizenID`, `CulpritID`, `Details`, `OffenseCount`, `Status`, `ImageFile`) 
                            values(?, ?, ?, ?, ?, ?, ?)");
        $stmt3->bind_param("siisiss", $whendate, $citizenId, $culpritId, $details, $offCount, $Status, $imgContent);
        $stmt3->execute();

        $submitted = "SELECT * FROM report ORDER BY ticketnum DESC LIMIT 1";
        $resultticket = $mysqli->query($submitted);
        while ($row = $resultticket->fetch_assoc()) {
            $ticketno = $row['TicketNum'];
        }

        //email
        $mail = new PHPMailer(true);
        $mail -> isSMTP();
        $mail -> Host = 'smtp.gmail.com';
        $mail -> SMTPAuth = true;
        $mail -> Username = 'chipper.route2345@gmail.com'; //gmail account
        $mail -> Password = 'ivfomrcujptyypdn'; //same gmail's app password
        //$mail -> SMTPSecure = 'ssl';
        $mail -> SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail -> Port = 443;
        $mail -> CharSet = 'UTF-8';
        $mail -> AuthType = 'PLAIN';
        $mail -> setFrom('chipper.route2345@gmail.com');
        $mail -> addAddress($_POST['email']);
        $mail -> isHTML(true);
        
        $mail -> Subject = "Ticket Number";
        $mail -> Body = "Your ticket no. is " .$ticketno;
        $mail -> send();


        if ($stmt3) {
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../upload_pictures/$imgContent");
            $result = [
                'status' => 200,
                'message' => 'Form Submitted! Kindly check your email for a ticket number.'
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
