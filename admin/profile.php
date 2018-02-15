<?php
	require_once ('./include/connection.php');
	if(empty($_SESSION['name']))
	{
	 header("location:index.php");

	}

	else{
		require_once ('./include/connection.php');
		require_once ('./include/include_admin.php');
		require_once ('./include/include_htmlheader_admin.php');
		
		echo "<h2>WELCOME: " .$_SESSION['name'] . "</h2>";

		// include buttun to edit or delete specific blogs
		$user = $_SESSION['name'];
		usersettings($user);  

		// button to logout
		echo '<br /><button style="clear:both;"><a href="changepass.php">Change Password</a></button>';

		require_once ('./include/include_htmlfooter.php');
	}
?>

