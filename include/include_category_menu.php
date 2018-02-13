<?php

if(isset($_POST['cat'])){
$categorie_name = $_POST['cat'];

require_once('connection.php');
require_once('include_oneblog.php');

// welcome statement
function welcomecategory($categorie_name){
  global $db;
  $sql = "SELECT * FROM categorie WHERE naam = '$categorie_name'";
  foreach($db->query($sql) as $row) {
        $categorie = $row['naam'];
        echo "<h2>All blogs with category: " .$categorie. "</h2>";
    }
    unset($row);
  }

// get the category
function showblogsbycategorie($categorie_name){
  global $db;
  $sql = "SELECT blogs.id AS blog_id, categorie.naam FROM blogs
  INNER JOIN categorie 
  ON blogs.category = categorie.id
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