<html>
<head>
<title>University Volunteer Database</title>
<?php require_once('header.php'); ?>
<!-- My JS libraries -->
<script src="js/volunteer_opportunities.js"></script>
</head>

<?php require_once('connection.php'); ?>

<body>

<div class="container-fluid mt-3 mb-3">
	<h4>Volunteer Opportunities</h4>
	<div class="table-responsive">
		<table id="table-employee" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Name</th>
					<th>Salary</th>
					<th>Manager</th>
					<th>Department</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

</body>
</html>