<?php require_once('connect.php');

if (isset($_POST['search'])) {
    $contact = $_POST['contact'];
    $ticketnum = $_POST['ticketnum'];

    if ($contact == NULL || $ticketnum == NULL)
    {
        $result = [
            'status' => 422,
            'message' => 'Please fill out all fields'
        ];
        echo json_encode($result);
        return;
    }
    else{
        // retrieve ticketnum and contact from db
        $query = "SELECT report.TicketNum, citizen.Contact
        FROM report 
        LEFT JOIN citizen ON report.CitizenID = citizen.CitizenID
        WHERE TicketNum='$ticketnum' AND Contact='$contact'";

        $result = $mysqli -> query($query);
        if ($result->num_rows > 0) { // success
            $result = [
                'status' => 200,
                'message' => 'Ticket exist.'
                ];
            echo json_encode($result);
            return;
        }
        else {
            $result = [
                'status' => 500,
                'message' => 'Invalid Ticket Number or Contact Number'
                ];
            echo json_encode($result);
            return;
        }
    }
}
