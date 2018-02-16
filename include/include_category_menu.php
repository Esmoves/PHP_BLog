<?php

if(isset($_POST['cat'])){
$categorie_name = $_POST['cat'];

require_once('connection.php');
require_once('include_reader.php');

// welcome statement
function welcomecategory($categorie_name){
  global $db;
  $sql = "SELECT * FROM categorie WHERE naam = '$categorie_name'";
  foreach($db->query($sql) as $row) {
      $categorie = $row['naam'];
      $categorie_id = $row['id'];
      echo "<h2>All blogs with category: " .$categorie. "</h2>";
      getAllExcerpsCAT($categorie_id);
    }
    unset($row);
  }

function getAllExcerpsCAT($categorie_id){
  global $db;
  $sql = "SELECT blogs.titel, blogs.excerp, blogs.id AS bid, categorie.naam, categorie.id, bloggers.id, bloggers.username 
  FROM blogs
  INNER JOIN connectcatwithblog con
  ON blogs.id = con.blog_id
  INNER JOIN categorie
  ON categorie.id = con.categorie_id
  INNER JOIN bloggers
  ON blogs.user_id = bloggers.id
  WHERE categorie.id = '$categorie_id'
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

// get the category
function showblogsbycategorie($categorie_name){
  global $db;
  $sql = "SELECT categorie.naam, blogs.id AS blog_id 
  FROM categorie
  INNER JOIN connectcatwithblog con
  ON categorie.id = con.categorie_id  
  INNER JOIN blogs 
  ON blogs.id = con.blog_id
  WHERE categorie.naam = '$categorie_name'
  ORDER BY blogs.id DESC";

  foreach($db->query($sql) as $row) {
        $blog_id = $row['blog_id'];
        getOneBlogFromDB($blog_id);
    }
    unset($row);
 }

 welcomecategory($categorie_name);
 showblogsbycategorie($categorie_name);

}
?>
