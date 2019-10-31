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
	<title>TARUC Events - Edit Event</title>
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
	<div id="editname">
		<form action="event_manage_edit.php#editname" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Event Name <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Event Name: <input type="text" name="e_eventname" size="35" required></td></tr>
				<tr><td colspan="2"><input type="submit" name="editname" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="editdate">
		<form action="event_manage_edit.php#editdate" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Event Date <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr>
					<td>New Event Date: 
						<input type="number" name="e_eventyear" min="2019" max="2050" placeholder="YYYY" required> -
						<input type="number" name="e_eventmonth" min="01" max="12" placeholder="MM" required> -
						<input type="number" name="e_eventday" min="01" max="31" placeholder="DD" required>
					</td>
				</tr>
				<tr><td colspan="2"><input type="submit" name="editdate" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="edittime">
		<form action="event_manage_edit.php#edittime" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Event Time <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr>
					<td>New Event Time (24-hour format): 
						<input type="number" name="e_eventhour" min="00" max="24" placeholder="HH" required> : 
						<input type="number" name="e_eventminute" min="00" max="60" placeholder="MM" required>
					</td>
				</tr>
				<tr><td colspan="2"><input type="submit" name="edittime" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="editcategory">
		<form action="event_manage_edit.php#editcategory" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Event Category <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Event Category: <br><textarea name="e_eventcategory" rows="2" cols="50" placeholder="eg: Concert, Sports, Talk, Festival etc..." required></textarea></td></tr>
				<tr><td colspan="2"><input type="submit" name="editcategory" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="editdescription">
		<form action="event_manage_edit.php#editdescription" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Event Description <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Event Description: <br><textarea name="e_eventdescription" rows="5" cols="60" style="text-align: justify" required ></textarea></td></tr>
				<tr><td colspan="2"><input type="submit" name="editdescription" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="editvenue">
		<form action="event_manage_edit.php#editvenue" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Event Venue <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Venue: 
					<select name="e_eventvenue" >
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
				</td></tr>
				<tr><td colspan="2"><input type="submit" name="editvenue" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="editticketprice">
		<form action="event_manage_edit.php#editticketprice" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Ticket Price <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Ticket Price: RM <input type="number" name="e_eventticketprice" min="00" placeholder="0" required>.00 </td></tr>
				<tr><td colspan="2"><input type="submit" name="editticketprice" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="edittickettotal">
		<form action="event_manage_edit.php#edittickettotal" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit Number of Ticket <<< </th></tr>
				<tr><td>Event: 
					<select name="edit_event_name" >
						<option value="">Select</option>
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
				&nbsp;&nbsp;<input type="reset" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New Number of Ticket: <input type="number" name="e_eventtickettotal" min="10" placeholder="10" required></td></tr>
				<tr><td colspan="2"><input type="submit" name="edittickettotal" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>

	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(isset($_POST['editname'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$ename=$_POST['e_eventname'];
						$update_name = "UPDATE event_details SET EventName='$ename' WHERE EventID='$eid'";
						$result_update_name = mysqli_query($conn, $update_name);
						if($result_update_name){
							$message="Update event name success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event name. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}		
		else if(isset($_POST['editdate'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$eyear=$_POST['e_eventyear'];
						$emonth=$_POST['e_eventmonth'];
						$eday=$_POST['e_eventday'];
						//Add '0' to month
						if(($emonth>0) && ($emonth<10)){
							$emonth='0'.$emonth;
						}
						//Add '0' to day
						if(($eday>0) && ($eday<10)){
							$eday='0'.$eday;
						}
						$edate=$eyear.'-'.$emonth.'-'.$eday;
						$update_date = "UPDATE event_details SET EventDate='$edate' WHERE EventID='$eid'";
						$result_update_date = mysqli_query($conn, $update_date);
						if($result_update_date){
							$message="Update event date success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event date. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
		else if(isset($_POST['edittime'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$ehour=$_POST['e_eventhour'];
						$eminute=$_POST['e_eventminute'];
						//Add '0' to hour
						if(($ehour>-1) && ($ehour<10)){
							$ehour='0'.$ehour;
						}
						//Add '0' to minute
						if(($eminute>-1) && ($eminute<10)){
							$eminute='0'.$eminute;
						}
						$etime=$ehour.':'.$eminute.':00';
						$update_time = "UPDATE event_details SET EventTime='$etime' WHERE EventID='$eid'";
						$result_update_time = mysqli_query($conn, $update_time);
						if($result_update_time){
							$message="Update event time success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event time. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
		else if(isset($_POST['editcategory'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$ecategory=$_POST['e_eventcategory'];
						$update_category = "UPDATE event_details SET EventCategory='$ecategory' WHERE EventID='$eid'";
						$result_update_category = mysqli_query($conn, $update_category);
						if($result_update_category){
							$message="Update event category success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event category. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
		else if(isset($_POST['editdescription'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$edescription=$_POST['e_eventdescription'];
						$update_description = "UPDATE event_details SET EventDescription='$edescription' WHERE EventID='$eid'";
						$result_update_description = mysqli_query($conn, $update_description);
						if($result_update_description){
							$message="Update event description success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event description. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
		else if(isset($_POST['editvenue'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$evenue=$_POST['e_eventvenue'];
						if($evenue==''){
							$message="No event venue selected. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$read_venue_id="SELECT VenueID FROM venue_details WHERE VenueName='$evenue'";
							$result_read_venue_id = mysqli_query($conn, $read_venue_id);
							if($result_read_venue_id){
								while($row = mysqli_fetch_array($result_read_venue_id, MYSQLI_ASSOC)){
									$vid=$row['VenueID'];
									$update_venue = "UPDATE event_details SET VenueID=$vid WHERE EventID='$eid'";
									$result_update_venue = mysqli_query($conn, $update_venue);
									if($result_update_venue){
										$message="Update event venue success.";
										echo "<script type='text/javascript'>alert('$message');</script>";
									}
									else{
										$message="Fail to update event venue. Please try again.";
										echo "<script type='text/javascript'>alert('$message');</script>";
									}
								}
							}
						}
					}
				}
			}
		}
		else if(isset($_POST['editticketprice'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$eprice=$_POST['e_eventticketprice'];
						$update_price = "UPDATE event_details SET EventTicketPrice=$eprice WHERE EventID='$eid'";
						$result_update_price = mysqli_query($conn, $update_price);
						if($result_update_price){
							$message="Update event's ticket price success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event's ticket price. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
		else if(isset($_POST['edittickettotal'])){
			$selectname=$_POST['edit_event_name'];
			if($selectname==''){
				$message="No event name selected. Please select event name and try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Read event id
				$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
				$result_read_event_id = mysqli_query($conn, $read_event_id);
				if(mysqli_num_rows($result_read_event_id)>0){
					while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$etotal=$_POST['e_eventtickettotal'];
						$update_total = "UPDATE event_details SET EventTicketTotal=$etotal WHERE EventID='$eid'";
						$result_update_total = mysqli_query($conn, $update_total);
						if($result_update_total){
							$message="Update event's total number of ticket success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to update event's total number of ticket. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
	?>
</body>
</html>