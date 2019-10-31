<?php
	//Connect database
	include "database/connect.php";
	
	//Read session
	include 'session.php';

	//Read button script
	include "top_button.html";

	//Join any event
	if(isset($_POST['join'])){
		//Go login page if not login
		if($login_status=="no"){
			$message="Please login to continue.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("Refresh: 0; login_register.php");
		}

		//Purchase ticket to join event, Only ONE booking per user
		else if ($login_status=="yes"){
			$ename=$_POST['joineventname'];

			//Read selected event ID
			$read_eventid = "SELECT EventID FROM event_details WHERE EventName='$ename'";
			$result_read_eventid = mysqli_query($conn, $read_eventid);
			if($result_read_eventid){
				while($row = mysqli_fetch_array($result_read_eventid, MYSQLI_ASSOC)){
					$eid=$row['EventID'];
				}
			}

			//Check if user purchased ticket for the event
			$read_book_record = "SELECT * FROM booking_details WHERE UserID='$uid' AND EventID='$eid'";
			$result_read_book_record = mysqli_query($conn, $read_book_record);
			$number_of_rows = mysqli_num_rows($result_read_book_record);
			//If purchased
			if($number_of_rows>0){
				$message="Sorry, you purchased the ticket for the event. For every event, only one ticket can be purchased by each user.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				header("Refresh: 0; index.php");
			}
			//If not purchase, check ticket availability
			else{
				$read_ticket_info = "SELECT EventTicketTotal, EventTicketSold from event_details WHERE EventID='$eid'";
				$result_read_ticket_info = mysqli_query($conn, $read_ticket_info);
				if($result_read_ticket_info){
					while($row = mysqli_fetch_array($result_read_ticket_info, MYSQLI_ASSOC)){
						$tickettotal=$row['EventTicketTotal'];
						$ticketsold=$row['EventTicketSold'];
						//If ticket sold is equal to total number of ticket, booking fail
						if($ticketsold==$tickettotal){
							$message="Oops! Ticket sold out! Try to be fast next time!";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						//Else, update ticket sold, then insert booking detail
						else{
							$currentsoldticket = $ticketsold+1;
							$update_ticket_sold = "UPDATE event_details SET EventTicketSold=$currentsoldticket WHERE EventID='$eid'";
							$result_update_ticket_sold = mysqli_query($conn, $update_ticket_sold);
							if($result_update_ticket_sold){
								date_default_timezone_set('Asia/Kuala_Lumpur');
								$current_time = date('Y-m-d H:i:s');
								$insert_booking = "INSERT INTO booking_details (BookingTimeStamp, UserID, EventID) VALUES ('$current_time', '$uid', '$eid' ) ";
								$result_insert_booking = mysqli_query($conn, $insert_booking);
								if($result_insert_booking){
					    			$message="Ticket purchase success. You can check your booking details at 'My Booking'.";
									echo "<script type='text/javascript'>alert('$message');</script>";	
								}
								else{
									$message="Ticket purchase fail. Please try again. Back to home page.";
									echo "<script type='text/javascript'>alert('$message');</script>";
								}
							}
						}
					}
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>UNIVERSITY Events - Event Detail/Search Event</title>
	<style>
		a:hover{
			font-size: 24px;
		}
		a{
			color: blue;
		}
		.top{
			font-size: 34px;
			font-family: Helvetica;
			text-align: center;
		}
		input[type=submit]{
			padding: 12px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 16px;
			text-align: center;
			width: auto;
		}
		input[type=submit]:hover{
			background-color: #20B2AA;
		}
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			margin-left:60px
			margin-right:60px;
			text-align:justify;
			border-bottom:dashed;
			background-color: white;
		}
		.event_name{
			font-family: Times New Roman;
			border-style: none;
			font-size: 30px;
			margin-top: 10px;
		}
	</style>
</head>
<body background="image\bg.png">
	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
	<hr width="auto" size="10" style="background: #808000">
	<div class="top">
		<h1>UNIVERSITY EVENTS</h1>
	</div>
	<hr width="auto" size="10" style="background: #808000">

	<!--Search event form-->
	<div class="search" style="text-align: center">
		<form action="event_detail.php" method="POST" >
			<input type="text" size="40" name="searchevent" placeholder="Enter event name to search event" style="font-size: 16px;padding: 10px" />
			<input type="submit" class="search_button" name="search" value="Search"/>
		</form>
	</div>
	<hr width="auto" size="4" style="background: #808000">

	<!--dislay search result area-->
	<div class="content" align="center">
		<?php
			$searchkey='-';

			if(((isset($_POST['search'])) && ($_POST['searchevent'] != ""))){
				$searchkey=$_POST['searchevent'];
			}
			else if (isset($_POST['more_detail'])){
				$searchkey=$_POST['eventname'];
			}
			else{
				$searchkey='-';
			}
		
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			//Read related event
			$read_DB = "SELECT * FROM event_details INNER JOIN venue_details ON event_details.VenueID = venue_details.VenueID WHERE event_details.EventName LIKE '$searchkey%'";
			$result = mysqli_query($conn, $read_DB);
			//Display related result and details
			if(mysqli_num_rows($result)>0){
				echo "<form action='event_detail.php' method='POST'>";
    			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    				echo "<br><table>";
        			echo "<tr><td><input class ='event_name'  type='text' name='joineventname' value='".$row['EventName']."' size=65 readonly></td></tr>";
        			echo "<tr><td><span  style='font-size:16px'><hr>". $row['EventDescription']."</td></tr>";
        			echo "<tr>
        					<td>
        						<ul>
        							<li><b>Date: </b>". $row['EventDate']."</li>
        							<li><b>Time: </b>". $row['EventTime']."</li>
        							<li><b>Venue: </b>".$row['VenueName']."</li>
        							<li><b>Price: </b>RM ".$row['EventTicketPrice']."</li>
        							<li><b>Category: </b>".$row['EventCategory']."</li>
        							</ul></span></td></tr>";
        			echo "<tr><td style='text-align:center'><input type='submit' name='join' value='Join Event'/></td></tr>";
        			echo "<tr><td><br></td></tr>";
        			echo "</table><br>";
    			}
    			echo "</form>";
    		}
    	?>
	</div>
</body>
</html>
