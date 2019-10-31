<?php
//Start session
session_start();

//Check session user
if (isset($_SESSION['UserFullName'])!=null){
	echo "<b><p style='text-align:right;font-size:18px;'>Hello, ".$_SESSION['UserFullName']." ! &nbsp;|&nbsp; <a href='index.php' >Home </a>";
	$login_status="yes";
	$uid=$_SESSION['UserID'];
	$utype=$_SESSION['UserType'];
	if($utype=='Admin'){
		echo "&nbsp;|&nbsp; <a href='admin_manage.php'>Admin Management</a>";
		echo "&nbsp;|&nbsp; <a href='my_profile.php'>My Profile</a>";
		echo "&nbsp;|&nbsp; <a href='my_booking.php'>My Booking</a>";
		echo "&nbsp;|&nbsp; <a href='change_password.php'>Change Password</a>";
		echo "&nbsp;|&nbsp; <a href='logout.php'>Logout</a></p></b>";
	}
	else if ($utype=='Student'){
		echo "&nbsp;|&nbsp; <a href='my_profile.php'>My Profile</a>";
		echo "&nbsp;|&nbsp; <a href='my_booking.php'>My Booking</a>";
		echo "&nbsp;|&nbsp; <a href='change_password.php'>Change Password</a>";
		echo "&nbsp;|&nbsp; <a href='logout.php'>Logout</a></p></b>";
	}
	else{
		echo "&nbsp;|&nbsp; <a href='logout.php' >Logout</a></p></b>";
	}
}
else{
	echo "<b><p style='text-align:right;font-size:18px'>Welcome, Guest ! ";
	echo "&nbsp;|&nbsp; <a href='index.php'>Home</a>";
	echo "&nbsp;|&nbsp; <a href='login_register.php'>Login </a>";
	echo "&nbsp;|&nbsp; <a href='login_register.php'>Register</a></p></b>";
	$login_status="no";
}
?>