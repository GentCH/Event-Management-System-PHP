<?php
	//Connect database
	include "database/connect.php";
	
	//Read session
	include 'session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}

	//Read button script
	include "top_button.html";
?>

<!DOCTYPE html>
<html>
<head>
	<title>TARUC Events - View Venue</title>
	<style type="text/css">
		a:hover{
			font-size: 24px;
		}
		a{
			color: blue;
		}
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			max-width:1200px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color: white;
			text-align:center;
		}
		th{
			background-color: #66CDAA;
			border:1px solid #66CDAA;
			font-size: 22px;
			text-align: center;
			padding-top: 10px ;
			padding-bottom: 10px ;
		}
		td{
			border:1px solid black;
			font-size: 20px;
			font-family: Times New Roman;
			text-align: center;
			padding-top: 5px ;
			padding-bottom: 5px ;
		}
		input[type=submit]{
			padding: 5px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 700;
			font-family: Times New Roman;
			font-size: 18px;
			text-align: center;
			width: 100px;
		}
		input[type=submit]:hover{
			background-color: #20B2AA;
		}
		div{
			margin: auto;
			padding-bottom: 1px;
			width: 70%;
			background-color: white;
		}
		hr{
			border-top: 5px dotted grey;
			border-bottom: none;
			border-left: none;
			border-right: none;
			width: 95%;
			padding-top: 10px
		}
	</style>
</head>
<body background="image\bg.png">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>

	<!--Sort according to name in ascending/descending order-->
	<!--Sort according to UserID by default-->
	<div id="view" align="center">
		<br>
		<p><span style="text-decoration: underline;font-weight: 900;font-size: 30px"> >>> View All Venue <<< </span></p>
		<hr>
		<form action="venue_manage_view.php" method="POST" style="font-size: 20px;">
			Sort according to venue name in: &nbsp;&nbsp;
			<input type="submit" name="ascending" value="Ascending">&nbsp;&nbsp;
			<input type="submit" name="descending" value="Descending">
		</form>
		<hr>
		<table align="center" cellpadding="20px" cellspacing="6px">
			<tr>
				<th>No.</th>
				<th>Venue Name</th>
				<th>Venue Information</th>
			</tr>
			<?php
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				if (isset($_POST['ascending'])) {
					$count=0;
					$read_venue = "SELECT * FROM venue_details ORDER BY VenueName ASC";
					$result_read_venue = mysqli_query($conn, $read_venue);
					if(mysqli_num_rows($result_read_venue)>0){
						while($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td>".$count."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['VenueInfo']."</td>";
							echo "<tr>";
						}
					}
				}
				else if (isset($_POST['descending'])) {
					$count=0;
					$read_venue = "SELECT * FROM venue_details ORDER BY VenueName DESC";
					$result_read_venue = mysqli_query($conn, $read_venue);
					if(mysqli_num_rows($result_read_venue)>0){
						while($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td>".$count."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['VenueInfo']."</td>";
							echo "<tr>";
						}
					}
				}
				else{
					$count=0;
					$read_venue = "SELECT * FROM venue_details ORDER BY VenueName ASC";
					$result_read_venue = mysqli_query($conn, $read_venue);
					if(mysqli_num_rows($result_read_venue)>0){
						while($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)){
							$count=$count+1;
							echo "<tr>";
							echo "<td>".$count."</td>";
							echo "<td>".$row['VenueName']."</td>";
							echo "<td>".$row['VenueInfo']."</td>";
							echo "<tr>";
						}
					}
				}
			?>
		</table>
	</div>
</body>
</html>