<html>
<head>
<title>VDASH Volunteer Portal</title>

<style type="text/css">
h2 {
    text-align: center;
}
p {
    text-align: center;
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
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
</style>

<?php require_once('header.php'); ?>
</head>

<?php require_once('connection.php'); ?>

<body>

<ul>
	<li><a href="#" class="pull-left" style="height:100%"> <img src="VDASH.png"></a><li>
    <li><a href="#">Home</a></li>
	<li><a href="volunteer_event.php">Volunteer Portal</a></li>
	<li><a href="addEvent.php">Add events</a></li>
	<li class="active"><a href="manager_v.php">Manager Portal</a></li>
</ul>

<div class="container-fluid mt-3 mb-3">
	<h4>Welcome to the Volunteer Portal</h4>
    <p>Check out all the events you've signed up for!</p>
        	
	<div class="table-responsive">
		<table id="t_v_volunteer_events" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Description</th>
					<th>Link</th>
					<th>Type</th>
					<th>Date</th>
					<th>Available Spots</th>
					<th>Skills Needed</th>
					<th>Age Minimum</th>
					<th>Organization</th>
                    <th>Contact Number</th>
                    <th>Contact Email</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

</body>
</html>