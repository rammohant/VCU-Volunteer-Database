<?php
require_once ('connection.php');
$this->userID = $_SESSION['userID']=$user->id;

class VolunteerEvents
{
    public function listEvent()
    {
        global $conn;
        
        $sqlQuery = "SELECT v.eventID as `eventID`,
                            v.Title as `Title`,
                            v.description as `Description`,
                            v.link as 'Link',
                            v.type as 'Type',
                            v.DateRange as `Date`,
                            v.available_spots as 'Available Spots',
                            v.needed_skills as 'Skills Needed',
                            v.age_minimum as 'Age Minimum', 
                            v.approver as 'Approver'
                     FROM volunteer v where organizer=$id";
        
        // Search by title, description, or type
        if (! empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE (e.title LIKE "%' . $_POST["search"]["value"] . '%" OR e.description LIKE "%' . $_POST["search"]["value"] . '%" or j.type LIKE "%' . $_POST["search"]["value"] . '%") ';
        }
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        
        $numberRows = $stmt->rowCount();
        
        $dataTable = array();
        
        while ($sqlRow = $stmt->fetch()) {
            $dataRow = array();
            
            $dataRow[] = $sqlRow['eventID'];
            $dataRow[] = $sqlRow['Title'];
            $dataRow[] = $sqlRow['Description'];
            $dataRow[] = $sqlRow['Link'];
            $dataRow[] = $sqlRow['Type'];
            $dataRow[] = $sqlRow['Date'];
            $dataRow[] = $sqlRow['Available Spots'];
            $dataRow[] = $sqlRow['Skills Needed'];
            $dataRow[] = $sqlRow['Age Minimum'];
            $dataRow[] = $sqlRow['Approver'];
            
//             $dataRow[] = '<button type="button" name="update" eventID="' . $sqlRow["eventID"] . '" class="btn btn-warning btn-sm update">Update</button>                           <button type="button" name="delete" eventID="' . $sqlRow["eventID"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
            
    //  $dataRow[] = '<button type="button" name="delete" eventID="' . $sqlRow["eventID"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
            
            
            $dataTable[] = $dataRow;
        }
        
        $output = array(
            "recordsTotal" => $numberRows,
            "recordsFiltered" => $numberRows,
            "data" => $dataTable
        );
        
        echo json_encode($output);
    }
    
    public function getEvent()
    {
        global $conn;
        
        if ($_POST["eventID"]) {
            
            $sqlQuery = "SELECT eventID,
                            title,
                            description,
                            type,
                            daterange,
                            link,
                            available_spots,
                            needed_skills,
                            age_minumum,
                            organizer,
                            approver
                     FROM v_volunteer_ops
                     WHERE eventID = :eventID and organizer=$id";
            
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindValue(':eventID', $_POST["eventID"]);
            $stmt->execute();
            
            echo json_encode($stmt->fetch());
        }
    }
    
    public function updateEvent()
        {
            global $conn;
    
            if ($_POST['eventID']) {
    
                $sqlQuery = "UPDATE volunteer_events
                                SET
                                title = :title,
                                description = :description,
                                type = :type,
                                startdate = :startdate,
                                enddate = :enddate,
                                link = :link,
                                available_spots = :available_spots,
                                needed_skills = :needed_skills,
                                age_minumum = :age_minumum,
                                needed_skills = :needed_skills,
                                organizer = :organizer,
                                approved_by = :approved_by
                                WHERE eventID = :eventID";
                $stmt = $conn->prepare($sqlQuery);
                $stmt->bindValue(':title', $_POST["title"]);
                $stmt->bindValue(':description', $_POST["description"]);
                $stmt->bindValue(':type', $_POST["type"]);
                $stmt->bindValue(':startdate', $_POST["startdate"]);
                $stmt->bindValue(':enddate', $_POST["enddate"]);
                $stmt->bindValue(':link', $_POST["link"]);
                $stmt->bindValue(':available_spots', $_POST["available_spots"]);
                $stmt->bindValue(':needed_skills', $_POST["needed_skills"]);
                $stmt->bindValue(':age_minumum', $_POST["age_minumum"]);
                $stmt->bindValue(':organizer', $_POST["organizer"]);
                $stmt->bindValue(':approved_by', $_POST["approved_by"]);
                $stmt->bindValue(':eventID', $_POST["eventID"]);
                $stmt->execute();
            }
        }
    
    
    public function addEvent()
    {
        global $conn;
        
        $sqlQuery = "INSERT INTO volunteer_events
                     (title, description, type, startdate, enddate, link, available_spots, needed_skills, age_minumum, organizer, approved_by)
                     VALUES
                     (:title, :description, :type, :startdate, :enddate, :link, :available_spots, needed_skills, age_minumum, organizer, approved_by)";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':title', $_POST["title"]);
        $stmt->bindValue(':description', $_POST["description"]);
        $stmt->bindValue(':type', $_POST["type"]);
        $stmt->bindValue(':startdate', $_POST["startdate"]);
        $stmt->bindValue(':enddate', $_POST["enddate"]);
        $stmt->bindValue(':link', $_POST["link"]);
        $stmt->bindValue(':available_spots', $_POST["available_spots"]);
        $stmt->bindValue(':needed_skills', $_POST["needed_skills"]);
        $stmt->bindValue(':age_minumum', $_POST["age_minumum"]);
        $stmt->bindValue(':organizer', $_POST["organizer"]);
        $stmt->bindValue(':approved_by', $_POST["approved_by"]);
        $stmt->execute();
    }
    
    public function deleteEvent()
    {
        global $conn;
        
        if ($_POST["eventID"]) {
            
            $sqlQuery = "DELETE FROM volunteer_events WHERE eventID = :eventID";
            
            $stmt = $conn->prepare($sqlQuery);
            $stmt->bindValue(':eventID', $_POST["eventID"]);
            $stmt->execute();

        }
    }
}



$event = new VolunteerEvents();

if(!empty($_POST['action']) && $_POST['action'] == 'listEvent') {
    $event->listEvent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addEvent') {
    $event->addEvent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getEvent') {
    $event->getEvent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteEvent') {
    $event->deleteEvent();
}


?>

