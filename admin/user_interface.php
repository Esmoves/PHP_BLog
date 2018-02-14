<?php
session_start();  
 if(isset($_SESSION["login_user"]))  
 {  
 	include_once ('include_phpfunctions.php');
	include_once ('include_html.php');
	
	if ( empty($_POST['submit']) || empty($_GET['cat']))
 	{
	   	$user = $_SESSION['login_user'];
	    echo '<h2>Welcome - '.$user.'</h2>';  
	    // show titels of all blogs by user
	    // include buttun to edit or delete specific blogs
	    usersettings($user);  

	    // show list of categories and delete option
	    managecategories();

	    // show upload a new category form
	    ?>
	    	<br />
	    	<h3 id="tussentitel">Add a new category</h3>
	    	<form action="./user_interface.php" name= "newcat" method="POST">
	    		<label for="naam">New Category</label>
	    		<input type="text" name="naam" style="width: 250px;" /><br /><br />
	    		<input type="submit" name="submit" id="submit" value="make new category" style="margin-left: 150px;" />
	    	</form>
	    <?php

	    // button to logout
	    echo '<br /><br /><button><a href="logout.php">Logout</a></button>';  	
	}
	 if(!empty($_GET['cat'])){
		$cat_id = $_GET['cat'];
		deletecat($cat_id);
	}
	 if(!empty($_POST['submit'])){
		// insert a new category in database
		$newcatname = $_POST['naam'];
		insertnewcat($newcatname);

	}

}  // if not logged in go to login page
 else  
 {  
      header("location:login.php");  
 }  

?>

		</div>
	</body>
</html>