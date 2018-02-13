<div class="leftmenu">

<form name="frmSearch" method="post" action="./include/search.php">
  <table>
    <tr>
      <th>Keyword
      <input name="var1" type="text" id="var1">
      <input type="submit" value="Search"></th>
    </tr>
  </table>
</form>

	  <h3>Authors</h3>
	  <ul id="authors" class="lmenu">
	    <?php
	      showbloggers();
	    ?>
	  </ul>
	 <h3>Categories</h3>
	 <ul id='myid' class="lmenu">  
	   <?php
	      showcategories();
	   ?>
	 </ul>
</div>
 <div class="maincontent" id="maincontent">

<?php

function showbloggers(){
	global $db;
  	$sql = "SELECT * FROM bloggers";
  	foreach($db->query($sql) as $row) {
       	echo "<li id='" .$row['id']."' class='author'><a href='#' >";
        echo $row['username'];
        echo "</a></li>";
    }
    unset($row);
}

 function showcategories(){    
 	global $db;         
    $sql = "SELECT * FROM categorie";
    foreach($db->query($sql) as $row) {
          echo "<li id='" .$row['id']."' class='cat'><a href='#' >";
         // echo "<a href='categories.php?cat=" .$row['id']. "''>";
          echo $row['naam'];
          echo "</a></li>";
    }
    unset($row);
  }
?>