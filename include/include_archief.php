<?php

if(isset($_POST['archief'])){
$categorie_name = $_POST['archief'];

require_once('connection.php');
require_once('include_reader.php');


// get the month
function showblogsbymonth($month){
  global $db;
  $sql = "SELECT blogs.id AS blog_id, blog.titel, blog.excerp, blog.date  
  FROM blogs
  INNER JOIN connectcatwithblog con
  ON blogs.id = con.blog_id   
  INNER JOIN categorie 
  ON categorie.id = con.categorie_id
  WHERE blogs.date = '$month'
  ORDER BY blogs.id DESC";

  foreach($db->query($sql) as $row) {
        $blog_id = $row['blog_id'];
        getOneBlogFromDB($blog_id);
    }
    unset($row);
 }

 showblogsbymonth($month);

}
?>
