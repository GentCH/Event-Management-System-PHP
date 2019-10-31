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
	<title>TARUC Events - Add/Edit Event </title>
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
			width:750px;
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
		td, input[type=text], input[type=number], select{
			font-family: Times New Roman;
			font-size: 22px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		textarea{
			font-family: Times New Roman;
			font-size: 18px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		input[type=submit], input[type=reset]{
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
		input[type=submit]:hover, input[type=reset]:hover{
			background-color: #20B2AA;
		}
	</style>
</head>
<body background="image\bg.png">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>

	<div id="add">
		<form action="event_manage.php#add" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New Event <<< </th></tr>
				<tr><td>Name: <input type="text" name="a_eventname" size="35" required></td></tr>
				<tr>
					<td>Date: 
						<input type="number" name="a_eventyear" min="2019" max="2050" placeholder="YYYY" required> -
						<input type="number" name="a_eventmonth" min="01" max="12" placeholder="MM" required> -
						<input type="number" name="a_eventday" min="01" max="31" placeholder="DD" required>
					</td>
				</tr>
				<tr>
					<td>Time (24-hour format): 
						<input type="number" name="a_eventhour" min="00" max="24" placeholder="HH" required> : 
						<input type="number" name="a_eventminute" min="00" max="60" placeholder="MM" required>
					</td>
				</tr>
				<tr><td>Event Category: <br><textarea name="a_eventcategory" rows="2" cols="50" placeholder="eg: Concert, Sports, Talk, Festival etc..." required></textarea></td></tr>
				<tr><td>Event Description: <br><textarea name="a_eventdescription" rows="5" cols="50" required style="text-align: justify"></textarea></td></tr>
				<tr><td>Venue: 
					<select name="a_eventvenue" >
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
				</td></tr>
				<tr><td>Ticket Price: RM <input type="number" name="a_eventticketprice" min="00" placeholder="0" required>.00 </td></tr>
				<tr><td>Number of Ticket: <input type="number" name="a_eventtickettotal" min="10" placeholder="10" required></td></tr>
				<tr><td colspan="2"><input type="submit" name="addevent" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="delete">
		<form action="event_manage.php#delete" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Delete Event <<< </th></tr>
				<tr><td>Event: 
					<select name="delete_event_name">
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_event = "SELECT * FROM event_details";
							$result_read_event = mysqli_query($conn, $read_event);
							if(mysqli_num_rows($result_read_event)>0){
								while($row = mysqli_fetch_array($result_read_event, MYSQLI_ASSOC)){
									echo "<option value='".$row[EventName]."'>".$row[EventName]."</option>";
								}
							}
						?>
					</select>
				&nbsp;&nbsp;<input type="submit" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><input type="submit" name="deleteevent" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
		</form>
	</div>

	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if (isset($_POST['addevent'])) {
			$ename=$_POST['a_eventname'];
			$eyear=$_POST['a_eventyear'];
			$emonth=$_POST['a_eventmonth'];
			$eday=$_POST['a_eventday'];
			$ehour=$_POST['a_eventhour'];
			$eminute=$_POST['a_eventminute'];
			$edescription=$_POST['a_eventdescription'];
			$ecategory=$_POST['a_eventcategory'];
			$evenue=$_POST['a_eventvenue'];
			$eprice=$_POST['a_eventticketprice'];
			$etotal=$_POST['a_eventtickettotal'];

			//Add '0' to month
			if(($emonth>0) && ($emonth<10)){
				$emonth='0'.$emonth;
			}
			//Add '0' to day
			if(($eday>0) && ($eday<10)){
				$eday='0'.$eday;
			}
			//Add '0' to hour
			if(($ehour>-1) && ($ehour<10)){
				$ehour='0'.$ehour;
			}
			//Add '0' to minute
			if(($eminute>-1) && ($eminute<10)){
				$eminute='0'.$eminute;
			}

			$edate=$eyear.'-'.$emonth.'-'.$eday;
			$etime=$ehour.':'.$eminute.':00';

			//Read venue id
			$read_venue_id="SELECT VenueID FROM venue_details WHERE VenueName='$evenue'";
			$result_read_venue_id = mysqli_query($conn, $read_venue_id);
			if($result_read_venue_id){
				while($row = mysqli_fetch_array($result_read_venue_id, MYSQLI_ASSOC)){
					$vid=$row['VenueID'];
					//Insert event
					$insert_event = "INSERT INTO event_details (EventName, EventDate, EventTime, EventCategory, EventDescription, EventTicketPrice, EventTicketTotal, VenueID, UserID) VALUES ('$ename', '$edate', '$etime', '$ecategory', '$edescription', $eprice, $etotal, '$vid', '$uid')";
					$result_insert_event = mysqli_query($conn, $insert_event);
					if($result_insert_event){
    					$message="Add new event success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to add new event. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
			}
		}

		if (isset($_POST['deleteevent'])) {
			$selectname=$_POST['delete_event_name'];
			//Read event id
			$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
			$result_read_event_id = mysqli_query($conn, $read_event_id);
			if($result_read_event_id){
				while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
					$eid=$row['EventID'];
					//Check if any booking was made
					//If one or more booking found, delete fail
					$check_booking="SELECT EventID FROM booking_details WHERE EventID='$eid'";
					$result_check_booking = mysqli_query($conn, $check_booking);
					if(mysqli_num_rows($result_check_booking)>0){
						$message="Fail to delete event. One or more booking found.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$delete_event = "DELETE FROM event_details WHERE EventID='$eid'";
						$result_delete_event = mysqli_query($conn, $delete_event);
						if($result_delete_event){
							$message="Delete event success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to delete event. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
	?>
</body>
</html>