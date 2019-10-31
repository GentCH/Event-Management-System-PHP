<?php
	//Connect database
	include "database/connect.php";
	
	//Read session
	include 'session.php';

	//Read button script
	include "top_button.html";
?>

</!DOCTYPE html>
<html>
<head>
	<title>UNIVERSITY Events</title>
	<style type="text/css">
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
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
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
<body background="image\bg.png" >
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
			<input type="submit" name="search" value="Search"/>
		</form>
	</div>
	<hr width="auto" size="4" style="background: #808000">

	<!--Display all event area-->
	<div class="content" align="center">
		<?php
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			//Read all event
			$read_DB = "SELECT * FROM event_details ORDER BY EventDate DESC";
			$result = mysqli_query($conn, $read_DB);
			
			//Display all result
			if($result){
    			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    				echo "<form action='event_detail.php' method='POST'><table>";
        			echo "<tr><td><input class ='event_name'  type='text' name='eventname' value='".$row['EventName']."' size=65 readonly></td></tr>";
        			echo "<tr><td><span  style='font-size:16px'><hr>". $row['EventDescription']."</td></tr>";
        			echo "<tr><td><br></td></tr>";
        			echo "<tr><td style='text-align:center'><input type='submit' name='more_detail' value='More Details'/></td></tr>";
        			echo "<tr><td><br></td></tr>";
        			echo "</table></form><br>";
    			}
			}
		?>
	</div>
</body>
</html>