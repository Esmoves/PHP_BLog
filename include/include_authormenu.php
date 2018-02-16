<?php
	if(isset($_POST['author'])){
	$author_name = $_POST['author'];
	}
	require_once('connection.php');
	require_once('include_reader.php');


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
  getAllExcerps($blogger);
}

function getAllExcerps($blogger){
 global $db;
  $sql = "SELECT *, blogs.id AS bid 
  FROM blogs
  INNER JOIN bloggers
  ON blogs.user_id = bloggers.id
  WHERE bloggers.username = '$blogger'
  ORDER BY blogs.id DESC
  LIMIT 20";
  foreach($db->query($sql) as $row) {
     if (!empty($row)){
        $blog_id= $row['bid'];
        $link = "<a href='./blog.php?blog=" .$blog_id. "'>";
        echo "<table class='excerp'>";
        echo "<tr><th colspan='1'>" . $link . $row['titel']. "</a><br />";
        echo "<em> By " .$row['username']. "</em></th></tr>";

        if(!empty($row['id_hoofdimg'])){
          // show image 
          echo "<tr><td>";
          echo "<img src='./user_images/" .$row['id_hoofdimg']. "' height='200px' />";
          echo "</td></tr>";
        }

        echo "<tr><td class='tekst'>" . $link . $row['excerp']. "</a></td></tr>";
        
        echo "<tr><td class='category'><em>Category: ";
        getCategory($blog_id);
        echo "</em></td></tr>";

        echo "</table>";
      }
      else { 
        echo "<p>Nothing to show.</p>";
      }
    }
    unset($row);
}

welcomeblogger($author_name);

?>