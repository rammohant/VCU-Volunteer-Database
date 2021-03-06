<html>
<head>
<title>Organizer Portal</title>
<style type="text/css">
h3 {
    text-align: center;
    font-size: 20px; 
    padding-top: 25px; 
    font-family: "Verdana";
    font-weight: bold; 
}

p {
    text-align: center;
    font-size: 15px;
    font-family: "Verdana"; 
    
}
div {
    text-align: center;
}
body {
    background-image:url('images/bg.png'); 
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
/*   float: right; */
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  font-family: "Verdana"; 
  font-size: 15px; 
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 15px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}

table {
  width: 100%; 
  background-color: #615F5F;
  opacity: 0.90;
}

tr{
    color: #EEEAE9;
    font-family: "Verdana";
}

td{
    word-wrap:break-word
}

</style>
<?php require_once('header.php'); ?>

<script src="js/organizer_v.js"></script>

</head>

<!-- check if user is logged in as an organizer -->
<?php require_once('connection-organizer.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="images/VDASH.png" style="height: 28px"></a><li>
	<li><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li class="active"><a href="organizer_v.php">Organizer Portal</a></li>
    <li><a href="orgs.php">Organizations</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<?php 

global $conn;
$organizer = $_SESSION['userID'];

$stmt = $conn->prepare("SELECT v.eventID, 
v.title as 'Title', 
v.description as 'Description', 
v.link as 'Link', 
v.type as 'Type', 
v.DateRange as 'Date', 
v.available_spots as 'Available Spots',
v.needed_skills as 'Skills Needed',
v.age_minimum as 'Age Minimum',
v.approver as 'Approver'
FROM v_allevents v where v.organizer=:organizerID");

$stmt->bindValue(':organizerID', $organizer);
$stmt->execute();

echo "<h3>Welcome to the Organizer Portal</h3>";
echo "<p>View, add, and delete volunteer events for your organization below.</p>";

echo "<table class='table table-dark table-stripped' style='width:90%; margin-left: auto; margin-right: auto; opacity: 90%'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Title</th>";
echo "<th>Description</th>";
echo "<th>Link</th>";
echo "<th>Type</th>";
echo "<th>Date</th>";
echo "<th>Available Spots</th>";
echo "<th>Skills Needed</th>";
echo "<th>Age Minimum</th>";
echo "<th>Approver</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";

while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['eventID'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Link'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "<td>" . $row['Available Spots'] . "</td>";
        echo "<td>" . $row['Skills Needed'] . "</td>";
        echo "<td>" . $row['Age Minimum'] . "</td>";
        echo "<td>" . $row['Approver'] . "</td>";
        echo "<td style='word-wrap:break-word'>
            <form action='delete-organizer.php' method='POST'><input type='hidden' name='Title' value='".$row['Title']."'/><input type='submit' name='delete-btn' value='Delete' /></form>
            <form action='update-organizer.php' method='GET'><input type='hidden' name='Title' value='".$row['Title']."'/><input type='submit' name='update-btn' value='Update' /></form></td>";
        echo "</tr>";
    }
        echo "</table>";

?>

<div id="center_button" style='padding-bottom: 20px'>
    <button class="btn btn-primary" onclick="location.href='addEvent.php'">Add Event</button>
</div>

</body>
</html>