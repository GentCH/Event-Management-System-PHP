<?php
	//Connect database
	include_once "database/connect.php";
	
	//Read session
	include 'session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
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
			min-width: 550px;
			max-width: 800px;
			margin-top:50px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color: white;
			padding: 30px;
			min-height: 400px;
		}
		th{
			font-size: 30px;
			text-align: center;
			text-decoration: underline;
			padding-bottom: 5px;
		}
		td{
			padding: 5px;
			font-size: 20px;
			font-family: Times New Roman;
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
		hr{
			border-top: 5px dotted grey;
			border-bottom: none;
			border-left: none;
			border-right: none;
			padding-top: 10px;
		}
		img{
			width: 100%;
			height: auto;
		}
		.dropdown{
			display: inline-block;
			position: relative;
		}
		.dropdown-content{
			display: none;
			position: absolute;
			z-index: 1;
			background: #E0FFFF;
			padding: 5px;
		}
		.dropdown-button{
			display: inline-block;
			width: 100%;
			padding: 5px;
			font-family: Times New Roman;
			font-size: 18px;
			background: #E0FFFF;
			border-top: none;
			border-left: none;
			border-right: none;
			border-bottom: 2px #66CDAA solid;
		}
		.dropdown-button:hover{
			background-color: #66CDAA;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
	        $(".dropdown").mouseleave(function(){
	        	$(".dropdown-content").hide();
	        });
	    });
		$(document).ready(function(){
	        $(".dropdown").mouseenter(function(){
	        	$(".dropdown-content").show();
	        });
	    });
	    $(document).ready(function(){
	        $("#epicture").click(function(){
	        	window.location="edit_profile.php#epicture";
	        });
	    });
	    $(document).ready(function(){
	        $("#ename").click(function(){
	        	window.location="edit_profile.php#ename";
	        });
	    });
	    $(document).ready(function(){
	        $("#eemail").click(function(){
	        	window.location="edit_profile.php#eemail";
	        });
	    });
	</script>
</head>
<body background="image\bg.png">
	<form action="edit_profile.php" method="POST">
		<table cellspacing="1">
			<tr><th colspan="3">My Profile</th></tr>
			<tr><td colspan="3"><hr></td></tr>
			<tr>
				<td rowspan="5" width="35%">
					<?php
						$user_image = "SELECT UserImage FROM user_details WHERE UserID='$uid'";
						$result_user_image = mysqli_query($conn, $user_image);
						if($result_user_image){
							while($row = mysqli_fetch_array($result_user_image, MYSQLI_ASSOC)){
								echo "<img src='data:image/png;base64,".base64_encode($row['UserImage'])."'>";
							}
						}
					?>
				</td>
			</tr>
			<tr>
				<?php
					$read_user = "SELECT UserID FROM user_details WHERE UserID='$uid'";
					$result_read_user = mysqli_query($conn, $read_user);
					if($result_read_user){
						while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
							echo "<td style='text-align:right;' width='16%'><b>User ID: </b></td>";
							echo "<td width='50%'>".$row['UserID']."</td>";
						}
					}
				?>
			</tr>
			<tr>
				<?php
					$read_user = "SELECT UserFullName FROM user_details WHERE UserID='$uid'";
					$result_read_user = mysqli_query($conn, $read_user);
					if($result_read_user){
						while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
							echo "<td style='text-align:right;' width='16%'><b>Name: </b></td>";
							echo "<td width='50%'>".$row['UserFullName']."</td>";
						}
					}
				?>
			</tr>
			<tr>
				<?php
					$read_user = "SELECT UserEmail FROM user_details WHERE UserID='$uid'";
					$result_read_user = mysqli_query($conn, $read_user);
					if($result_read_user){
						while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
							echo "<td style='text-align:right;' width='16%'><b>E-mail: </b></td>";
							echo "<td width='50%'>".$row['UserEmail']."</td>";
						}
					}
				?>
			</tr>
			<tr>
				<?php
					$read_user = "SELECT UserType FROM user_details WHERE UserID='$uid'";
					$result_read_user = mysqli_query($conn, $read_user);
					if($result_read_user){
						while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
							echo "<td style='text-align:right;' width='16%'><b>User Type: </b></td>";
							echo "<td width='50%'>".$row['UserType']."</td>";
						}
					}
				?>
			</tr>
			<tr>
				<td colspan="3" style="text-align: right">
					<div class="dropdown">
						<input type="submit" name="editprofile" value="Edit Profile">
						<div class="dropdown-content" align="center">
							<input type="button" class="dropdown-button" id="epicture" value="Profile Picture">
							<input type="button" class="dropdown-button" id="ename" value="Name">
							<input type="button" class="dropdown-button" id="eemail" value="E-mail">
						</div>
					</div>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>