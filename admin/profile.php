<?php
	require_once ('./include/connection.php');
	if(empty($_SESSION['email']))
	{
	 header("location:index.php");

	}

	else{
		require_once ('./include/connection.php');
		require_once ('./include/include_admin.php');
		require_once ('./include/include_htmlheader_admin.php');
		
		echo "<h2>WELCOME: " .$_SESSION['name'] . "</h2>";

		// button to logout
		echo '<br /><br /><button style="float:left;"><a href="logout.php">Logout</a></button>';
		// button to logout
		echo '<button style="float:left;"><a href="changepass.php">Change Password</a></button>';

		// include buttun to edit or delete specific blogs
		$useremail = $_SESSION['email'];
		usersettings($useremail);  
		require_once ('./include/include_htmlfooter.php');
	}
?>

