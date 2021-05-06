<html>
<head>
<title>Volunteer Portal</title>

<style type="text/css">
h2 {
    text-align: center;
    font-size: 25px; 
    padding-top: 25px; 
    font-family: "Verdana";
    font-weight: bold; 
}

p {
    text-align: center;
    font-size: 13px;
    font-family: "Verdana"; 
    
}
div {
    text-align: center;
}
body {
    background-image:url('bg.png'); 
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
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 20px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}

table {
  width: 100%; 
  background-color: #615F5F;
  opacity: 0.80;
}

tr{
    color: #EEEAE9;
    font-family: "Verdana";
}
</style>

<?php require_once('header.php'); ?>
</head>

<?php require_once('volunteer_connection.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li class="active"><a href="user_v.php">Volunteer Portal</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="register.php">Register</a></li>
</ul>

<?php 

global $conn;
$volunteerID = $_SESSION['userID']; 

$stmt = $conn->prepare("SELECT v.eventID, 
v.title as 'Title', 
v.description as 'Description', 
v.link as 'Link', 
v.type as 'Type', 
v.DateRange as 'Date', 
v.available_spots as 'Available Spots',
v.needed_skills as 'Skills Needed',
v.age_minimum as 'Age Minimum',
v.organization as 'Organization', 
v.number as 'Contact Number', 
v.email as 'Contact Email'
FROM v_all_volunteer_signups v where volunteerID = ?");

$stmt->bind_param('volunteerID', $_SESSION['userID']);
$stmt->execute();

echo "<h2>Welcome to the Manager Portal</h2>";
        echo "<p>View, add, and delete volunteer events for your organization below.</p>";
        echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Title</th>";
        echo "<th>Description</th>";
        echo "<th>Organization</th>";
        echo "<th>Email</th>";
        echo "<th>Link</th>";
        echo "<th>Type</th>";
        echo "<th>Date</th>";
        echo "<th>Available Spots</th>";
        echo "<th>Skills Needed</th>";
        echo "<th>Age Minimum</th>";
        echo "</tr>";

while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['eventID'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Organization'] . "</td>";
        echo "<td>" . $row['Contact Email'] . "</td>";
        echo "<td>" . $row['Link'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "<td>" . $row['Available Spots'] . "</td>";
        echo "<td>" . $row['Skills Needed'] . "</td>";
        echo "<td>" . $row['Age Minimum'] . "</td>";
        echo "<td><form action='delete-user.php' method='POST'><input type='hidden' name='eventID' value='".$row['eventID']."'/><input type='submit' name='submit-btn' value='Delete' /></form></td></tr>";
        echo "</tr>";
    }
        echo "</table>";
        mysqli_free_result($result);


 // $sql = "SELECT v.eventID, 
// v.title as 'Title', 
// v.description as 'Description', 
// v.link as 'Link', 
// v.type as 'Type', 
// v.DateRange as 'Date', 
// v.available_spots as 'Available Spots',
// v.needed_skills as 'Skills Needed',
// v.age_minimum as 'Age Minimum',
// v.organization as 'Organization', 
// v.number as 'Contact Number', 
// v.email as 'Contact Email'
// FROM v_all_volunteer_signups v where v.volunteerID = '$volunteerID'";

// if($result = mysqli_query($link, $sql)){
//     if(mysqli_num_rows($result) > 0){
//         echo "<h2>Welcome to the Manager Portal</h2>";
//         echo "<p>View, add, and delete volunteer events for your organization below.</p>";
//         echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>";
//         echo "<tr>";
//         echo "<th>ID</th>";
//         echo "<th>Title</th>";
//         echo "<th>Description</th>";
//         echo "<th>Organization</th>";
//         echo "<th>Email</th>";
//         echo "<th>Link</th>";
//         echo "<th>Type</th>";
//         echo "<th>Date</th>";
//         echo "<th>Available Spots</th>";
//         echo "<th>Skills Needed</th>";
//         echo "<th>Age Minimum</th>";
//         echo "</tr>";
//         while($row = mysqli_fetch_array($result)){
//             echo "<tr>";
//             echo "<td>" . $row['eventID'] . "</td>";
//             echo "<td>" . $row['Title'] . "</td>";
//             echo "<td>" . $row['Description'] . "</td>";
//             echo "<td>" . $row['Organization'] . "</td>";
//             echo "<td>" . $row['Contact Email'] . "</td>";
//             echo "<td>" . $row['Link'] . "</td>";
//             echo "<td>" . $row['Type'] . "</td>";
//             echo "<td>" . $row['Date'] . "</td>";
//             echo "<td>" . $row['Available Spots'] . "</td>";
//             echo "<td>" . $row['Skills Needed'] . "</td>";
//             echo "<td>" . $row['Age Minimum'] . "</td>";
//             echo "<td><form action='delete-user.php' method='POST'><input type='hidden' name='eventID' value='".$row['eventID']."'/><input type='submit' name='submit-btn' value='Delete' /></form></td></tr>";
//             echo "</tr>";
//         }
//         echo "</table>";
//         mysqli_free_result($result);
//     } else{
//         echo "No records matching your query were found.";
//     }
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }
?>

</body>
</html>