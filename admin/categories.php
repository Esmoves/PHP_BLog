<?php
 try{
  require_once ('./include/connection.php');
  require_once ('./include/include_admin.php');
  require_once ('./include/include_blogs.php');
  require_once ('../include/include_reader.php');
  require_once ('./include/include_categories.php');
  require_once ('./include/include_htmlheader_admin.php');
  
  if(isset($_SESSION["name"])){  	
    	if(!empty($_GET['cat'])){
			$cat_id = $_GET['cat'];
			deletecat($cat_id);
		}

		if(!empty($_POST['submit'])){
			// insert a new category in database
			$newcatname = $_POST['naam'];
			insertnewcat($newcatname);
		}
		if ( empty($_POST['submit']) || empty($_GET['cat'])){
		    // show list of categories and delete option
			managecategories();

			?>
	    	<br />
	    	<h3 id="tussentitel">Add a new category</h3>
	    	<form action="./categories.php" name= "newcat" method="POST">
	    		<label for="naam">New Category</label>
	    		<input type="text" name="naam" style="width: 250px;" /><br /><br />
	    		<input type="submit" name="submit" id="submit" value="make new category" style="margin-left: 150px;" />
	    	</form>
	    <?php
		}			 
	}else {location('index.php');} // if not logged in go to login page

}catch(PDOException $e){
  echo "error".$e->getMessage();
} 
    
?>