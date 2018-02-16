<div class="leftmenu">
<!--
    Search form activates a script in scriptscat.js. This script gets a string back from include/search.php
-->
  <form method="post" action="search.php" id="searchform">
    <input name="keyword[keyword]" type="text" id="keyword" class="searchbox" />
    <input type="submit" value="search" class="search_button" id="search_button" />
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

   <h3>Archive</h3>
   <ul id='archief' class="lmenu">  
     <?php
        showarchive();
     ?>
   </ul>
</div>
 
  <div id="searchresults"><h2>Search results: </h2>
    <ul id="results" class="update">
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

  function showarchive(){
    global $db;
    $sql = "SELECT Month(datum) AS Month, Year(datum) as Year 
    FROM blogs
    GROUP BY  Month, Year
    ORDER BY datum DESC";
    $stmt = $db->query($sql);
    $currentMonth = 0;
    $currentYear = 0;
    while($row = $stmt->fetch()){
      $yearName = date("Y", mktime(0, 0, 0, 0, 0, $row['Year']));
      $monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
      $link = "<a href='archief.php?month=" .$row['Month']. "&year=".$row['Year']."'>";
      echo "<li class='datum'>" .$link. $monthName. "</a> <span style='font-size:0.8em;'>".$yearName. "</span></li>";
    }
  }



?>