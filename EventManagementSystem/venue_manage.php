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
	<title>TARUC Events - Venue Manage</title>
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
			max-width:750px;
			margin-top:50px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color: white;
		}
		th{
			font-size: 28px;
			text-align: center;
			padding-top: 20px ;
			padding-bottom: 20px ;
			width: 50%;
		}
		td, input[type=text], select{
			font-family: Times New Roman;
			font-size: 22px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		input[type=submit]{
			padding: 10px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 20px;
			text-align: center;
			width: 120px;
		}
		input[type=submit]:hover{
			background-color: #20B2AA;
		}
	</style>
</head>
<body background="image\bg.png">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
	<hr width="auto" size="10" style="background: #808000">

	<div id="add">
		<form action="venue_manage.php#add" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New Venue <<< </th></tr>
				<tr><td>Name: <input type="text" name="a_venuename" size="30" required></td></tr>
				<tr><td>Information: <input type="text" name="a_venueinfo" size="30" placeholder="eg: Canteen/ For sports..." required></td></tr>
				<tr><td><input type="submit" name="addvenue" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="edit">
		<form action="venue_manage.php#edit" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Venue <<< </th></tr>
				<tr><td>Venue: 
					<select name="edit_venue_name" style="width: auto;">
						<option value="">Select</option>
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_venue = "SELECT * FROM venue_details";
							$result_read_venue = mysqli_query($conn, $read_venue);
							if(mysqli_num_rows($result_read_venue)>0){
								while($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)){
									echo "<option value='".$row[VenueName]."'>".$row[VenueName]."</option>";
								}
							}
						?>
					</select>
				&nbsp;&nbsp;<input type="submit" name="refreshvenue" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Venue Name: <input type="text" name="e_venuename" size="30"></td></tr>
				<tr><td>New Venue Information: <input type="text" name="e_venueinfo" size="30"></td></tr>
				<tr><td><input type="submit" name="editvenue" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="delete">
		<form action="venue_manage.php#delete" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Delete Venue <<< </th></tr>
				<tr><td>Venue: 
					<select name="delete_venue_name" style="width: auto;">
						<option value="">Select</option>
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_venue = "SELECT * FROM venue_details";
							$result_read_venue = mysqli_query($conn, $read_venue);
							if(mysqli_num_rows($result_read_venue)>0){
								while($row = mysqli_fetch_array($result_read_venue, MYSQLI_ASSOC)){
									echo "<option value='".$row[VenueName]."'>".$row[VenueName]."</option>";
								}
							}
						?>
					</select>
				&nbsp;&nbsp;<input type="submit" name="refreshvenue" value="Refresh"></td></tr>
				<tr><td><input type="submit" name="deletevenue" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="cancel" value="Cancel"></td></tr>
		</form>
	</div>

	<!--Each buttons' action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Add venue
		if (isset($_POST['addvenue'])) {
			$vname=$_POST['a_venuename'];
			$vinfo=$_POST['a_venueinfo'];
			$insert_venue = "INSERT INTO venue_details (VenueName, VenueInfo) VALUES ('$vname', '$vinfo')";
			$result_insert_venue = mysqli_query($conn, $insert_venue);
			if($result_insert_venue){
    			$message="Add new venue success.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$message="Fail to add new venue. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		//Edit venue
		if (isset($_POST['editvenue'])) {
			$selectname=$_POST['edit_venue_name'];
			if($selectname==''){
				$message="Venue not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$vname=$_POST['e_venuename'];
				$vinfo=$_POST['e_venueinfo'];
				
				if(($vname=='') && ($vinfo=='')){
					$message="Please enter venue name or information to update.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					if(($vname=='') && ($vinfo!='')){
						$update_venue_info = "UPDATE venue_details SET VenueInfo='$vinfo' WHERE VenueName='$selectname'";
						$result_update_venue_info = mysqli_query($conn, $update_venue_info);
						if($result_update_venue_info){
							$message="Update venue information success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update venue information. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
					else if(($vname!='') && ($vinfo=='')){
						$update_venue_name = "UPDATE venue_details SET VenueName='$vname' WHERE VenueName='$selectname'";
						$result_update_venue_name = mysqli_query($conn, $update_venue_name);
						if($result_update_venue_name){
							$message="Update venue name success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update venue name. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
					else{
						$update_venue = "UPDATE venue_details SET VenueName='$vname', VenueInfo='$vinfo' WHERE VenueName='$selectname'";
						$result_update_venue = mysqli_query($conn, $update_venue);
						if($result_update_venue){
							$message="Update venue success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update venue. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
		//Delete venue
		if (isset($_POST['deletevenue'])) {
			$selectname=$_POST['delete_venue_name'];
			$read_venue_id="SELECT VenueID FROM venue_details WHERE VenueName='$selectname'";
			$result_read_venue_id = mysqli_query($conn, $read_venue_id);
			if($result_read_venue_id){
				while($row = mysqli_fetch_array($result_read_venue_id, MYSQLI_ASSOC)){
					$vid=$row['VenueID'];
				}
			}

			//Check if any event is using the venue
			//If one or more event is using the venue, delete fail
			$check_venue="SELECT VenueID FROM event_details WHERE VenueID='$vid'";
			$result_check_venue = mysqli_query($conn, $check_venue);
			if(mysqli_num_rows($result_check_venue)>0){
				$message="Fail to delete venue. The venue is in use. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$delete_venue = "DELETE FROM venue_details WHERE VenueID='$vid'";
				$result_delete_venue = mysqli_query($conn, $delete_venue);
				if($result_delete_venue){
					$message="Delete venue success.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					$message="Fail to delete venue. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		}
	?>
</body>
</html>