<?php
	if(isset($_POST['author'])){
	$author_name = $_POST['author'];
	}
	require_once('connection.php');
	require_once('include_oneblog.php');


// *************** Show the blogs of one blogger  **************************//
function welcomeblogger($author_name){
   global $db;
  $sql = "SELECT id, username FROM bloggers WHERE username = '$author_name'";
  $sth = $db->prepare($sql);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $blogger = $row['username'];
    $blogger_id= $row['id'];
    echo "<h2>All blogs by: " .$blogger. "</h2>";
    showblogsbyblogger($blogger_id);
	unset($row);
  }

function showblogsbyblogger($blogger_id){
 global $db;
  $sql = "SELECT * FROM blogs 
  WHERE user_id = $blogger_id 
  ORDER BY id DESC 
  LIMIT 20";
  foreach($db->query($sql) as $row) {
        $blog_id= $row['id'];
        $link = "<a href='./blog.php?blog=" .$blog_id. "''>";
        echo "<table class='excerp'>";
        echo "<tr><th colspan='1'>" . $link . $row['titel']. "</a><br />";
        echo "</th></tr>";
         if(!empty($row['id_hoofdimg'])){
          // show image 
          echo "<tr><td>";
          echo "<img src='./user_images/" .$row['id_hoofdimg']. "' height='200px' />";
          echo "</td></tr>";
        }
        echo "<tr><td class='tekst'>" . $link . $row['excerp']. "</a></td></tr>";
        echo "<tr><td class='category'><em>Category: ";
        
        getCategory($row['id']);

        echo "</em></td></tr>";
        echo "</table>";
    }
    unset($row);
}

welcomeblogger($author_name);




?>